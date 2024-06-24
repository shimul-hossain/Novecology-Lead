<section class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center text-lg-left mb-3">
                <div class="section-header">
                    <h1 class="section-header__title section-header__title--lg">
                        Nos fournisseurs pour
                        <strong class="font-weight-bold d-block">éco-rénover votre logement</strong>
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach (suppliers() as $item)
            <div class="clients__card col-md-3 col-sm-4 col-6">
                <div class="clients__card__wrapper d-flex align-items-center justify-content-center bg-white h-100">
                    <img src="{{ asset('uploads/suppliers')}}/{{ $item->image }}" alt="clients logo" class="clients__card__image w-100">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>



