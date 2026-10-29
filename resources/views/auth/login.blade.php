<x-layout>

    <div class="container py-5">

        <div class="row justify-content-center align-items-center vh-100">

            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow border-0">

                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">

                            <h1 class="ubuntu-bold">
                                {{ __('ui.login') }}
                            </h1>

                            <p class="text-muted">
                                {{ __('ui.loginIntro') }}
                            </p>

                        </div>


                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form method="POST" action="{{ route('login') }}">

                            @csrf


                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    {{ __('ui.email') }}
                                </label>

                                <input type="email" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="{{ __('ui.enterEmail') }}" autofocus
                                    autocomplete="email">

                            </div>


                            <div class="mb-3">

                                <label for="password" class="form-label">
                                    {{ __('ui.password') }}
                                </label>

                                <input type="password" id="password" name="password"
                                    placeholder="{{ __('ui.enterPassword') }}" autocomplete="current-password">

                            </div>

                            <div class="d-grid">

                                <button type="submit" class="btn bg-s" data-bs-theme="dark">
                                    {{ __('ui.login') }}
                                </button>

                            </div>

                        </form>


                        <div class="text-center mt-4">

                            <span class="text-muted">
                                {{ __('ui.noAccountYet') }}
                            </span>

                            <a href="{{ route('register') }}" class="text-decoration-none">
                                {{ __('ui.register') }}
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layout>
