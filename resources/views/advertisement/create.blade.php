<x-layout>


    <div class="container py-5 mt-5">

        <div class="row justify-content-center align-items-center create-advertisement-layout">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow border-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">

                            <h1 class="ubuntu-bold">
                                {{ __('ui.createAdvertisement') }}
                            </h1>

                            <p class="text-muted">
                                {{ __('ui.createListingIntro') }}
                            </p>

                        </div>
                        <div class="">
                            <livewire:create-advertisement-form />
                        </div>

                    </div>
                </div>
            </div>





        </div>


    </div>











</x-layout>