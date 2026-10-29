<x-layout>

    <div class="container py-5">

        <div class="row justify-content-center align-items-center vh-100 mt-5">

            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow border-0">

                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">
                            <h1 class="ubuntu-bold">{{ __('ui.register') }}</h1>

                            <p class="text-muted">
                                {{ __('ui.registerIntro') }}
                            </p>
                        </div>


                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form method="POST" action="{{ route('register') }}">

                            @csrf


                            <div class="mb-3">

                                <label for="name" class="form-label">
                                    {{ __('ui.name') }}
                                </label>

                                <input type="text" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="{{ __('ui.enterName') }}" autofocus>

                            </div>


                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    {{ __('ui.email') }}
                                </label>

                                <input type="email" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="{{ __('ui.enterEmail') }}">

                            </div>


                            <div class="mb-3">

                                <label for="password" class="form-label">
                                    {{ __('ui.password') }}
                                </label>

                                <input type="password" id="password" name="password"
                                    placeholder="{{ __('ui.enterNewPassword') }}" autocomplete="new-password">

                            </div>


                            <div class="mb-4">

                                <label for="password_confirmation" class="form-label">
                                    {{ __('ui.confirmPassword') }}
                                </label>

                                <input type="password" id="password_confirmation"
                                    name="password_confirmation" placeholder="{{ __('ui.repeatPassword') }}"
                                    autocomplete="new-password">

                            </div>


                            <div class="d-grid">

                                <button type="submit" class="btn bg-s" data-bs-theme="dark">
                                    {{ __('ui.register') }}
                                </button>

                            </div>

                        </form>


                        <div class="text-center mt-4">

                            <span class="text-muted">
                                {{ __('ui.alreadyHaveAccount') }}
                            </span>

                            <a href="{{ route('login') }}" class="text-decoration-none">
                                {{ __('ui.login') }}
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layout>
