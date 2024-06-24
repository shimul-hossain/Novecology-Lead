<section class="footer-contact section-gap">
    <div class="container">
        <div class="row flex-lg-row-reverse align-items-end">
            <div class="col-lg-4 footer-contact__shape text-center position-relative mb-5 mb-lg-0">
                <img src="{{ asset('frontend_assets/new/images/icon/bear-image.png') }}" alt="bear" height="300" draggable="false" loading="lazy" class="footer-contact__shape__image user-select-none">
                <a href="{{ route('new.home') }}" class="d-inline-block">
                    <img src="{{ asset('frontend_assets/new/images/logo/logo-main.png') }}" alt="logo" draggable="false" loading="lazy" class="img-fluid">
                </a>
                <strong class="strong text-primary">La rénovation énergétique pour tous</strong>
            </div>
            <div class="col-lg-8">
                <div class="schedule-form">
                    <div class="container-fluid">
                        <h1 class="schedule-form__title schedule-form__title--lg">Service de rappel gratuit</h1>
                        <h2 class="schedule-form__title mb-3">Appelez-nous au <a href="tel:+0972102972" class="link-highlight">01 87 66 57 30</a> ou remplissez le formulaire de contact.</h2>
                        <form action="javascript:void(0)" class="bannerForm">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="name" placeholder="Nom et prénom *" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email" placeholder="Email *" required> 
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <input type="number" class="form-control" name="phone" placeholder="Téléphone *" required>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-4">
                                    <div class="mb-3">
                                        <input type="date" class="form-control" name="date" placeholder="Date *" required>
                                    </div>
                                </div> --}}
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <select class="form-control" name="department" required>
                                            <option value="" disabled selected>Département *</option>
                                            <option value="01 - Ain - Bourg-en-Bresse">01 - Ain - Bourg-en-Bresse</option>
                                            <option value="02 - Aisne - Laon">02 - Aisne - Laon</option>
                                            <option value="03 - Allier - Moulins">03 - Allier - Moulins</option>
                                            <option value="04 - Alpes-de-Haute-Provence - Digne-les-bains">04 - Alpes-de-Haute-Provence - Digne-les-bains</option>
                                            <option value="05 - Hautes-alpes - Gap">05 - Hautes-alpes - Gap</option>
                                            <option value="06 - Alpes-maritimes - Nice">06 - Alpes-maritimes - Nice</option>
                                            <option value="07 - Ardèche - Privas">07 - Ardèche - Privas</option>
                                            <option value="08 - Ardennes - Charleville-Mézières">08 - Ardennes - Charleville-Mézières</option>
                                            <option value="09 - Ariège - Foix">09 - Ariège - Foix</option>
                                            <option value="10 - Aube - Troyes">10 - Aube - Troyes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <select class="form-control" name="travaux" required>
                                            <option value="" disabled selected>Type de travaux *</option>
                                            <option value="1">Chaudières à granulés</option>
                                            <option value="2">Pompes à chaleur air/eau</option>
                                            <option value="3">Système Solaire Combiné</option>
                                            <option value="4">Ballon Thermodynamique</option>
                                            <option value="5">Chauffe-eau solaire</option>
                                            <option value="6">Pompes à chaleur air/air</option>
                                            <option value="7">Rénovation globale d'une maison individuelle</option>
                                            <option value="8">VMC Double Flux</option>
                                            <option value="9">VMC SIMPLE Flux</option>
                                            <option value="10">Poêles à granulés</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <button type="submit" class="btn w-100 btn-primary text-uppercase bannerFormSubmitBtn" disabled>
                                            <small>Valider</small>
                                        </button> 
                                    </div>
                                </div>
                                <div class="col-lg-4 text-white">
                                    <a href="{{ route('droit.opposition') }}"><small class="fst-italic">Droit d’opposition</small></a>
                                </div>
                                <div class="col-12 d-none bannerFormSuccess"> 

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script_js')
<script>
    $(document).ready(function () {
		$('.bannerFormSubmitBtn').removeAttr('disabled');
        $('.bannerForm').removeClass('d-none');
		$('.bannerForm').on('submit', function(e){
            e.preventDefault();
            $(this).find('.bannerFormSuccess').addClass('d-none');
            let form_data = new FormData($(this)[0]);
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type : "POST",
                url  : "{{route('banner.form.store')}}",
                data : form_data,
                contentType: false,
				processData: false,
                success:  response => {
                    $('.bannerForm').trigger('reset');
                    if(response.success){
                        $(this).find('.bannerFormSuccess').removeClass('d-none');
                        $(this).find('.bannerFormSuccess').html(
							`<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Merci de vos informations, un expert vous recontactera rapidement
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>`);
                    }
                }
            });
        }); 
    });
</script>
@endpush
