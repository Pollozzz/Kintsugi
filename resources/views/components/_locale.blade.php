<li class="nav-item dropdown language-switcher p-0">
    @php($currentLocale = app()->getLocale())
    <button class="nav-link dropdown-toggle d-flex align-items-center gap-2" type="button"
        data-bs-toggle="dropdown" aria-expanded="false" aria-label="{{ __('ui.languageNames.' . $currentLocale) }}">
        <img src="{{ asset('vendor/blade-flags/country-' . ($currentLocale === 'en' ? 'gb' : $currentLocale) . '.svg') }}"
            width="24" height="24" alt="">
        <span>{{ __('ui.languageNames.' . $currentLocale) }}</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        @foreach (['it', 'en', 'es'] as $language)
            @if ($language !== $currentLocale)
                <li>
                    <form action="{{ route('setLocale', $language) }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2">
                            <img src="{{ asset('vendor/blade-flags/country-' . ($language === 'en' ? 'gb' : $language) . '.svg') }}"
                                width="24" height="24" alt="">
                            <span>{{ __('ui.languageNames.' . $language) }}</span>
                        </button>
                    </form>
                </li>
            @endif
        @endforeach
    </ul>
</li>