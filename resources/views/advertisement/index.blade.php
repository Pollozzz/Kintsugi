<x-layout>
    <div class="container py-5">
        
        <header class="home-advertisements-heading mt-5">
            <h2 class="pt-5">{{ __('ui.itemsForSale') }}</h2>
            @error('generico')
                <div class="alert alert-danger text-center shadow rounded w-50">{{ $message }}</div>
            @enderror
        </header>
        
            <div class="col-12">
                <x-category-nav :categories="$categories" />
                {{-- @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                @endforeach --}}

            </div>
        <div class="row ad-card-grid ad-card-grid--index g-3 mt-3">
            @forelse ($advertisements as $advertisement)
                <div class="col-6 col-md-3 ad-card-grid-item">
                    <div class="card ad-card">
                        <!-- ad-card-image rimosso dopo il crop delle immagini, check fe -->
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
                                {{ ($advertisement->description) }}
                                </p>
                                <p class="card-text ad-card-price">
                                {{ $advertisement->price }} €
                                </p>
                            </a>
                            <p class="card-text ad-card-category">{{ __('ui.' . $advertisement->category->name) }}</p>
                            <p class="ad-card-link"><a
                                    href="{{ route('advertisement.show', $advertisement) }}">{{ __('ui.viewListing') }}</a></p>
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
    <div class="d-flex justify-content-center mt-5">
        <div class="index-pagination my-5">
            {{ $advertisements->links('pagination.index') }}
        </div>
    </div>
</x-layout>
