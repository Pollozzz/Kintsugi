<div>
    @if (session()->has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <form wire:submit="store">

                <div class="row g-3">
                    {{-- Lingua --}}
                    <div class="col-md-6">
                        <label for="language" class="form-label fw-semibold">{{ __('ui.advertisementLanguage') }}</label>
                        <select id="language" wire:model="language" class="form-select">
                            @foreach (['it', 'en', 'es'] as $languageCode)
                                <option value="{{ $languageCode }}">{{ __('ui.languageNames.' . $languageCode) }}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Categoria --}}
                    <div class="col-md-6">
                        <label for="category" class="form-label fw-semibold">{{ __('ui.category') }}</label>
                        <select id="category" wire:model="category" class="form-select">
                            <option value="" disabled selected>{{ __('ui.selectCategory') }}</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ __('ui.' . $cat->name) }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Titolo --}}
                    <div class="col-12">
                        <label for="title" class="form-label fw-semibold">{{ __('ui.title') }}</label>
                        <input id="title" type="text" wire:model.live="title" class="form-control">
                        @error('title')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Descrizione --}}
                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">{{ __('ui.description') }}</label>
                        <textarea id="description" wire:model.live="description" class="form-control" rows="4"></textarea>
                        @error('description')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Prezzo --}}
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-semibold">{{ __('ui.price') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
                            <input id="price" type="number" wire:model="price" min="0" step="0.01" class="form-control mt-0">
                        </div>
                        @error('price')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                {{-- inserimento immagini --}}
                <div class="mb-3">
                    <div class="image-upload-control d-flex flex-wrap align-items-center gap-3 p-3 border rounded-3 bg-body-tertiary"
                        wire:key="image-upload-control-{{ $imageUploadKey }}">
                        <label for="temporary_images" class="btn bg-s image-upload-label mb-0">
                            <i class="bi bi-images me-1"></i>{{ __('ui.selectImages') }}
                        </label>
                        <span class="image-upload-filename text-muted small" data-file-name
                            data-empty-label="{{ __('ui.noFileSelected') }}" aria-live="polite" wire:ignore>
                            {{ __('ui.noFileSelected') }}
                        </span>
                        <input id="temporary_images" type="file" wire:model="temporary_images" multiple class="visually-hidden"
                            accept="image/jpeg,image/png,image/gif,image/webp,image/bmp">
                    </div>

                    <small id="imageUploadHelp" class="form-text d-block mt-2">{{ __('ui.imageUploadLimit') }}</small>

                    @error('temporary_images')
                        <p class="fst-italic text-danger small mb-1">{{ $message }}</p>
                    @enderror
                    @error('images')
                        <p class="fst-italic text-danger small mb-1">{{ $message }}</p>
                    @enderror
                    @error('temporary_images.*')
                        <p class="fst-italic text-danger small mb-1">{{ $message }}</p>
                    @enderror
                    @error('images.*')
                        <p class="fst-italic text-danger small mb-1">{{ $message }}</p>
                    @enderror
                </div>

                
                @if (!empty($images))
                    <div class="mb-4">
                        <p class="fw-semibold mb-2">{{ __('ui.photoPreview') }}</p>
                        <div class="row g-3 p-3 border rounded-3 bg-body-tertiary">
                            @foreach ($images as $key => $image)
                                <div class="col-6 col-md-4 col-lg-3 d-flex justify-content-center">
                                    <div class="position-relative d-inline-block">
                                        <div class="img-preview shadow-sm rounded-3"
                                            style="background-image: url('{{ $image->temporaryUrl() }}');"></div>

                                        <button type="button"
                                            class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 m-1 d-flex align-items-center justify-content-center shadow"
                                            style="width: 28px; height: 28px; padding: 0;"
                                            wire:click="removeImage({{ $key }})"
                                            aria-label="Rimuovi immagine">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                {{-- Fine inserimento immagini --}}

                <div class="d-grid">
                    <button type="submit" class="btn bg-s btn-lg" data-bs-theme="dark">
                        <i class="bi bi-plus-circle me-1"></i>{{ __('ui.createListing') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>