<!-- The Renovation Section -->
<section class="renovation section-gap pt-0">
@foreach (aboutUs() as $key => $item)
    <div class="py-3">
        <div class="container">
            <div class="row {{ $loop->iteration % 2 == 0 ? 'flex-lg-row-reverse' : '' }}">
                <div class="col-xl-5 col-lg-6 col-md-4">
                    <img src="{{asset('uploads/about_us')}}/{{ $item->image }}" alt="teamwork" class="img-fluid rounded p-xl-4" loading="lazy">
                </div>
                <div class="col-xl-7 col-lg-6 col-md-8 d-flex align-items-center">
                    <div class="{{ $loop->iteration % 2 ? 'pl-xl-5' : 'pr-xl-5' }} pt-4 pt-md-0">
                        <div class="section-header">
                            <div class="section-header">
                                <h4>UN SUIVI DE A À Z</h4>
                                <h1 class="section-header__title">
                                    <strong class="font-weight-bold">{{ $item->title }}</strong>
                                </h1>
                            </div>
                        </div>
                        <p class="mb-4">{{ $item->details }}</p>
                        <a href="https://calendly.com/novecology/cag" target="_blank" class="gradient-btn--secondary border-0 position-relative d-inline-block rounded-pill">Prendre rendez-vous 📆</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

</section>
