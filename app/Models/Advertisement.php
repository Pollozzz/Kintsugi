<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Lang;
use Laravel\Scout\Searchable;

#[Fillable(['title', 'description', 'price', 'user_id', 'category_id', 'language'])]
class Advertisement extends Model
{
    use Searchable;

    protected function casts(): array
    {
        return [
            'is_accepted' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();

        return true;
    }

    public static function toBeRevisedCount()
    {
        return Advertisement::where('is_accepted', null)->count();
    }

    public function toSearchableArray()
    {
        $categoryNames = [$this->category->name];

        foreach (['it', 'en', 'es'] as $locale) {
            $translationKey = 'ui.'.$this->category->name;

            if (Lang::has($translationKey, $locale)) {
                $categoryNames[] = __($translationKey, [], $locale);
            }
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => implode(' ', array_unique($categoryNames)),
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
