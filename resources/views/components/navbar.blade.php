@props(['categories' => \App\Models\Category::all()])

<nav class="navbar navbar-expand-lg navbar-cus px-3" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand fs-2" href="{{ route('welcome') }}">
            <div style="width: 82px; height: 82px; overflow: hidden; position: relative;">
                <img src="{{ asset('media/Logo.png') }}" width="100" height="100"
                    class="p-1 rounded" alt="Logo"
                    style="max-width: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="{{ __('ui.toggleNavigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('welcome') }}">{{ __('ui.home') }}</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('advertisement.create') ? 'active' : '' }}"
                        href="{{ route('advertisement.create') }}">{{ __('ui.addListing') }}</a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('advertisement.index') ? 'active' : '' }}"
                        href="{{ route('advertisement.index') }}">{{ __('ui.listings') }}</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ __('ui.categoryMenu') }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                        <li><a class="dropdown-item text-capitalize"
                                href="{{ route('categories.show', ['category' => $category]) }}">{{ __('ui.' . $category->name) }}</a>
                        </li>
                        @if (!$loop->last)
                        <hr class="dropdown-divider">
                        @endif
                        @endforeach
                    </ul>
                </li>
                <!-- Accesso revisor reviews -->
                @auth
                @if (auth()->user()->is_revisor)
                <li class="nav-item">
                    <a class="nav-link reviewer-dashboard-link position-relative" href="{{ route('revisor.index') }}">
                        <span>{{ __('ui.reviewerDashboard') }}</span>
                        @livewire('revisor-counter')
                    </a>
                </li>
                @endif
                @endauth
                <!-- Fine accesso revisor reviews -->

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @auth
                        {{ __('ui.greeting', ['name' => auth()->user()->name]) }}
                        @else
                        {{ __('ui.loginOrRegister') }}
                        @endauth
                    </a>
                    <ul class="dropdown-menu mt-3">
                        @guest
                        <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('ui.login') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('ui.register') }}</a></li>
                        @else
                        <li><a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">{{ __('ui.logout') }}</a>
                            <form action="{{ route('logout') }}" method="POST" id="form-logout" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </li>

                <li class="nav-item">
                    <form class="search-form d-flex align-items-center gap-2 ms-auto" role="search"
                        action="{{ route('advertisement.search') }}" method="GET">
                        <div class="group">
                            <button class="search-submit" type="submit" aria-label="{{ __('ui.search') }}">
                                <svg viewBox="0 0 24 24" aria-hidden="true" class="search-icon">
                                    <path
                                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                    </path>
                                </svg>
                            </button>

                            <input id="query" class="input mt-0" type="search" placeholder="{{ __('ui.searchListingPlaceholder') }}"
                                name="query" value="{{ request('query') }}" aria-label="{{ __('ui.searchListingLabel') }}" />
                            <button class="search-clear" type="button" aria-label="{{ __('ui.clearSearch') }}" hidden>
                                &times;
                            </button>
                        </div>
                        <div class="dropdown search-filter">
                            <button class="btn btn-outline-light btn-sm dropdown-toggle search-filter-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('ui.filters') }}
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end mt-3">
                                <li class="dropdown-item">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="field"
                                            id="searchAll" value="all"
                                            {{ request('field', 'all') === 'all' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="searchAll">{{ __('ui.all') }}</label>
                                    </div>

                                </li>
                                <li class="dropdown-item">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="field"
                                            id="searchTitle" value="title"
                                            {{ request('field') === 'title' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="searchTitle">{{ __('ui.titleOnly') }}</label>
                                    </div>

                                </li>
                                <li class="dropdown-item">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="field"
                                            id="searchCategory" value="category"
                                            {{ request('field') === 'category' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="searchCategory">{{ __('ui.categoryOnly') }}</label>
                                    </div>

                                </li>
                                <li class="dropdown-item">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="field"
                                            id="searchDescription" value="description"
                                            {{ request('field') === 'description' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="searchDescription">{{ __('ui.descriptionOnly') }}</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </li>
                {{-- barra ricerca con radio button  --}}

                <!-- scelta lingua -->
                <x-_locale />

            </ul>

        </div>
    </div>
</nav>