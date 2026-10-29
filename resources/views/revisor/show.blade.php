<x-layout>
    <div class="container mt-5">
        <div class="row py-5">
            <div class="col-12">
                <a href="{{ route('revisor.index') }}" class="btn btn-outline-light mb-3 show-back-link">
                    &larr; {{ __('ui.back') }}
                </a>
            </div>


            <!-- rating imamgini   -->
            @foreach ($advertisement->images as $key => $image)
                <div class="col-6">
                    <div class="card mb-3 ">
                        <div class="row g-0 ">
                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                <span class="watermarked-image-frame revisor-show-image-frame">
                                <img src="{{ $image->getUrl() }}" class="img-fluid rounded-start"
                                    alt="Immagine {{ $key + 1 }} dell'articolo '{{ $advertisement->title }}'">
                                <img src="{{ asset('media/Logo.png') }}" class="image-watermark" alt="" aria-hidden="true">
                                </span>
                            </div>
                            <div class="col-md-5 ps-3 ">
                                <div class="card-body">
                                    <h5 class="">Labels</h5>
                                    @if ($image->labels)
                                        @foreach ($image->labels as $label)
                                            #{{ $label }},
                                        @endforeach
                                    @else
                                        <p class="fst-italic">No labels</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-body ">
                                    <h5 class="">Ratings</h5>
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class="text-center mx-auto {{ $image->adult }}">
                                            </div>
                                        </div>
                                        <div class="col-10">adult</div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class=" text-center mx-auto {{ $image->violence }}">
                                            </div>
                                        </div>
                                        <div class="col-10">violence</div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class=" text-center mx-auto {{ $image->spoof }}">
                                            </div>
                                        </div>
                                        <div class="col-10">spoof</div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class=" text-center mx-auto {{ $image->racy }}">
                                            </div>
                                        </div>
                                        <div class="col-10">racy</div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-2">
                                            <div class=" text-center mx-auto {{ $image->medical }}">
                                            </div>
                                        </div>
                                        <div class="col-10">medical</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-12 col-md-6 mt-5">
                <div class="color-p">
                    <h1 class="color-a">{{ $advertisement->title }}</h1>
                    <p class="card-text">{{ $advertisement->description }}</p>
                    <p class="card-text"><span
                            class="color-a">{{ __('ui.price') }}:</span>{{ ' ' . $advertisement->price }} €</p>
                    <p class="card-text"> <span
                            class="color-a">{{ __('ui.category') }}:</span>{{ ' ' . __('ui.' . $advertisement->category->name) }}
                    </p>
                </div>

                @if (session()->has('message'))
                    <div class="alert alert-success text-center shadow rounded small d-inline-block py-2 px-3 mb-2"
                        role="status">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="d-flex gap-2 mt-3">
                    @if ($advertisement->is_accepted === null)
                        <form method="POST" action="{{ route('reject', $advertisement) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn revisor-action-button revisor-action-button--reject">
                                {{ __('ui.reject') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('accept', $advertisement) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn revisor-action-button revisor-action-button--accept">
                                {{ __('ui.approve') }}
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('revision', $advertisement) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn revisor-action-button revisor-action-button--pending">
                                {{ __('ui.sendBackToReview') }}
                            </button>
                        </form>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-layout>
