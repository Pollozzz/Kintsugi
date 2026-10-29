<?php

namespace App\Livewire;

use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class RevisorDashboard extends Component
{
    public function approve(int $advertisementId): void
    {
        $advertisement = $this->findAdvertisement($advertisementId);
        $advertisement->setAccepted(true);

        session()->flash('message', __('ui.reviewerApproved', ['title' => $advertisement->title]));
    }

    public function reject(int $advertisementId): void
    {
        $advertisement = $this->findAdvertisement($advertisementId);
        $advertisement->setAccepted(false);

        session()->flash('message', __('ui.reviewerRejected', ['title' => $advertisement->title]));
    }

    public function sendBackToReview(int $advertisementId): void
    {
        $advertisement = $this->findAdvertisement($advertisementId);
        $advertisement->setAccepted(null);

        session()->flash('message', __('ui.reviewerPending', ['title' => $advertisement->title]));
    }

    public function deleteAdvertisement(int $advertisementId): void
    {
        $advertisement = $this->findAdvertisement($advertisementId);
        $title = $advertisement->title;
        $imagePaths = $advertisement->images()
            ->whereNotNull('path')
            ->pluck('path');
        $filesToDelete = $imagePaths->flatMap(function (string $path): array {
            $directory = dirname($path);
            $filename = basename($path);

            return [
                $path,
                $directory.'/crop_600x600_'.$filename,
            ];
        });

        DB::transaction(function () use ($advertisement): void {
            $advertisement->delete();
        });

        Storage::disk('public')->delete($filesToDelete->all());

        session()->flash('message', __('ui.reviewerDeleted', ['title' => $title]));
    }

    public function render()
    {
        $advertisementsToCheck = Advertisement::with(['images', 'category'])
            ->whereNull('is_accepted')
            ->orderByDesc('updated_at')
            ->get();
        $allAdvertisements = Advertisement::with(['images', 'category'])
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.revisor-dashboard', [
            'advertisements_to_check' => $advertisementsToCheck,
            'allAdvertisements' => $allAdvertisements,
        ]);
    }

    private function findAdvertisement(int $advertisementId): Advertisement
    {
        abort_unless(auth()->user()?->is_revisor, 403);

        return Advertisement::findOrFail($advertisementId);
    }
}
