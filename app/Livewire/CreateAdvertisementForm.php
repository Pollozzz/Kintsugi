<?php

namespace App\Livewire;

use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAdvertisementForm extends Component
{
    use WithFileUploads;

    // ---------- Proprietà ----------

    #[Validate('required|min:3')]
    public $title;

    #[Validate('required|min:12')]
    public $description;

    #[Validate('required')]
    public $price;

    #[Validate('required')]
    public $category = '';

    #[Validate('required|in:it,en,es')]
    public $language;

    #[Validate(
        [
            'images' => 'required|array|min:1|max:6',
            'images.*' => 'file|mimes:jpg,jpeg,png,gif,webp,bmp|max:4096',
        ],
    )]
    public $images = [];

    public $temporary_images = [];

    public int $imageUploadKey = 0;

    // ---------- Lifecycle ----------

    public function mount(): void
    {
        $this->language = app()->getLocale();
    }

    public function updatedTemporaryImages()
    {
        $this->validate([
            'temporary_images' => 'array|max:6',
            'temporary_images.*' => 'file|mimes:jpg,jpeg,png,gif,webp,bmp|max:4096',
        ]);

        if (count($this->images) + count($this->temporary_images) > 6) {
            $this->addError('temporary_images', __('ui.maxImages'));
            $this->temporary_images = [];

            return;
        }

        foreach ($this->temporary_images as $image) {
            $this->images[] = $image;
        }

        $this->temporary_images = [];
    }

    // ---------- Azioni ----------

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
            $this->resetErrorBag('temporary_images');
        }
    }

    public function store()
    {
        // dd($this->title, $this->description, $this->price, $this->category);
        $this->validate();

        $advertisement = Advertisement::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
            'user_id' => Auth::id(),
            'language' => $this->language,
        ]);

        foreach ($this->images as $image) {
            $directory = "advertisement/{$advertisement->id}";
            $newImage = $advertisement->images()->create([
                'path' => $image->store($directory, 'public'),
            ]);

            RemoveFaces::withChain([
                new ResizeImage($newImage->path, 600, 600),
                new GoogleVisionSafeSearch($newImage->id),
                new GoogleVisionLabelImage($newImage->id),
            ])->dispatch($newImage->id);
        }

        if ($this->images !== []) {
            File::deleteDirectory(storage_path('app/livewire-tmp'));
        }

        session()->flash('success', __('ui.listingCreated'));
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        $this->images = [];
        $this->imageUploadKey++;
        $this->temporary_images = [];
        $this->resetValidation();
    }

    // ---------- Render ----------

    public function render()
    {
        return view('livewire.create-advertisement-form', [
            'categories' => Category::all(),
        ]);
    }
}
