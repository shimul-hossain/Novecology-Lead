<!-- Footer Contact Section -->
<section class="footer-contact text-white section-gap">
    <div class="container">
        <div class="row justify-content-center justify-content-lg-between">
            <div class="col-lg-6 col-md-10 text-center text-lg-left pl-lg-5">
                <h1 class="footer-contact__title">Nos experts s'occupent de vos démarches, vous n'avez rien à faire.</h1>
                <p class="footer-contact__text">Faites appel à nos experts dès maintenant</p>
            </div>
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <a href="tel:{{ getFooter()->phone }}" class="footer-contact__link d-inline-block mb-3">{{ getFooter()->phone }}</a>
                <button data-toggle="modal" data-target="#calledBackModal" class="gradient-btn--primary border-0 position-relative d-inline-block rounded-pill">Je veux être rappelé</button>
            </div>
        </div>
    </div>
</section>







