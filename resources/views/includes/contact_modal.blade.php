	<!-- Called Back Modal -->
	<div class="modal fade" id="calledBackModal" tabindex="-1" aria-labelledby="calledBackModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content border-0">
				<div class="modal-header border-0">
					<div class="section-header mb-3">
						<h3 class="section-header__title section-header__title--lg">
							<strong class="d-block font-weight-bold">Je souhaite être rappelé</strong>
							par un conseiller Novecology
						</h3>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-7">
								<form method="POST" action="{{route('frontend.contact')}}" class="modal-form needs-validation" novalidate>
                                    @csrf
									<div class="form-row">
										{{-- <div class="col-12 mb-4">
											<h4><strong class="primary-color">Vous êtes intéressé par ...</strong></h4>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="calledBackCustomCheck1">
												<label class="custom-control-label" for="calledBackCustomCheck1">Isoler ma maison</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="calledBackCustomCheck2">
												<label class="custom-control-label" for="calledBackCustomCheck2">Chauffer ma maison</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="calledBackCustomCheck3">
												<label class="custom-control-label" for="calledBackCustomCheck3">Chauffer l'eau de ma maison</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="calledBackCustomCheck4">
												<label class="custom-control-label" for="calledBackCustomCheck4">Ventiler ma maison</label>
											</div>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="calledBackCustomCheck5">
												<label class="custom-control-label" for="calledBackCustomCheck5">Bailleur, copropriété, EHPAD</label>
											</div>
										</div> --}}
										<div class="col-sm-6">
											<div class="form-group position-relative">
												<input name="first_name" type="text" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Votre prénom" required>
												<div class="invalid-tooltip">Ce champ est nécessaire</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<input name="second_name" type="text" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Votre nom">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group position-relative">
												<input name="email" type="email" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Adresse email" required>
												<div class="invalid-tooltip">Ce champ est nécessaire</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group position-relative">
												<input name="phone" type="text" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Votre téléphone" required>
												<div class="invalid-tooltip">Ce champ est nécessaire</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group position-relative">
												<input name="postal_code" type="text" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Votre code postal" required>
												<div class="invalid-tooltip">Ce champ est nécessaire</div>
											</div>
										</div>
										<div class="col-12 text-center">
											<button type="submit" class="gradient-btn--secondary position-relative border-0 rounded-pill">Envoyer</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<img src="{{ asset('frontend_assets/images/modal/mobile-novecology.svg')}}" alt="mobile image" class="modal__image d-none d-lg-block w-100 position-absolute" loading="lazy">
			</div>
		</div>
	</div>
