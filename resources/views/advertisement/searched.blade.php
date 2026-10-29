<x-layout>
    <div class="container-fluid ">
        <div class="row py-5 justify-content-center align-items-center text-center mt-5">
            <div class="col-12">
                <h1 class="display-4 color-p">{{ __('ui.searchResults', ['query' => $query]) }}</h1>
            </div>
        </div>
        <div class="row ad-card-grid ad-card-grid--four height-custom align-items-center py-5 g-4">
            @forelse ($advertisements as $advertisement)
            <div class="col-12 col-md-3 ad-card-grid-item">
                <div class="card ad-card">
                    <a href="{{ route('advertisement.show', $advertisement) }}">
                        <span class="{{ $advertisement->images->isNotEmpty() ? 'watermarked-image-frame' : '' }}">
                        <img src="{{ $advertisement->images->isNotEmpty() ? $advertisement->images->first()->getUrl() : '/media/Logo.png' }}"
                            class="card-img-top ad-card-image"
                            alt="{{ __('ui.listingImageAlt', ['title' => $advertisement->title]) }}">
                        @if ($advertisement->images->isNotEmpty())
                            <img src="{{ asset('media/Logo.png') }}" class="image-watermark" alt="" aria-hidden="true">
                        @endif
                        </span>
                    </a>
                    <div class="card-body ad-card-body">
                        <a href="{{ route('advertisement.show', $advertisement) }}" class="text-decoration-none text-reset d-block">
                            <h5 class="card-title ubuntu-medium text-uppercase ad-card-title">
                                {{ $advertisement->title }}
                            </h5>
                            <p class="card-text ad-card-description">
                                {{ Str::limit($advertisement->description, 50) }}
                            </p>
                            <p class="card-text ad-card-price">
                                {{ $advertisement->price }} €
                            </p>
                        </a>
                        <p class="card-text ad-card-category">{{ __('ui.' . $advertisement->category->name) }}</p>
                        <p class="ad-card-link"><a href="{{ route('advertisement.show', $advertisement) }}">{{ __('ui.viewListing') }}</a></p>
                        {{-- <button type="button" class="btn ad-card-action" data-bs-theme="dark">
                                                            Acquista
                                                        </button> --}}
                </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <h3 class="text-center text-light">
                    {{ __('ui.noSearchResults') }}
                </h3>
            </div>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div>
            {{ $advertisements->links() }}
        </div>
    </div>
</x-layout>