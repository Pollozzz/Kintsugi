<footer class="footer-section">
    <div class="container">
        {{-- Inizio Contatti --}}
        <div class="footer-cta py-5">
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="single-cta">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-geo-alt color-a  mb-4" viewBox="0 0 16 16">
                            <path
                                d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                        <div class="cta-text">
                            <h4>{{ __('ui.address') }}</h4>
                            <span>Via Washington 35, Pizzo Calabro</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="single-cta ms-lg-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-telephone color-a mb-4" viewBox="0 0 16 16">
                            <path
                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                        </svg>
                        <div class="cta-text">
                            <h4>{{ __('ui.callUs') }}</h4>
                            <span>333 3333333</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="single-cta">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-envelope-open color-a mb-4" viewBox="0 0 16 16">
                            <path
                                d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882zM15 7.383l-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765z" />
                        </svg>
                        <div class="cta-text">
                            <h4>{{ __('ui.contactUs') }}</h4>
                            <span>kintsugi@gmail.test</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Inizio Logo/Link utili/Invio Email --}}
        <div class="footer-content py-5">
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="{{ route('welcome') }}"><img src="{{ asset('media/Logo.png') }}" width="150px"
                                    height="150px" class=" p-1 rounded" alt="Logo"></a>
                        </div>
                        <div class="footer-text">
                            <p>{{ __('ui.marketplaceDescription') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="footer-widget ms-lg-5">
                        <div class="footer-widget-heading">
                            <h3>{{ __('ui.usefulLinks') }}</h3>
                        </div>
                        <ul class="ps-0">
                            <li><a href="{{ route('welcome') }}">{{ __('ui.home') }}</a></li>
                            <li><a href="{{ route('advertisement.index') }}">{{ __('ui.listings') }}</a></li>
                            <li><a href="{{ route('login') }}">{{ __('ui.login') }}</a></li>
                            <li><a href="{{ route('register') }}">{{ __('ui.register') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    @if (Auth::check() && Auth::user()->is_revisor)
                        <img src="{{ asset('media/badge.svg') }}" class="footer-revisor-badge ms-5" alt="">
                    @else
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>{{ __('ui.wouldYouLikeToReview') }}</h3>
                            </div>
                            <div class="footer-text mb-25">
                                <p>{{ __('ui.reviewerRequestIntro') }}</p>
                            </div>
                            <a href="{{ route('become.revisor') }}" class="btn bg-a" data-bs-theme="light">
                                {{ __('ui.becomeReviewer') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Copyright --}}
    <div class="copyright-area">
        <div class="copyright-text text-center">
            <p>Copyright &copy; 2026, {{ __('ui.allRightsReserved') }}</p>
        </div>
    </div>
</footer>
