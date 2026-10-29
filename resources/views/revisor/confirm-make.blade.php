<x-layout>
    <main class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="card border-0 shadow-sm text-center p-4">
                <h1 class="h4 mb-2">{{ __('ui.makeReviewer') }}</h1>
                <p class="text-muted small mb-4">{{ __('ui.makeUserReviewer') }}</p>

                <p class="mb-4">
                    <span class="d-block fw-semibold">{{ $user->name }}</span>
                    <span class="text-muted small">{{ $user->email }}</span>
                </p>

                <form method="POST" action="{{ request()->fullUrl() }}"
                    class="d-grid gap-2" onsubmit="this.querySelector('button').disabled = true">
                    @csrf
                    <button type="submit" class="btn bg-a fw-semibold">{{ __('ui.makeReviewer') }}</button>
                    <a href="{{ url('/') }}" class="btn btn-link text-muted btn-sm">{{ __('ui.cancel') }}</a>
                </form>
            </div>
        </div>
    </main>
</x-layout>