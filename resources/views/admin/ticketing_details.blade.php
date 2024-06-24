@extends('layouts.master')


{{-- Title part  --}}
@section('title')
    Tickets
@endsection

@section('bodyBg')
secondary-bg
@endsection

@section('ticketing')
active
@endsection

@push('plugins-link')
    <link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/tagify/css/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/fancybox/jquery.fancybox.min.css') }}">
    <style>
        .form-control {
            border-color: #dddddd;
        }
    </style>
@endpush


{{-- Main content part  --}}
@section('content')
    <!-- Ticketing Section -->
    <section class="ticket-section">
        <div class="container-fluid">
            <div class="ticket-section-container">
                <div class="row">
                    <div class="col-12 d-flex flex-row-reverse align-item-center flex-wrap py-3">
                        <div class="ml-auto mb-1">
                            {{-- @if (checkAction(Auth::id(), 'ticketing', 'create') || role() == 's_admin')
                                <button type="button" class="ticket-main__chat-card__send-btn" data-toggle="modal" data-target="#createTicketModal">
                                    <i class="bi bi-plus-square-dotted"></i>
                                    <span class="pl-1">{{ __('Create New Ticket') }}</span>
                                </button>
                            @else
                                <button type="button" class="ticket-main__chat-card__send-btn">
                                    <span class="novecologie-icon-lock py-1"></span>
                                    <span class="pl-1">{{ __('Create New Ticket') }}</span>
                                </button>
                            @endif --}}
                        </div>
                        <h1 class="dashboard-title mr-auto mb-1">{{ __('Ticket Analytics') }}</h1>
                    </div> 
                </div> 
                <div class="row">
                    <div class="ticket-card-list-wrapper col-xl-3 col-lg-4 col-md-5">
                        <div class="ticket-card-searchbar-wrapper form-group mb-0">
                            <input type="search" class="form-control shadow-none bg-white ticket-card-searchbar" placeholder="Rechercher tickets">
                        </div>
                        {{-- <div class="ticket-card-searchbar-wrapper mt-1">
                            <button type="button" data-filter-type="open" class="ticketFilterbtn primary-btn primary-btn--primary rounded border-0 my-1">Ouvert</button>
                            <button type="button" data-filter-type="closed" class="ticketFilterbtn primary-btn primary-btn--primary rounded border-0 my-1">Cloturé</button>
                            <button type="button" data-filter-type="Administratif" class="ticketFilterbtn primary-btn primary-btn--primary rounded border-0 my-1">Admin</button>
                            <button type="button" data-filter-type="technique" class="ticketFilterbtn primary-btn primary-btn--primary rounded border-0 my-1">Tech</button>
                            <button type="button" data-filter-type="Financier" class="ticketFilterbtn primary-btn primary-btn--primary rounded border-0 my-1">Financier</button>
                        </div> --}}
                        <div class="row">
                            <div class="ticket-card-list-wrapper-inner col-12 pt-3">
                                <ul class="ticket-card-list"> 
                                    @php
                                        $created_at = \Carbon\Carbon::parse($single_ticket->created_at)->format('y-m-d');
                                    @endphp
                                    <li class="ticket-card-list__item">
                                        <div class="ticket-card-list__item__time">
                                            <small class="text-success">{{ \Carbon\Carbon::parse($single_ticket->created_at)->format('d/m/Y') }}</small>
                                            @if($single_ticket->close_at)
                                                <small class="text-danger">- {{ \Carbon\Carbon::parse($single_ticket->close_at)->format('d/m/Y') }}</small>
                                            @endif
                                        </div>
                                        <button data-filter-text="{{ $single_ticket->close_at ? 'closed':'open' }} {{ $single_ticket->ticket_type }} " class="ticket-card active" data-id="{{ $single_ticket->id }}" type="button" role="article">
                                            <span class="ticket-card__rings"></span>
                                            <div class="ticket-card__header">
                                                <div class="ticket-card__header__details">
                                                    <div class="ticket-card__header__details__icon">
                                                        <i class="bi bi-ticket-perforated"></i>
                                                    </div>
                                                    <strong class="ticket-card__header__details__text">{{ __('Ticket') }} :</strong>
                                                    <span class="ticket-card__header__details__id">{{ $single_ticket->ticket_number }}</span>
                                                </div> 
                                                <span type="button" class="ticket-card__header__time border bg-white rounded" style="color: {{ $single_ticket->ticket_type == 'Administratif'? "#FF33FF": ($single_ticket->ticket_type == 'Technique'? "#B45F06":($single_ticket->ticket_type == 'Financier'? "#38761D":''))  }}">{{ $single_ticket->ticket_type }}</span>
                                            </div>
                                            <div class="ticket-card__body">
                                                {{-- @if($single_ticket->close_at)
                                                    <p class="ticket-card__text">Ouvert : {{ \Carbon\Carbon::parse($single_ticket->created_at)->format('d/m/Y') }} ({{ $single_ticket->deadline }} jours)</p>
                                                    <p class="ticket-card__text">Fermé : {{ \Carbon\Carbon::parse($single_ticket->close_at)->format('d/m/Y') }} 
                                                        @if (\Carbon\Carbon::parse($created_at)->diffInDays($single_ticket->close_at) > $single_ticket->deadline)
                                                            <span class="text-danger">(+ {{ \Carbon\Carbon::parse($created_at)->diffInDays($single_ticket->close_at) - $single_ticket->deadline }} jours)</span>
                                                        @endif
                                                    </p>
                                                @else
                                                    <p class="ticket-card__text">Ouvert : {{ \Carbon\Carbon::parse($single_ticket->created_at)->format('d/m/Y') }} ({{ $single_ticket->deadline }} jours)</p>
                                                    <p class="ticket-card__text">Echéance : {{ \Carbon\Carbon::parse($single_ticket->created_at)->addDays($single_ticket->deadline)->format('d/m/Y') }} 
                                                        @if (\Carbon\Carbon::parse($created_at)->diffInDays(\Carbon\Carbon::today()) > $single_ticket->deadline)
                                                            <span class="text-danger">
                                                                (+ {{ \Carbon\Carbon::parse($created_at)->diffInDays(\Carbon\Carbon::today()) - $single_ticket->deadline }} jours)
                                                            </span>
                                                        @else
                                                            <span>
                                                                ({{ $single_ticket->deadline - \Carbon\Carbon::parse($created_at)->diffInDays(\Carbon\Carbon::today()) }} jours)
                                                            </span>
                                                            
                                                        @endif
                                                    </p>
                                                @endif --}}
                                                <h3 class="ticket-card__title">{{ $single_ticket->project->Prenom.' '.$single_ticket->project->Nom }}</h3>
                                                <p class="ticket-card__text"> {{ $single_ticket->problem->name ?? '' }}</p>
                                            </div>
                                            <div class="ticket-card__footer">
                                                <a href="#!" class="ticket-card__footer__user">
                                                    <div class="ticket-card__footer__user__avatar">
                                                        @if ($single_ticket->openby->profile_photo)
                                                            <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $single_ticket->openby->profile_photo }}"  class="ticket-card__footer__user__avatar__image">
                                                        @else
                                                            <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}"  class="ticket-card__footer__user__avatar__image">
                                                        @endif
                                                    </div>
                                                    <span class="ticket-card__footer__user__avatar__name">{{ $single_ticket->openby->name ?? '' }}</span>
                                                </a>
                                                {{-- <ul class="ticket-card__footer__list nav">
                                                    <li class="ticket-card__footer__list__item">
                                                        <i class="bi bi-paperclip"></i>
                                                        <span class="ticket-card__footer__list__item__text">2</span>
                                                    </li>
                                                    <li class="ticket-card__footer__list__item">
                                                        <i class="bi bi-chat"></i>
                                                        <span class="ticket-card__footer__list__item__text">4</span>
                                                    </li>
                                                </ul> --}}
                                            </div>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ticket-main-wrapper col-md" id="ticketMessageBody"> 
                        @if ($single_ticket)
                            @include('admin.ticket_message_body')
                        @endif 
                    </div>
                </div>
            </div>
        </div>
    </section> 
@endsection

@push('plugins-script')
    <script src="{{ asset('crm_assets/assets/plugins/tagify/js/tagify.min.js') }}"></script> 
    <script src="{{ asset('crm_assets/assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
@endpush

@push('js')
    <script>               
        function chatCardHeightMeasure(){
            $(".ticket-main__chat-card__body").attr({
                style: `
                    --chat-header: ${$('.ticket-main__chat-card__header').outerHeight()}px;
                    --chat-footer: ${$('.ticket-main__chat-card__footer').outerHeight()}px;
                `
            });
            $(".ticket-main").attr({
                style: `
                    --chat-main: ${$('.ticket-main').outerHeight()}px;
                `
            });
            // $(".ticket-main__aside").attr({
            //     style: `
            //         --ticket-aside-header: ${$('.ticket-main__aside__header').outerHeight()}px;
            //     `
            // });
        };
        $('[data-fancybox="gallery"]').fancybox({
            buttons : [
                'download', 
                'close'
            ]
        });
        var tag_user_list = [
            @foreach ($users as $user)
                { id:"{{ $user->id }}", value:'{{ $user->name }}', title:'{{ $user->name }}'}, 
            @endforeach 
        ] 

        function tagifyInput(){ 
            // initialize Tagify
            var input = document.querySelector('.tagifyInput'),
                
                // init Tagify script on the above inputs
                tagify = new Tagify(input, {
                //  mixTagsInterpolator: ["{{", "}}"],
                    mode: 'mix',  // <--  Enable mixed-content
                    pattern: /@/,  // <--  Text starting with @ or # (if single, String can be used here)

                    whitelist: tag_user_list.map(function(item){ return typeof item == 'string' ? {value:item} : item}),

                    dropdown : {
                        enabled: 1,
                        position: "text",
                        highlightFirst: true  // automatically highlights first sugegstion item in the dropdown
                    }
                })


            tagify.on('input', function(e){
                var prefix = e.detail.prefix;

                if( prefix ){
                    if( prefix == '@' )
                        tagify.whitelist = tag_user_list; 

                    if( e.detail.value.length > 1 )
                        tagify.dropdown.show.call(tagify, e.detail.value);
                }
            })
        }

        tagifyInput();
        $(window).on('load', function () {
            /* List Animation function */
            setTimeout(() => {
                $(".ticket-card-list").addClass("loaded");
            }, 1000);

            $(".ticket-card-list-wrapper").attr({
                style: `
                    --ticket-main-height: ${$('.ticket-main').outerHeight()}px;
                `
            });

            chatCardHeightMeasure();
        });

        $(window).on("resize", function(){
            chatCardHeightMeasure();
        });

        $(document).ready(function () {
            /* Active toggler from ticket cards function */
            // $(document).on("click", ".ticket-card", function(){
            //     $(".ticket-card").removeClass("active");
            //     $(this).addClass("active");
            //     var id = $(this).data('id');
            //     $(".ticket-card-list-wrapper").addClass("hide");
            //     $(".ticket-main-wrapper").addClass("show");
            //     $.ajax({
            //         type : "POST", 
            //         url : "{{ route('ticket.sidebar.change') }}", 
            //         data : {
            //             id : id
            //         }, 
            //         success : function(response){
            //             $('#ticketMessageBody').html(response);
            //             $('.select2_select_option').select2();
            //             chatCardHeightMeasure();
            //             $(".ticket-card-list-wrapper").attr({
            //                 style: `
            //                     --ticket-main-height: ${$('.ticket-main').outerHeight()}px;
            //                 `
            //             });
            //         }
            //     }) 
            // });
            $(document).on("submit", "#ticketSendForm", function(e){
                e.preventDefault();
                $("#TicketMessageStoreModal").modal('hide');
                $.ajax({
                    type : "POST", 
                    url : "{{ route('ticket.message.store') }}", 
                    processData: false,
                    contentType: false,
                    data : new FormData($('#ticketSendForm')[0]), 
                    success : function(response){
                        $('#ticketMessageBody').html(response);
                        $('.select2_select_option').select2();
                        chatCardHeightMeasure();
                        tagifyInput();
                        $('[data-fancybox="gallery"]').fancybox({
                            buttons : [
                                'download', 
                                'close'
                            ]
                        });
                    },
                    error : function(err){
                        $('#errorMessage').text(err.responseJSON.errors['message']);
				        $('.toast.toast--error').toast('show');  
                        $('body .ticket-main__chat-card__form__textarea').focus();
                    }
                }) 
            });

            $(document).on("submit", ".ticketAssignUpdateForm", function(e){
                e.preventDefault();
                $('body #assignAgentModal').modal('hide');
                $.ajax({
                    type : "POST", 
                    url : "{{ route('ticket.assign.update') }}", 
                    processData: false,
                    contentType: false,
                    data : new FormData($('.ticketAssignUpdateForm')[0]), 
                    success : function(response){
                        $('#ticketMessageBody').html(response.data);
                        $('.select2_select_option').select2();
                        chatCardHeightMeasure();
                        // tag_user_list = [];
                        // response.assigned_users.forEach(function(item){ 
                        //     tag_user_list.push({ id:item.id, value:item.name, title:item.name});
                        // });  
                        tagifyInput();
                        $('[data-fancybox="gallery"]').fancybox({
                            buttons : [
                                'download', 
                                'close'
                            ]
                        });
                    } 
                }) 
            });

            $(document).on("click", ".ticket-main__aside__open", function(){
                $(this).addClass("d-none");
                $(this).closest(".ticket-main").find(".ticket-main__aside").removeClass("d-none");
                $(this).closest(".ticket-main").find(".ticket-main__chat-card").addClass("overlay");
                chatCardHeightMeasure();
            });

            $(document).on("click", ".ticket-main__aside__close", function(){
                $(this).closest(".ticket-main__aside").addClass("d-none");
                $(this).closest(".ticket-main").find(".ticket-main__chat-card__header .ticket-main__aside__open").removeClass("d-none");
                $(this).closest(".ticket-main").find(".ticket-main__chat-card").removeClass("overlay");
            });


            /* Submit Comment with keyboard Enter Key function */
            $(document).on("keypress", ".ticket-main__chat-card__form__textarea", function (e) {
                if(e.which === 13 && !e.shiftKey && !e.altKey && !e.ctrlKey ) {
                    e.preventDefault();
                    $(this).closest("form").submit();
                }
            });

             /* Scroll to Bottom function */
            // $(".ticket-main__chat-card__body__scroller").animate({
            //     scrollTop: $('.ticket-main__chat-card__body__list').prop("scrollHeight")
            // }, 1000);

            $(document).on("click", ".ticket-main__close", function(){
                $(".ticket-card-list-wrapper").removeClass("hide");
                $(".ticket-main-wrapper").removeClass("show");
            });

            $('#ticketClient').change(function(e){
                var id = $(this).val();
                if(id != ''){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST", 
                    url:"{{ route('event.client.project') }}",
                    data: {
                        client_id	:id, 
                    },

                    success: function(data){
                        $('#ticketProject').html(data);
                    }, 
                }); 
                } 
            });

            $('#ticketStatus').change(function(){
                $('#ticketDeadline').val($(this).find(':selected').data('deadline'));
            });
      
            /* Ticket Card Search Function */
            $(".ticket-card-searchbar").on("input", function(){
                let searchValue = $(this).val().toLowerCase(); 
                $(".ticket-card-list__item").filter(function(){
                    $(this).toggle($(this).find(".ticket-card").text().toLowerCase().indexOf(searchValue) > -1)
                });
            });

            $(".ticketFilterbtn").on("click", function(){ 
                let searchValue = $(this).data('filter-type'); 
                console.log(searchValue);
                $(".ticket-card-list__item").filter(function(){
                    $(this).toggle($(this).find(".ticket-card").data('filter-text').toLowerCase().indexOf(searchValue) > -1)
                });
            });
        });
    </script>
@endpush