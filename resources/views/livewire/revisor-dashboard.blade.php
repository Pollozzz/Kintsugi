<div>
    <div class="container-fluid mt-5 revisor-dashboard-container">

                <h1 class="revisor-dashboard-label">{{ __('ui.reviewerDashboard') }}</h1>
    
        @if (session()->has('message'))
            <div class="row justify-content-center">
                <div class="col-5 alert-success text-center shadow rounded">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <section class="snap-section home-advertisements py-5 mt-5 mt-md-0">
            <div class="container">
                <header class="home-advertisements-heading revisor-review-heading mt-5">
                    <h2 class="revisor-review-title">
                        <svg class="revisor-review-gears" viewBox="0 0 100 80" aria-hidden="true">
                            <g transform="translate(100 0) scale(-1 1)">
                                <path fill-rule="evenodd" d="M29.68 28.65 30.31 23.41 39.69 23.41 40.32 28.65 46.33 31.14 50.49 27.88 57.12 34.51 53.86 38.67 56.35 44.68 61.59 45.31 61.59 54.69 56.35 55.32 53.86 61.33 57.12 65.49 50.49 72.12 46.33 68.86 40.32 71.35 39.69 76.59 30.31 76.59 29.68 71.35 23.67 68.86 19.51 72.12 12.88 65.49 16.14 61.33 13.65 55.32 8.41 54.69 8.41 45.31 13.65 44.68 16.14 38.67 12.88 34.51 19.51 27.88 23.67 31.14Z M24 50a11 11 0 1 0 22 0 11 11 0 1 0-22 0Z" />
                                <path fill-rule="evenodd" d="M68.25 5.96 68.70 2.29 75.30 2.29 75.75 5.96 79.98 7.71 82.90 5.44 87.56 10.10 85.29 13.02 87.04 17.25 90.71 17.70 90.71 24.30 87.04 24.75 85.29 28.98 87.56 31.90 82.90 36.56 79.98 34.29 75.75 36.04 75.30 39.71 68.70 39.71 68.25 36.04 64.02 34.29 61.10 36.56 56.44 31.90 58.71 28.98 56.96 24.75 53.29 24.30 53.29 17.70 56.96 17.25 58.71 13.02 56.44 10.10 61.10 5.44 64.02 7.71Z M64.5 21a7.5 7.5 0 1 0 15 0 7.5 7.5 0 1 0-15 0Z" />
                            </g>
                        </svg>
                        {{ __('ui.reviewListings') }}
                    </h2>
                </header>
                @if ($advertisements_to_check->isNotEmpty())
                    <div id="pendingReviewCarousel" class="carousel slide pending-review-carousel py-4" data-bs-ride="false" data-bs-touch="true">
                        <div class="carousel-inner">
                            @foreach ($advertisements_to_check as $advertisement_to_check)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" wire:key="pending-advertisement-{{ $advertisement_to_check->id }}">
                                    @include('revisor._review-card', ['advertisement' => $advertisement_to_check])
                                </div>
                            @endforeach
                        </div>
                        <div class="container d-flex justify-content-center mt-3 gap-3">
                            <button class="carousel-control-prev position-static" type="button" data-bs-target="#pendingReviewCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">{{ __('pagination.previous') }}</span>
                            </button>
                            <button class="carousel-control-next position-static" type="button" data-bs-target="#pendingReviewCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">{{ __('pagination.next') }}</span>
                            </button>
                        </div>
                    </div>
                @else
                    <div class="rounded shadow bg-body-secondary p-3">
                        <h2 class="h4 text-center mb-0">{{ __('ui.noListingsToReview') }}</h2>
                    </div>
                @endif
            </div>
        </section>
        <section class="snap-section home-advertisements my-5">
            <div class="container">
                <header class="home-advertisements-heading revisor-review-heading">
                    <h2>{{ __('ui.allListings') }}</h2>
                </header>
                <div class="table-responsive py-4 mt-2">
                    <table class="table table-dark table-striped table-hover align-middle revisor-listings-table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('ui.title') }}</th>
                                <th scope="col">{{ __('ui.description') }}</th>
                                <th scope="col" class="revisor-listing-price">{{ __('ui.price') }}</th>
                                <th scope="col" class="revisor-listing-language">{{ __('ui.advertisementLanguage') }}</th>
                                <th scope="col">{{ __('ui.status') }}</th>
                                <th scope="col">{{ __('ui.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allAdvertisements as $advertisement)
                                <tr wire:key="advertisement-{{ $advertisement->id }}">
                                    <td>
                                        <a href="{{ route('revisor.show', ['advertisement' => $advertisement]) }}" class="revisor-listing-title">
                                            {{ $advertisement->title }}
                                        </a>
                                    </td>
                                    <td class="revisor-listing-description">{{ Str::limit($advertisement->description, 30) }}</td>
                                    <td class="revisor-listing-price">{{ $advertisement->price }} €</td>
                                    <td class="revisor-listing-language">{{ __('ui.languageNames.' . $advertisement->language) }}</td>
                                    <td>
                                        @if ($advertisement->is_accepted === null)
                                            <span class="badge text-bg-warning">{{ __('ui.pendingReview') }}</span>
                                        @elseif ($advertisement->is_accepted)
                                            <span class="badge text-bg-success">{{ __('ui.accepted') }}</span>
                                        @else
                                            <span class="badge text-bg-danger">{{ __('ui.rejected') }}</span>
                                        @endif
                                    </td>
                                    <td class="revisor-listing-actions">
                                        @if ($advertisement->is_accepted === null)
                                            <div class="d-flex gap-2">
                                                <button
                                                    type="button"
                                                    wire:click="reject({{ $advertisement->id }})"
                                                    wire:loading.attr="disabled"
                                                    wire:target="reject({{ $advertisement->id }})"
                                                    class="btn btn-sm revisor-action-button revisor-action-button--reject revisor-review-action-button"
                                                    aria-label="{{ __('ui.reject') }}"
                                                    title="{{ __('ui.reject') }}"
                                                >
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <button
                                                    type="button"
                                                    wire:click="approve({{ $advertisement->id }})"
                                                    wire:loading.attr="disabled"
                                                    wire:target="approve({{ $advertisement->id }})"
                                                    class="btn btn-sm revisor-action-button revisor-action-button--accept revisor-review-action-button"
                                                    aria-label="{{ __('ui.approve') }}"
                                                    title="{{ __('ui.approve') }}"
                                                >
                                                    <span aria-hidden="true">&#10003;</span>
                                                </button>
                                            </div>
                                        @else
                                            <div class="d-flex gap-2">
                                                <button
                                                    type="button"
                                                    wire:click="{{ $advertisement->is_accepted ? 'reject' : 'approve' }}({{ $advertisement->id }})"
                                                    wire:loading.attr="disabled"
                                                    wire:target="{{ $advertisement->is_accepted ? 'reject' : 'approve' }}({{ $advertisement->id }})"
                                                    class="btn btn-sm revisor-action-button revisor-review-action-button {{ $advertisement->is_accepted ? 'revisor-action-button--reject' : 'revisor-action-button--accept' }}"
                                                    aria-label="{{ $advertisement->is_accepted ? __('ui.reject') : __('ui.approve') }}"
                                                    title="{{ $advertisement->is_accepted ? __('ui.reject') : __('ui.approve') }}"
                                                >
                                                    <span aria-hidden="true">{{ $advertisement->is_accepted ? '×' : '✓' }}</span>
                                                </button>
                                                <button
                                                    type="button"
                                                    wire:click="sendBackToReview({{ $advertisement->id }})"
                                                    wire:loading.attr="disabled"
                                                    wire:target="sendBackToReview({{ $advertisement->id }})"
                                                    class="btn btn-sm revisor-action-button revisor-review-action-button revisor-action-button--pending"
                                                    aria-label="{{ __('ui.sendBackToReview') }}"
                                                    title="{{ __('ui.sendBackToReview') }}"
                                                >
                                                    <span aria-hidden="true">&#8635;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">{{ __('ui.noListingsAvailable') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
