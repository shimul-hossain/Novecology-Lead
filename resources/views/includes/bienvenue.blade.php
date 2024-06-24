<!-- About Section -->
<section class="about section-gap text-center">
    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="col-lg-11">
                <div class="section-header ">
                    <h1 class="section-header__title section-header__title--lg position-relative d-inline-block">Bienvenue</h1>
                </div>
                <p class="about__text">{{ bienvenue()->bienvenue_text }}</p>
            </div> --}}
            <div class="col-lg-8 mt-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ bienvenue()->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
