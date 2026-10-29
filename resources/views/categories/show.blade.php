<x-layout>
    <div class="container py-5">
        <div class="row py-4">
            <div class="col-12">
                <a href="{{ (route('advertisement.index')) }}" class="btn btn-outline-light mb-3 show-back-link">
                    &larr; {{ __('ui.back') }}
                </a>
                <x-category-nav :categories="$categories" :active-category="$category" />
            </div>
        </div>
        <div class="row ad-card-grid ad-card-grid--three align-items-stretch py-4 g-4">
            @forelse ($advertisements as $advertisement)
            <div class="col-12 col-md-4 ad-card-grid-item">
                <div class="card ad-card">
                    <a href="{{ route('advertisement.show', $advertisement) }}">
                        <span class="{{ $advertisement->images->isNotEmpty() ? 'watermarked-image-frame' : '' }}">
                        <img src="{{ $advertisement->images->isNotEmpty() ? $advertisement->images->first()->getUrl() : '/media/Logo.png' }}"
                            class="card-img-top" alt="{{ __('ui.listingImageAlt', ['title' => $advertisement->title]) }}">
                        @if ($advertisement->images->isNotEmpty())
                            <img src="{{ asset('media/Logo.png') }}" class="image-watermark" alt="" aria-hidden="true">
                        @endif
                        </span>
                    </a>
                    <div class="card-body ad-card-body">
                        <a href="{{ route('advertisement.show', $advertisement) }}" class="text-decoration-none text-reset d-block">
                            <h5 class="card-title ubuntu-medium text-uppercase ad-card-title text-truncate d-block">
                                {{ $advertisement->title }}
                            </h5>
                            <p class="card-text ad-card-description">
                                {{ Str::limit($advertisement->description, 100) }}
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
            <header class="home-advertisements-heading  mt-5">
                <h3>{{ __('ui.noListingsAvailable') }}</h3>
            </header>
            @endforelse
        </div>
    </div>
    <!-- aggiungi advertisements links se fai paginate, qui  -->
</x-layout>