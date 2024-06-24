<!-- Simulate Project Modal -->
<div class="modal fade" id="simulateProjectModal" tabindex="-1" aria-labelledby="simulateProjectModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <div class="section-header flex-grow-1 text-center mb-3">
                    <h3 class="section-header__title section-header__title--lg">
                        <strong class="d-block font-weight-bold">Je simule mon projet</strong>
                    </h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form method="post" action="{{ route('frontend.simulate_project') }}" class="modal-form needs-validation" novalidate>
                                @csrf
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="form-group position-relative">
                                            <input name="first_name" type="text" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Prénom*" required>
                                            <div class="invalid-tooltip">Ce champ est nécessaire</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input name="second_name" type="text" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Nom">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group position-relative">
                                            <input  type="email" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Adresse email" required>
                                            <div class="invalid-tooltip">Ce champ est nécessaire</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group position-relative">
                                            <input  name="phone" type="tel" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Téléphone" required>
                                            <div class="invalid-tooltip">Ce champ est nécessaire</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group position-relative">
                                            <input name="address" type="text" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Ville" required>
                                            <div class="invalid-tooltip">Ce champ est nécessaire</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group position-relative">
                                            <input name="postal_code" type="text" class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0" placeholder="Code postal" required>
                                            <div class="invalid-tooltip">Ce champ est nécessaire</div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="simulateProjectCustomCheck1">
                                            <label class="custom-control-label" for="simulateProjectCustomCheck1">J'accepte que les informations recueillies par Novecology pour permettre la simulation de mon projet et la relation commerciale qui peut en découler</label>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="gradient-btn--secondary position-relative border-0 rounded-pill">Suivant</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


