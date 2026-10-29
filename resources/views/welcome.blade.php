<x-layout>


    <div class="snap-container bg-hero">

        <section class="hero-marketplace">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Messaggio Revisor error -->
                    @if (session()->has('errorMessage'))
                    <div class="alert alert-danger text-center shadow rounded w-50">
                        {{ session('errorMessage') }}
                    </div>
                    @endif
                    <!-- Fine Messaggio revisor error -->

                    {{-- snippet email  --}}
                    @if (session()->has('message'))
                    <div class="alert alert-success text-center shadow rounded w-50">
                        {{ session('message') }}
                    </div>
                    @endif
                    {{-- fine snippet email  --}}

                    @error('generico')
                    <div class="alert alert-danger text-center shadow rounded w-50">{{ $message }}</div>
                    @enderror

                    <!-- Testo della Hero -->
                    <div class="col-lg-7 hero-content">
                        <h1 class="hero-title">
                            {{ __('ui.everyItem') }}
                        </h1>
                        <h1 class="hero-title span-cust pb-3 px-2"> {{ __('ui.secondStory') }} </h1>

                        <p class="hero-description">
                            {{ __('ui.exploreUniqueFinds') }}
                        </p>

                        <div class="hero-actions">
                            <a href="{{ route('advertisement.index') }}" class="btn btn-hero-primary">
                                {{ __('ui.exploreListings') }}
                                <span aria-hidden="true">&rarr;</span>
                            </a>

                            <a href="{{ route('advertisement.create') }}" class="btn btn-hero-secondary ">
                                {{ __('ui.startSelling') }}
                            </a>
                        </div>

                        <p class="hero-caption">
                            {{ __('ui.goodPurchase') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="snap-section home-advertisements">
            <div class="container">
                <header class="home-advertisements-heading">
                    <h2>{{ __('ui.featuredListings') }}</h2>
                    <p>{{ __('ui.secondStoryListings') }}</p>
                </header>
                <div class="row ad-card-grid ad-card-grid--home g-3">
                    @forelse ($advertisements as $advertisement)
                    <div class="col-6 col-md-4 ad-card-grid-item">
                        <div class="card ad-card">
                            <a href="{{ route('advertisement.show', $advertisement) }}">
                                <span class="{{ $advertisement->images->isNotEmpty() ? 'watermarked-image-frame' : '' }}">
                                <img src="{{ $advertisement->images->isNotEmpty() ? $advertisement->images->first()->getUrl() : asset('media/Logo.png') }}"
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
                                        {{ Str::limit($advertisement->description, 50) }}
                                    </p>
                                    <span class="ad-card-price">{{ $advertisement->price }} €</span>
                                </a>
                                <div>
                                    <span class="ad-card-category">{{ __('ui.' . $advertisement->category->name) }}</span>
                                </div>
                                <a class="ad-card-link"
                                    href="{{ route('advertisement.show', $advertisement) }}">{{ __('ui.viewListing') }}</a>
                                {{-- <button type="submit" class="btn btn-sm ad-card-action" data-bs-theme="dark">
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
        </section>
    </div>
</x-layout>