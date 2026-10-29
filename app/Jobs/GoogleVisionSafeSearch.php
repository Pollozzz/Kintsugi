<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\Image as VisionImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GoogleVisionSafeSearch implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    private $article_image_id;

    public function __construct($article_image_id)
    {
        $this->article_image_id = $article_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $i = Image::find($this->article_image_id);
        if (! $i) {
            return;
        }

        $image = file_get_contents(storage_path('app/public/'.$i->path));
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.base_path('google_credential.json'));

        $googleVisionClient = new ImageAnnotatorClient;
        $google_image = new VisionImage([
            'content' => $image,
        ]);

        $googleFeature = new Feature;
        $googleFeature->setType(Type::SAFE_SEARCH_DETECTION);

        $request = new AnnotateImageRequest;
        $request->setImage($google_image);
        $request->setFeatures([$googleFeature]);

        $batchRequest = new BatchAnnotateImagesRequest;
        $batchRequest->setRequests([$request]);

        $responseBatch = $googleVisionClient->batchAnnotateImages($batchRequest);

        $response = $responseBatch->getResponses();
        $googleVisionClient->close();

        $safeSearchAnnotation = $response[0]->getSafeSearchAnnotation();
        $adult = $safeSearchAnnotation->getAdult();
        $spoof = $safeSearchAnnotation->getSpoof();
        $medical = $safeSearchAnnotation->getMedical();
        $violence = $safeSearchAnnotation->getViolence();
        $racy = $safeSearchAnnotation->getRacy();

        $likelihoodName = [
            'text-secondary bi bi-circle-fill',
            'text-success bi bi-check-circle-fill',
            'text-success bi bi-check-circle-fill',
            'text-warning bi bi-exclamation-circle-fill',
            'text-warning bi bi-exclamation-circle-fill',
            'text-danger bi bi-dash-circle-fill',
        ];

        $i->adult = $likelihoodName[$adult];
        $i->spoof = $likelihoodName[$spoof];
        $i->medical = $likelihoodName[$medical];
        $i->violence = $likelihoodName[$violence];
        $i->racy = $likelihoodName[$racy];
        $i->save();

    }
}
