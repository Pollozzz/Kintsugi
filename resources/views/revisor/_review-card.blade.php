<div class="container py-3">
    <div class="row g-4 align-items-start">

        {{-- ===== Colonna sinistra: immagini + analisi ===== --}}
        <div class="col-12">
            <h2 class="h5 text-light mb-3">
                {{ $advertisement->title }}
                
            </h2>

        </div>
        <div class="col-12 col-lg-7">

            <div class="vstack gap-3">
                @forelse ($advertisement->images as $key => $image)
                @php
                $ratings = [
                'adult' => $image->adult,
                'violence' => $image->violence,
                'spoof' => $image->spoof,
                'racy' => $image->racy,
                'medical' => $image->medical,
                ];
                @endphp

                <div class="card bg-dark text-light border-secondary shadow-sm overflow-hidden">
                    <div class="row g-0">
                        {{-- Immagine cliccabile per ingrandire --}}
                        <div class="col-md-4">
                            <a href="{{ $image->getUrl() }}" target="_blank" rel="noopener"
                                class="d-flex h-100 align-items-center justify-content-center"
                                style="min-height: 220px;" title="{{ __('ui.openFullSize') }}">
                                <span class="watermarked-image-frame">
                                <img src="{{ $image->getUrl() }}"
                                    loading="lazy"
                                    style="max-width: 100%; max-height: 220px; width: auto; height: auto; object-fit: contain;"
                                    alt="Immagine {{ $key + 1 }} dell'articolo '{{ $advertisement->title }}'">
                                <img src="{{ asset('media/Logo.png') }}" class="image-watermark" alt="" aria-hidden="true">
                                </span>
                            </a>
                        </div>

                        <div class="col-md-8">
                            <div class="card-body">
                                {{-- Labels come badge --}}
                                <h3 class="h6 text-warning mb-2">Labels</h3>
                                @if ($image->labels)
                                <div class="d-flex flex-wrap gap-1 mb-3" style="max-height: 72px; overflow-y: auto;">
                                    @foreach ($image->labels as $label)
                                    <span class="badge rounded-pill text-bg-secondary fw-normal">#{{ $label }}</span>
                                    @endforeach
                                </div>
                                @else
                                <p class="fst-italic small text-muted mb-3">{{ __('ui.noLabels') }}</p>
                                @endif

                                {{-- Ratings: pallino + nome, in griglia compatta --}}
                                <h3 class="h6 text-warning mb-2">Ratings</h3>
                                <ul class="list-unstyled row row-cols-2 row-cols-sm-3 g-2 small mb-0">
                                    @foreach ($ratings as $name => $value)
                                    <li class="col d-flex align-items-center gap-2">
                                        <span class="rounded-circle d-inline-block flex-shrink-0 {{ $value }}"
                                            style="width: 14px; height: 14px;"
                                            role="img"
                                            aria-label="{{ $name }}"></span>
                                        <span class="text-light text-capitalize">{{ $name }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-5 border border-secondary border-dashed rounded">
                    <i class="bi bi-image fs-1 d-block mb-2"></i>
                    <p class="mb-0">{{ __('ui.noImageAvailable') }}</p>
                </div>
                @endforelse
            </div>

            {{-- Legenda dei colori: senza, i pallini non si capiscono --}}
            @if ($advertisement->images->isNotEmpty())
            <p class="small text-muted mt-3 mb-0">
                <i class="bi bi-info-circle me-1"></i>{{ __('ui.ratingLegend') }}
            </p>
            @endif
        </div>


        <div class="col-12 col-lg-5">
    <div class="sticky-lg-top" style="top: 1rem;">
        <div class="p-4 bg-dark rounded border border-secondary shadow">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge text-bg-info">{{ __('ui.' . $advertisement->category->name) }}</span>
                <span class="badge text-bg-secondary">
                    <i class="bi bi-images me-1"></i>{{ $advertisement->images->count() }}
                </span>
            </div>

            <h1 class="h3 text-light mb-2">{{ $advertisement->title }}</h1>

                    <p class="fs-3 fw-bold text-warning mb-3">
                        {{ number_format($advertisement->price, 2, ',', '.') }} €
                    </p>

                    <h2 class="h6 text-uppercase text-muted mb-1">{{ __('ui.description') }}</h2>
                    <p class="text-light mb-4" style="max-height: 220px; overflow-y: auto; white-space: pre-line;">{{ $advertisement->description }}</p>

                    {{-- Azioni --}}
                    <div class="d-flex flex-column flex-sm-row gap-2 pt-3 border-top border-secondary">
                        <button type="button"
                            wire:click="reject({{ $advertisement->id }})"
                            wire:confirm="{{ __('ui.confirmReject') }}"
                            wire:loading.attr="disabled"
                            wire:target="reject({{ $advertisement->id }}), approve({{ $advertisement->id }})"
                            class="btn btn-outline-danger flex-fill py-2 fw-semibold">
                            <span wire:loading.remove wire:target="reject({{ $advertisement->id }})">
                                <i class="bi bi-x-lg me-1"></i>{{ __('ui.reject') }}
                            </span>
                            <span wire:loading wire:target="reject({{ $advertisement->id }})">
                                <span class="spinner-border spinner-border-sm me-1" aria-hidden="true"></span>{{ __('ui.loading') }}
                            </span>
                        </button>

                        <button type="button"
                            wire:click="approve({{ $advertisement->id }})"
                            wire:loading.attr="disabled"
                            wire:target="reject({{ $advertisement->id }}), approve({{ $advertisement->id }})"
                            class="btn btn-success flex-fill py-2 fw-semibold">
                            <span wire:loading.remove wire:target="approve({{ $advertisement->id }})">
                                <i class="bi bi-check-lg me-1"></i>{{ __('ui.approve') }}
                            </span>
                            <span wire:loading wire:target="approve({{ $advertisement->id }})">
                                <span class="spinner-border spinner-border-sm me-1" aria-hidden="true"></span>{{ __('ui.loading') }}
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>