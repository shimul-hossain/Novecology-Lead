@extends('frontend.new.app')

{{-- Site title  --}}
@section('title', "Estimer vos aides")

{{-- Meta Description --}}
@section('meta_description', 'Novecology website')

{{-- Meta facebook url  --}}
@section('fb_url', '')

{{-- Meta facebook title --}}
@section('fb_title', 'Estimer vos aides')

{{-- Meta facebook Description --}}
@section('fb_description', 'Novecology website')

{{-- Meta facebook image --}}
@section('fb_image', '')

{{-- Meta Twitter url  --}}
@section('twitter_url', '')

{{-- Meta Twitter title  --}}
@section('twitter_title', 'Estimer vos aides')

{{-- Meta Twitter description  --}}
@section('twitter_desciption', 'Novecology website')

{{-- Meta Twitter image  --}}
@section('twitter_image','')

{{-- menu active  --}}
@section('estimerVosAides','active')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('frontend_assets/new/css/chatbot.min.css') }}">
@endsection

@push('style_css')
<style>
    .chat__card--agent .chat__message::before{
        background-image: url('https://novecology.fr/frontend_assets/images/women-user.png');
    }
</style>
@endpush


@section('content')
    {{-- <div class="chat pt-3">
        <div class="chat__body">
            <div class="chat__card chat__card--agent">
                <div class="chat__message-wrapper" style="--index: 0">
                    <div class="chat__message">
                        <p>Bonjour et bienvenue sur Novecology.fr !</p>
                        <p>Je suis <strong>Jade</strong>, votre assistante virtuelle.</p>
                        <p class="mb-0">Je suis là pour vous aider à découvrir nos solutions de rénovation énergétique. Nous savons que les travaux de rénovation peuvent être coûteux, c'est pourquoi nous proposons une simulation pour calculer les aides financières auxquelles vous pouvez prétendre.</p>
                    </div>
                </div>
                <div class="chat__message-wrapper" style="--index: 1">
                    <div class="chat__message">
                        <p>Chez <strong>NOVECOLOGY</strong>, nous sommes spécialisés dans les travaux de rénovation énergétique pour aider les particuliers à réduire leur consommation d'énergie et leurs factures tout en préservant l'environnement.</p>
                        <p class="mb-0">Nous sommes là pour vous aider à comprendre les différentes aides auxquelles vous avez droit et vous accompagner dans votre projet.</p>
                    </div>
                </div>
                <div class="chat__message-wrapper" style="--index: 2">
                    <div class="chat__message">
                        <p>Pour mieux vous aider,</p>
                        <div class="chat__message__alert chat__message__alert--sky mb-2">Estimer mes aides pour rénover mon logement</div>
                        <div class="chat__message__alert chat__message__alert--sky">Découvrir un produits en particulier</div>
                    </div>
                </div>
                <div class="chat__message-wrapper" style="--index: 3">
                    <div class="chat__message">
                        <p>Pour mieux vous aider,</p>
                        <div class="chat__message__alert chat__message__alert--success">Découvrir un produits en particulier</div>
                    </div>
                </div>
                <div class="chat__message-wrapper" style="--index: 4">
                    <div class="chat__message">
                        <p>Pour mieux vous aider à calculer les aides auxquelles vous avez droit dans le cadre de votre projet de rénovation énergétique, je vais vous poser quelques questions pour déterminer votre éligibilité.</p>
                        <p>Nous allons effectuer des simulations pour déterminer si vous êtes éligible à MaPrimeRénov' et pour vous informer sur les montants auxquels vous pouvez prétendre. MaPrimeRénov' est une aide financière proposée par l'État pour aider les propriétaires à financer leurs travaux de rénovation énergétique. C'est une excellente opportunité pour vous aider à réaliser votre projet de rénovation tout en réduisant vos coûts.</p>
                        <p>Plus les informations sur votre situation seront précises, plus je serai en mesure de vous orienter vers les aides les plus adaptées à vos besoins.</p>
                        <p>Alors, n'hésitez pas à répondre aux questions pour obtenir une simulation précise et personnalisée de vos aides</p>
                        <strong>C’est parti</strong>
                    </div>
                </div>
                <div class="chat__message-wrapper" style="--index: 5">
                    <div class="chat__message">Votre logement se trouve t - il en Ile-De-France ?</div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="chat  pt-3">
        <div class="chat__body">
            <div class="chat__card chat__card--agent">
                <div class="chat__message-wrapper" style="--index: 0">
                    <div class="chat__message">
                        Bonjour et bienvenue sur Novecology.fr ! 
                        <br>
                        <br>
                        Je suis <strong>Jade</strong>, votre assistante virtuelle. 
                        <br>
                        <br>
                        Je suis là pour vous aider à découvrir nos solutions de rénovation énergétique. Nous savons que les travaux de rénovation peuvent être coûteux, c'est pourquoi nous proposons une simulation pour calculer les aides financières auxquelles vous pouvez prétendre. 
                    </div>
                </div> 
                <div class="chat__message-wrapper" style="--index: 1">
                    <div class="chat__message">
                        Chez <strong>NOVECOLOGY</strong>, nous sommes spécialisés dans les travaux de rénovation énergétique pour aider les particuliers à réduire leur consommation d'énergie et leurs factures tout en préservant l'environnement.  
                        <br>
                        <br>
                        Nous sommes là pour vous aider à comprendre les différentes aides auxquelles vous avez droit et vous accompagner dans votre projet.
                    </div>
                </div> 
                <div class="chat__message-wrapper" style="--index: 2">
                    <div class="chat__message w-100"> 
                       <div class="row justify-content-center mb-3">
                            <div class="col-10">
                                <p>Pour mieux vous aider, </p> 
                            </div>
                            <div class="col-10">
                                <button type="button" class="text-start form-btn w-100"  style="background-color: #A4C2F4">Estimer mes aides pour rénover mon logement </button> 
                            </div>
                            <div class="col-10">
                                <button type="button" class="text-start form-btn w-100 mt-2"  style="background-color: #A4C2F4">Découvrir un produits en particulier </button>
                            </div>
                       </div> 
                    </div>
                </div> 
                <div class="chat__message-wrapper" style="--index: 3">
                    <div class="chat__message w-100">
                       <p>Pour mieux vous aider, </p>
                       <br>
                       <div class="row justify-content-center mb-3">
                            <div class="col-10">
                                <button type="button" class="text-start form-btn w-100" style="background-color: #93C47D">Estimer mes aides pour rénover mon logement </button> 
                            </div> 
                       </div> 
                    </div>
                </div> 
                <div class="chat__message-wrapper" style="--index: 4">
                    <div class="chat__message">
                        Pour mieux vous aider à calculer les aides auxquelles vous avez droit dans le cadre de votre projet de rénovation énergétique, je vais vous poser quelques questions pour déterminer votre éligibilité.  
                        <br>
                        <br>
                        Nous allons effectuer des simulations pour déterminer si vous êtes éligible à MaPrimeRénov' et pour vous informer sur les montants auxquels vous pouvez prétendre. MaPrimeRénov' est une aide financière proposée par l'État pour aider les propriétaires à financer leurs travaux de rénovation énergétique. C'est une excellente opportunité pour vous aider à réaliser votre projet de rénovation tout en réduisant vos coûts.
                        <br>
                        <br>
                        Plus les informations sur votre situation seront précises, plus je serai en mesure de vous orienter vers les aides les plus adaptées à vos besoins.
                        <br>
                        <br>
                        Alors, n'hésitez pas à répondre aux questions pour obtenir une simulation précise et personnalisée de vos aides
                        <br>
                        <br>
                        <strong>C’est parti </strong>
                    </div>
                </div> 
                <div class="chat__message-wrapper" style="--index: 5">
                    <div class="chat__message">Votre logement se trouve t - il en Ile-De-France ?</div>
                </div>
                <div class="chat__message-wrapper" style="--index: 6">
                    <label class="option-btn" role="button">
                        <input class="option-btn__input" type="radio" data-response="1" value="Oui" data-toggle="message">
                        <span class="option-btn__text">Oui</span>
                    </label>
                    <label class="option-btn" role="button">
                        <input class="option-btn__input" type="radio" data-response="1" value="Non" data-toggle="message">
                        <span class="option-btn__text">Non</span>
                    </label>
                </div>
            </div>
            <div class="text-center d-flex flex-column align-items-center mt-5">
                <a href="{{ route('prendre.rdv') }}" class="form-btn d-inline-block w-100 mb-3" style="background-color: #EEEEEE; max-width: 200px;">Prendre rendez-vous</a>
                <a href="{{ route('estimer.vos.aides') }}" class="form-btn d-inline-block w-100" style="background-color: #F4CCCC; max-width: 200px;">Recommencez une <br> nouvelle simulation</a>
            </div>
        </div>
    </div>

@endsection

@section('plugin_js')

@endsection

@push('script_js')
<script>
    $(document).ready(function () {
        let selected_response = {};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".option-btn__input").each(function(index, item){
            item.checked = false;
        });

        $(document).on('change', '[data-toggle="message"]', function(){
            const currentParentElement  = $(this).closest(".chat__card");
            let response                = $(this).data('response');
            let value                   = $(this).val();
            selected_response[response] = value;
            $.ajax({
                type : "POST",
                url  : "{{ route('chatbot.option.click') }}",
                data : {response, value, selected_response},
                success : data => {
                    if(data.success){
                        currentParentElement.after(data.success);
                        $(this).closest(".chat__message-wrapper").remove();
                    }
                    if(data.error){
                        setTimeout(function(){
                            window.location.href = '/';
                        },3000)
                    }
                }
            });
        });

        $(document).on('submit', '#chatBotSubmitForm', function(){
            let first_name = $("#botFirstName").val();
            let last_name = $("#botLastName").val();
            let phone = $("#botTelephone").val();
            let email = $("#botEmail").val();

            $.ajax({
                type : "POST",
                url  : "{{ route('chatbot.data.store') }}",
                data : {first_name, last_name, phone, email, selected_response},
                success : data => {
                    setTimeout(function(){
                        window.location.href = '/';
                    },2000)
                }
            });
        });
    })
</script>
@endpush
