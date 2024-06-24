<!-- Banner Section -->
<section class="banner">
    <div class="banner__slider overflow-hidden">
        @foreach (banner()->take(1) as $key => $item)
        <div class="banner__slide">
            <div class="banner__slide__wrapper text-center position-relative" style="background-image: var(--gradient-overlay), url('{{ asset('uploads/banner') }}/{{ $item->banner_image }}')">
                {{-- <a href="{{ url('/') }}" class="banner__logo d-inline-block">
                    <img src="{{ asset('uploads/logo') }}/{{ logo()->image }}" alt="white logo image" class="banner__logo__image img-fluid">
                </a> --}}
                <h1 class="banner__title text-center">
                    {{ $item->first_line}}
                    <span class="font-weight-bolder d-block">{{ $item->second_line}}</span>
                </h1>
            </div>
        </div>
        @endforeach
    </div>
    <form action="#!" class="banner__form" id="bannerForm">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-3">Parlez de votre projet de rénovation énergétique avec un de nos experts</h4>
                </div>
                <div class="col-lg col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control shadow-none" name="name" placeholder="Nom et prénom *" required>
                    </div>
                </div>
                <div class="col-lg col-md-6">
                    <div class="form-group">
                        <input type="email" class="form-control shadow-none" name="email" placeholder="Email *" required>
                    </div>
                </div>
                <div class="col-lg col-md-6">
                    <div class="form-group">
                        <input type="number" class="form-control shadow-none" id="telephone" placeholder="Phone *" required>
                        <input type="hidden" name="phone" id="selectedTelephoneNumber" required>
                    </div>
                </div>
                <div class="col-lg col-md-6">
                    <div class="form-group">
                        <select class="form-control shadow-none" name="department" required>
                            <option value="" disabled="" selected="">Département*</option>
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
                            <option value="11 - Aude - Carcassonne">11 - Aude - Carcassonne</option>
                            <option value="12 - Aveyron - Rodez">12 - Aveyron - Rodez</option>
                            <option value="13 - Bouches-du-Rhône - Marseille">13 - Bouches-du-Rhône - Marseille</option>
                            <option value="14 - Calvados - Caen">14 - Calvados - Caen</option>
                            <option value="15 - Cantal - Aurillac">15 - Cantal - Aurillac</option>
                            <option value="16 - Charente - Angoulême">16 - Charente - Angoulême</option>
                            <option value="17 - Charente-maritime - La Rochelle">17 - Charente-maritime - La Rochelle</option>
                            <option value="18 - Cher - Bourges">18 - Cher - Bourges</option>
                            <option value="19 - Corrèze - Tulle">19 - Corrèze - Tulle</option>
                            <option value="2A - Corse-du-sud - Ajaccio">2A - Corse-du-sud - Ajaccio</option>
                            <option value="2B - Haute-Corse - Bastia">2B - Haute-Corse - Bastia</option>
                            <option value="21 - Côte-d'Or - Dijon">21 - Côte-d'Or - Dijon</option>
                            <option value="22 - Côtes-d'Armor - Saint-Brieuc">22 - Côtes-d'Armor - Saint-Brieuc</option>
                            <option value="23 - Creuse - Guéret">23 - Creuse - Guéret</option>
                            <option value="24 - Dordogne - Périgueux">24 - Dordogne - Périgueux</option>
                            <option value="25 - Doubs - Besançon">25 - Doubs - Besançon</option>
                            <option value="26 - Drôme - Valence">26 - Drôme - Valence</option>
                            <option value="27 - Eure - Évreux">27 - Eure - Évreux</option>
                            <option value="28 - Eure-et-loir - Chartres">28 - Eure-et-loir - Chartres</option>
                            <option value="29 - Finistère - Quimper">29 - Finistère - Quimper</option>
                            <option value="30 - Gard - Nîmes">30 - Gard - Nîmes</option>
                            <option value="31 - Haute-Garonne - Toulouse">31 - Haute-Garonne - Toulouse</option>
                            <option value="32 - Gers - Auch">32 - Gers - Auch</option>
                            <option value="33 - Gironde - Bordeaux">33 - Gironde - Bordeaux</option>
                            <option value="34 - Hérault - Montpellier">34 - Hérault - Montpellier</option>
                            <option value="35 - Île-et-vilaine - Rennes">35 - Île-et-vilaine - Rennes</option>
                            <option value="36 - Indre - Châteauroux">36 - Indre - Châteauroux</option>
                            <option value="37 - Indre-et-Loire - Tours">37 - Indre-et-Loire - Tours</option>
                            <option value="38 - Isère - Grenoble">38 - Isère - Grenoble</option>
                            <option value="39 - Jura - Lons-le-saunier">39 - Jura - Lons-le-saunier</option>
                            <option value="40 - Landes - Mont-de-Marsan">40 - Landes - Mont-de-Marsan</option>
                            <option value="41 - Loir-et-cher - Blois">41 - Loir-et-cher - Blois</option>
                            <option value="42 - Loire - Saint-Étienne">42 - Loire - Saint-Étienne</option>
                            <option value="43 - Haute-Loire - Le puy-en-Velay">43 - Haute-Loire - Le puy-en-Velay</option>
                            <option value="44 - Loire-atlantique - Nantes">44 - Loire-atlantique - Nantes</option>
                            <option value="45 - Loiret - Orléans">45 - Loiret - Orléans</option>
                            <option value="46 - Lot - Cahors">46 - Lot - Cahors</option>
                            <option value="47 - Lot-et-Garonne - Agen">47 - Lot-et-Garonne - Agen</option>
                            <option value="48 - Lozère - Mend">48 - Lozère - Mend</option>
                            <option value="49 - Maine-et-Loire - Angers">49 - Maine-et-Loire - Angers</option>
                            <option value="50 - Manche - Saint-Lô">50 - Manche - Saint-Lô</option>
                            <option value="51 - Marne - Châlons-en-champagne">51 - Marne - Châlons-en-champagne</option>
                            <option value="52 - Haute-marne - Chaumont">52 - Haute-marne - Chaumont</option>
                            <option value="53 - Mayenne - Laval">53 - Mayenne - Laval</option>
                            <option value="54 - Meurthe-et-Moselle - Nancy">54 - Meurthe-et-Moselle - Nancy</option>
                            <option value="55 - Meuse - Bar-le-duc">55 - Meuse - Bar-le-duc</option>
                            <option value="56 - Morbihan - Vannes">56 - Morbihan - Vannes</option>
                            <option value="57 - Moselle - Metz">57 - Moselle - Metz</option>
                            <option value="58 - Nièvre - Nevers">58 - Nièvre - Nevers</option>
                            <option value="59 - Nord - Lille">59 - Nord - Lille</option>
                            <option value="60 - Oise - Beauvais">60 - Oise - Beauvais</option>
                            <option value="61 - Orne - Alençon">61 - Orne - Alençon</option>
                            <option value="62 - Pas-de-calais - Arras">62 - Pas-de-calais - Arras</option>
                            <option value="63 - Puy-de-dôme - Clermont-Ferrand">63 - Puy-de-dôme - Clermont-Ferrand</option>
                            <option value="64 - Pyrénées-atlantiques - Pau">64 - Pyrénées-atlantiques - Pau</option>
                            <option value="65 - Hautes-Pyrénées - Tarbes">65 - Hautes-Pyrénées - Tarbes</option>
                            <option value="66 - Pyrénées-orientales - Perpignan">66 - Pyrénées-orientales - Perpignan</option>
                            <option value="67 - Bas-Rhin - Strasbourg">67 - Bas-Rhin - Strasbourg</option>
                            <option value="68 - Haut-Rhin - Colmar">68 - Haut-Rhin - Colmar</option>
                            <option value="69 - Rhône - Lyon">69 - Rhône - Lyon</option>
                            <option value="70 - Haute-Saône - Vesoul">70 - Haute-Saône - Vesoul</option>
                            <option value="71 - Saône-et-Loire - Mâcon">71 - Saône-et-Loire - Mâcon</option>
                            <option value="72 - Sarthe - Le Mans">72 - Sarthe - Le Mans</option>
                            <option value="73 - Savoie - Chambéry">73 - Savoie - Chambéry</option>
                            <option value="74 - Haute-Savoie - Annecy">74 - Haute-Savoie - Annecy</option>
                            <option value="75 - Paris - Paris">75 - Paris - Paris</option>
                            <option value="76 - Seine-maritime - Rouen">76 - Seine-maritime - Rouen</option>
                            <option value="77 - Seine-et-marne - Melun">77 - Seine-et-marne - Melun</option>
                            <option value="78 - Yvelines - Versailles">78 - Yvelines - Versailles</option>
                            <option value="79 - Deux-sèvres - Niort">79 - Deux-sèvres - Niort</option>
                            <option value="80 - Somme - Amiens">80 - Somme - Amiens</option>
                            <option value="81 - Tarn - Albi">81 - Tarn - Albi</option>
                            <option value="82 - Tarn-et-Garonne - Montauban">82 - Tarn-et-Garonne - Montauban</option>
                            <option value="83 - Var - Toulon">83 - Var - Toulon</option>
                            <option value="84 - Vaucluse - Avignon">84 - Vaucluse - Avignon</option>
                            <option value="85 - Vendée - La roche-sur-Yon">85 - Vendée - La roche-sur-Yon</option>
                            <option value="86 - Vienne - Poitiers">86 - Vienne - Poitiers</option>
                            <option value="87 - Haute-Vienne - Limoges">87 - Haute-Vienne - Limoges</option>
                            <option value="88 - Vosges - Épinal">88 - Vosges - Épinal</option>
                            <option value="89 - Yonne - Auxerre">89 - Yonne - Auxerre</option>
                            <option value="90 - Territoire de Belfort - Belfort">90 - Territoire de Belfort - Belfort</option>
                            <option value="91 - Essonne - Évry">91 - Essonne - Évry</option>
                            <option value="92 - Hauts-de-seine - Nanterre">92 - Hauts-de-seine - Nanterre</option>
                            <option value="93 - Seine-Saint-Denis - Bobigny">93 - Seine-Saint-Denis - Bobigny</option>
                            <option value="94 - Val-de-marne - Créteil">94 - Val-de-marne - Créteil</option>
                            <option value="95 - Val-d'Oise - Cergy Pontoise">95 - Val-d'Oise - Cergy Pontoise</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="form-group">
                        <select class="form-control shadow-none" name="travaux" required>
                            <option value="" disabled="" selected="">Type de travaux*</option>
                            @foreach ($travauxs as $travaux)
                                <option value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-auto text-center">
                    <button id="bannerFormSubmitBtn" type="submit" class="gradient-btn--secondary border-0 position-relative d-inline-block rounded-pill" disabled>Valider</button>
                </div>
                <div class="col-12 d-none" id="bannerFormSuccess">
                    <div class="alert alert-success text-center alert-dismissible fade show mt-3 mb-0" role="alert">
                        Merci de vos informations, un expert vous recontactera rapidement
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>


@push('custom-script')
<script>
    $(document).ready(function(){
        $('#bannerFormSubmitBtn').removeAttr('disabled');
        $('#bannerForm').removeClass('d-none');
        $('#bannerForm').on('submit', function(e){
            e.preventDefault();
            $('#bannerFormSuccess').addClass('d-none');
            let form_data = new FormData($('#bannerForm')[0]);
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
                success: function (response) {
                    $('#bannerForm').trigger('reset');
                    if(response.success){
                        $('#bannerFormSuccess').removeClass('d-none');
                    }
                }
            });
        });
    })

</script>
@endpush
