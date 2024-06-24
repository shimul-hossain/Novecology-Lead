@php
    $created_at = \Carbon\Carbon::parse($single_ticket->created_at)->format('y-m-d');
@endphp
<div class="ticket-main">
    <div class="ticket-main__chat-card">
        <div class="ticket-main__chat-card__header">
            <div class="ticket-main__chat-card__header__top text-center d-sm-flex align-items-center justify-content-between">
                <button type="button" class="btn btn-flat-secondary ticket-main__close" title="Back">
                    <i class="bi bi-caret-left-fill"></i><span class="pl-1">{{ __('Back') }}</span>
                </button>
                @if(!$single_ticket->close_at)
                    @if (checkAction(Auth::id(), 'ticketing', 'close') || role() == 's_admin')
                        <button type="button" class="ticket-main__chat-card__close-btn" data-toggle="modal" data-target="#ticketCloseModal">
                            <span class="ticket-main__chat-card__send-btn__text">{{ __('Close Ticket') }}</span>
                            <i class="bi bi-ticket"></i>
                        </button>
                    @else
                        <button type="button" class="ticket-main__chat-card__close-btn">
                            <span class="novecologie-icon-lock py-1"></span>
                            <span class="ticket-main__chat-card__send-btn__text">{{ __('Close Ticket') }}</span>
                            <i class="bi bi-ticket"></i>
                        </button>
                    @endif
                @endif 
            </div>
            <div class="ticket-main__chat-card__header__bottom">
                <div class="ticket-main__chat-card__header__bottom__top align-items-center"> 
                    @if (role() == 's_admin')
                        <button type="button" data-toggle="modal" data-target="#TicketDeleteModal" class="btn shadow-none ticket-main__chat-card__header__badge ticket-main__chat-card__header__badge--danger m-1">Supprimer</button>
                    @endif
                    @if($single_ticket->close_at)
                        <span class="ticket-main__chat-card__header__badge ticket-main__chat-card__header__badge--danger m-1">{{ __('Closed') }}</span>
                    @else
                        <span class="ticket-main__chat-card__header__badge ticket-main__chat-card__header__badge--success m-1">{{ __('Open') }}</span>
                    @endif
                    @if (checkAction(Auth::id(), 'ticketing', 'assign') || role() == 's_admin')
                        <button type="button" class="ticket-main__chat-card__send-btn m-1" data-target="#assignAgentModal" data-toggle="modal">Attribuer un agent</button>
                    @else
                        <button type="button" class="ticket-main__chat-card__send-btn m-1"><span class="novecologie-icon-lock py-1 mr-1"></span>Attribuer un agent</button>
                    @endif
                    <a target="_blank" href="{{ route('files.index', $single_ticket->project_id) }}" class="ticket-main__chat-card__send-btn ml-auto m-1">Voir chantier</a>
                    <span>Échéance résolution ticket : <span class="ticket-main__chat-card__header__badge"> {{ $single_ticket->deadline }} jours</span></span>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4 col-md-6">
                        <div class="ticket-main__chat-card__header__bottom__left">
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">Nom :</h4> 
                                <span class="ticket-main__chat-card__header__bottom__block__text">{{ $single_ticket->project->Nom ?? '' }}</span>
                            </div> 
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">Prénom : </h4> 
                                <span class="ticket-main__chat-card__header__bottom__block__text">{{ $single_ticket->project->Prenom ?? '' }}</span>
                            </div> 
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">Telephone :</h4> 
                                <span class="ticket-main__chat-card__header__bottom__block__text"> {{ $single_ticket->project->phone ?? '' }}</span>
                            </div> 
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">Département :</h4> 
                                <span class="ticket-main__chat-card__header__bottom__block__text"> {{ getDepartment2($single_ticket->project->Code_Postal) }}</span>
                            </div> 
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">Travaux :</h4> 
                                <span class="ticket-main__chat-card__header__bottom__block__text">@foreach ($single_ticket->project->ProjectTravaux as $travaux)
                                    {{ $travaux->travaux }} {{ $loop->last ? '':', ' }}
                                @endforeach</span>
                            </div> 
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">TAG :</h4> 
                                <span class="ticket-main__chat-card__header__bottom__block__text">@foreach ($single_ticket->project->ProjectTravauxTags as $tag)
                                    {{ $tag->tag }} {{ $loop->last ? '':', ' }}
                                @endforeach</span>
                            </div> 
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">Statut installation<button data-toggle="modal" data-target="#statusEditModal" type="button" class="btn shadow-none"><i class="bi bi-pencil"></i>:</button></h4> 
                                <span class="ticket-main__chat-card__header__bottom__block__text">{{ $single_ticket->client_status }}</span>
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="ticket-main__chat-card__header__bottom__left">
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">{{ __('Type') }}:</h4>
                                <span class="ticket-main__chat-card__header__bottom__block__text">{{ $single_ticket->ticket_type }}</span>
                            </div>
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">{{ __('Problem') }}:</h4>
                                <span class="ticket-main__chat-card__header__bottom__block__text">{{ $single_ticket->problem->name ?? '' }}</span>
                            </div>
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">{{ __('Details') }}:</h4>
                                <span class="ticket-main__chat-card__header__bottom__block__text">{{ Str::words($single_ticket->details, 20, '...') }}</span>
                            </div>
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">Gestionnaire projet :</h4>
                                <span class="ticket-main__chat-card__header__bottom__block__text">
                                     {{ $single_ticket->project->projectGestionnaire ? ($single_ticket->project->projectGestionnaire->name ?? '') : '' }}
                                </span>
                            </div>
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">Telecommercial projet :</h4>
                                <span class="ticket-main__chat-card__header__bottom__block__text">
                                    {{ $single_ticket->project->getProjectTelecommercial ? ($single_ticket->project->getProjectTelecommercial->name ?? '') : '' }}
                                </span>
                            </div>
                            <div class="ticket-main__chat-card__header__bottom__block">
                                <h4 class="ticket-main__chat-card__header__bottom__block__title">{{ __('Assigned') }}:</h4>
                                <span class="ticket-main__chat-card__header__bottom__block__text">
                                    @foreach ($single_ticket->assignee as $assignee)
                                        {{ $assignee->name }} {{ $loop->last ? '' : ',' }}
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="ticket-main__chat-card__header__bottom__right">  
                                <div class="ticket-main__chat-card__header__bottom__block">
                                    <h4 class="ticket-main__chat-card__header__bottom__block__title">Ouvert Le:</h4>
                                    <span class="ticket-main__chat-card__header__bottom__block__text ticket-main__chat-card__header__bottom__block__text--highlight">{{ \Carbon\Carbon::parse($single_ticket->created_at)->format('d/m/Y') }} par <strong>{{ $single_ticket->openby->name }}</strong></span> 
                                </div>
                                <div class="ticket-main__chat-card__header__bottom__block d-flex align-items-center">
                                    <h4 class="ticket-main__chat-card__header__bottom__block__title">Ouvert depuis:</h4>
                                    <span class="badge--custom mb-0 ml-1" style="color: {{ \Carbon\Carbon::parse($created_at)->diffInDays(\Carbon\Carbon::today()) >= $single_ticket->deadline ? 'red':'green' }}">{{ \Carbon\Carbon::parse($created_at)->diffInDays(\Carbon\Carbon::today()) }} jours</span>
                                </div>
                                @if ($single_ticket->close_at)
                                    <div class="ticket-main__chat-card__header__bottom__block">
                                        <h4 class="ticket-main__chat-card__header__bottom__block__title">Cloturé le:</h4>
                                        <span class="ticket-main__chat-card__header__bottom__block__text ticket-main__chat-card__header__bottom__block__text--highlight">{{ \Carbon\Carbon::parse($single_ticket->close_at)->format('d/m/Y') }} par <strong>{{ $single_ticket->closeby->name }}</strong></span>
                                    </div>
                                @endif
                                <div class="ticket-main__chat-card__header__bottom__block">
                                    <h4 class="ticket-main__chat-card__header__bottom__block__title">Échéance le:</h4>
                                    <span class="ticket-main__chat-card__header__bottom__block__text ticket-main__chat-card__header__bottom__block__text--highlight">{{ \Carbon\Carbon::parse($single_ticket->created_at)->addDays($single_ticket->deadline)->format('d/m/Y') }}</span>  
                                </div>
                                <div class="ticket-main__chat-card__header__bottom__block d-flex align-items-center">
                                    <h4 class="ticket-main__chat-card__header__bottom__block__title">Échéance dans:</h4> 
                                    @if (\Carbon\Carbon::parse($created_at)->diffInDays(\Carbon\Carbon::today()) >= $single_ticket->deadline) 
                                        <span class="badge--custom mb-0 ml-1" style="color:red">+ {{ \Carbon\Carbon::parse($created_at)->diffInDays(\Carbon\Carbon::today()) - $single_ticket->deadline }} jours</span>
                                    @else
                                        <span class="badge--custom mb-0 ml-1" style="color:green">{{ $single_ticket->deadline - \Carbon\Carbon::parse($created_at)->diffInDays(\Carbon\Carbon::today()) }} jours</span>
                                    @endif
                                </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ticket-main__chat-card__body">
            <div class="ticket-main__chat-card__body__scroller">
                <div class="ticket-main__chat-card__body__list">
                    @foreach ($single_ticket->message as $message)
                        <div class="ticket-main__chat-card__body__list__item {{ $single_ticket->open_by == $message->user_id ? '':'ticket-main__chat-card__body__list__item--agent' }}">
                            <div class="ticket-main__chat-card__body__list__item__header">
                                <a href="#!" class="ticket-main__chat-card__body__list__item__header__user-meta">
                                    @if ($message->sender->profile_photo) 
                                        <img loading="lazy" src="{{ asset('uploads/crm/profiles') }}/{{ $message->sender->profile_photo }}" alt="user image" class="ticket-main__chat-card__body__list__item__header__user__image">
                                    @else
                                         <img loading="lazy" src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="user image" class="ticket-main__chat-card__body__list__item__header__user__image">
                                    @endif
                                    <span class="ticket-main__chat-card__body__list__item__header__user__name">{{ $message->sender->name }}</span>
                                </a>
                                <div class="d-md-inline">
                                    <span class="ticket-main__chat-card__body__list__item__header__text ticket-main__chat-card__body__list__item__header__text--muted">a répondu le</span>
                                    <span class="ticket-main__chat-card__body__list__item__header__text">{{ \Carbon\Carbon::parse($message->created_at)->locale('fr')->translatedFormat('d F Y') .' a '. \Carbon\Carbon::parse($message->created_at)->format('H:i') }}</span>
                                </div>
                                @if (role() == 's_admin')
                                    
                                    <button type="button" style="float: right" data-toggle="modal" data-target="#ticketingMessageDeleteModal{{ $message->id }}" class="btn btn-icon shadow-none">
                                        <i class="bi bi-trash3"></i>
                                    </button>  
                                    <div class="modal modal--aside fade" id="ticketingMessageDeleteModal{{ $message->id }}" tabindex="-1" aria-labelledby="TicketMessageStoreModal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0">
                                                <div class="modal-header border-0 pb-0">
                                                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                                        <span class="novecologie-icon-close"></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center pt-0">
                                                    <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                                                    <span>{{ __('Are You Sure To Delete this') }} ?</span>
                                                    <form action="{{ route('ticket.message.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $message->id }}">
                                                        <div class="d-flex justify-content-center">
                                                            <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                                                Annuler
                                                            </button>
                                                            <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                                                                Confirmer
                                                            </button>
                                                        </div>     
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="ticket-main__chat-card__body__list__item__body">
                                <p class="ticket-main__chat-card__body__list__item__body__text">{!! replace_urls_with_links($message->message) !!}</p>
                            </div>
                            @foreach ($message->file as $file) 
                                @if ($file->type == 'png' || $file->type == 'jpg' || $file->type == 'jpeg' || $file->type == 'gif')
                                    <a class="ml-3" href="{{ asset('uploads/crm/ticket_file') }}/{{ $file->name }}" data-fancybox="gallery" data-caption="{{ $file->name }}">
                                        <img loading="lazy" src="{{ asset('uploads/crm/ticket_file') }}/{{ $file->name }}" width="200"/>
                                    </a>
                                @endif 
                            @endforeach 
                            <div class="ticket-main__chat-card__body__list__item__footer">
                                @foreach ($message->file as $file)
                                    @if ($file->type != 'png' && $file->type != 'jpg' && $file->type != 'jpeg' && $file->type != 'gif')
                                        <a href="{{ asset('uploads/crm/ticket_file') }}/{{ $file->name }}" target="_blank" class="ticket-main__chat-card__body__list__item__footer__btn"> 
                                            <i class="bi bi-file-earmark-text-fill"></i>
                                            <span class="ticket-main__chat-card__body__list__item__footer__btn__text">{{ $file->name }}</span>
                                        </a>
                                        <a href="{{ asset('uploads/crm/ticket_file') }}/{{ $file->name }}" download="{{ $file->name }}" target="_blank" class="ticket-main__chat-card__body__list__item__footer__btn">
                                            <span class="ticket-main__chat-card__body__list__item__footer__btn__text"><i class="bi bi-download"></i></span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    {{-- 
                    <div class="ticket-main__chat-card__body__list__item ticket-main__chat-card__body__list__item--agent">
                        <div class="ticket-main__chat-card__body__list__item__header">
                            <a href="#!" class="ticket-main__chat-card__body__list__item__header__user-meta">
                                <img src="https://i.pravatar.cc/" alt="user image" class="ticket-main__chat-card__body__list__item__header__user__image">
                                <span class="ticket-main__chat-card__body__list__item__header__user__name">Agent Name</span>
                            </a>
                            <div class="d-md-inline">
                                <span class="ticket-main__chat-card__body__list__item__header__text ticket-main__chat-card__body__list__item__header__text--muted">replied on</span>
                                <span class="ticket-main__chat-card__body__list__item__header__text">July 5th, 2022 at 12:20am</span>
                            </div>
                            <span class="ticket-main__chat-card__body__list__item__header__badge">Support Agent</span>
                        </div>
                        <div class="ticket-main__chat-card__body__list__item__body">
                            <p class="ticket-main__chat-card__body__list__item__body__text">Hi. For the featured recipe banner feature, I'm able to enable it to show selected recipe and post on the feature recipe banner.
                                Is there any way the enable the feature banner to show recent recipe and post instead?
                                Thank you. 😊</p>
                        </div>
                        <div class="ticket-main__chat-card__body__list__item__footer"></div>
                    </div>
                    <div class="ticket-main__chat-card__body__list__item">
                        <div class="ticket-main__chat-card__body__list__item__header">
                            <a href="#!" class="ticket-main__chat-card__body__list__item__header__user-meta">
                                <img src="https://i.pravatar.cc/" alt="user image" class="ticket-main__chat-card__body__list__item__header__user__image">
                                <span class="ticket-main__chat-card__body__list__item__header__user__name">John Mayers</span>
                            </a>
                            <div class="d-md-inline">
                                <span class="ticket-main__chat-card__body__list__item__header__text ticket-main__chat-card__body__list__item__header__text--muted">replied on</span>
                                <span class="ticket-main__chat-card__body__list__item__header__text">July 5th, 2022 at 11:05pm</span>
                            </div>
                        </div>
                        <div class="ticket-main__chat-card__body__list__item__body">
                            <p class="ticket-main__chat-card__body__list__item__body__text">Hi. For the featured recipe banner feature, I'm able to enable it to show selected recipe and post on the feature recipe banner.
                                Is there any way the enable the feature banner to show recent recipe and post instead?
                                Thank you. 😊</p>
                        </div>
                        <div class="ticket-main__chat-card__body__list__item__footer">
                            <a href="https://www.clickdimensions.com/links/TestPDFfile.pdf" download="Bug Report.pdf" target="_blank" class="ticket-main__chat-card__body__list__item__footer__btn">
                                <i class="bi bi-file-earmark-text-fill"></i>
                                <span class="ticket-main__chat-card__body__list__item__footer__btn__text">Bug Report.pdf</span>
                            </a>
                            <a href="https://example-files.online-convert.com/document/txt/example.txt" download="Bug Example.txt" target="_blank" class="ticket-main__chat-card__body__list__item__footer__btn">
                                <i class="bi bi-file-earmark-text-fill"></i>
                                <span class="ticket-main__chat-card__body__list__item__footer__btn__text">Bug Example.txt</span>
                            </a>
                            <a href="https://i.pravatar.cc/" download="Error.png" target="_blank" class="ticket-main__chat-card__body__list__item__footer__btn">
                                <i class="bi bi-image-fill"></i>
                                <span class="ticket-main__chat-card__body__list__item__footer__btn__text">Error.png</span>
                            </a>
                        </div>
                    </div>
                    --}}
                </div>
            </div>
        </div>
        @if (checkAction(Auth::id(), 'ticketing', 'comment') || role() == 's_admin') 
            @if(!$single_ticket->close_at)
                <div class="ticket-main__chat-card__footer">
                    <form action="#!" enctype="multipart/form-data" id="ticketSendForm" class="ticket-main__chat-card__form"> 
                        <input type="hidden" name="id" value="{{ $single_ticket->id }}">
                        {{-- <input type="hidden" name="message" class="tagify_input__value"> --}}
                        <textarea rows="5" name="message" class="ticket-main__chat-card__form__textarea tagifyInput" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Ecrivez votre réponse"></textarea>
                        <div class="ticket-main__chat-card__form__footer">
                            <h3 class="mr-auto d-flex align-items-center">Fichier : <span id="commentInputFileName"></span></h3>
                            <label class="ticket-main__chat-card__custom-file" role="button">
                                <input type="file" name="attach_files[]" multiple class="ticket-main__chat-card__custom-file__input" id="commentInputFile">
                                <span class="ticket-main__chat-card__custom-file__btn">
                                    <span class="ticket-main__chat-card__custom-file__btn__text">{{ __('Attach') }}</span>
                                    <i class="bi bi-paperclip"></i>
                                </span>
                            </label>
                            <button type="button" data-toggle="modal" data-target="#TicketMessageStoreModal" class="ticket-main__chat-card__send-btn">
                                <span class="ticket-main__chat-card__send-btn__text">{{ __('Send') }}</span>
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                        <div class="modal modal--aside fade" id="TicketMessageStoreModal" tabindex="-1" aria-labelledby="TicketMessageStoreModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header border-0 pb-0">
                                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                            <span class="novecologie-icon-close"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center pt-0">
                                        <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                                        <span>Voulez-vous confirmer votre réponse ?</span> 
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1">
                                                Oui
                                            </button>
                                            <button type="button" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                                Non
                                            </button>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endif
    </div> 

    <div class="ticket-main__aside d-none">
        <div class="ticket-main__aside__header">
            <button type="button" class="btn-icon btn-flat-pink ticket-main__aside__close" title="Close">
                <i class="bi bi-x-lg"></i>
            </button>
            <a href="#!" class="ticket-main__aside__header__avatar">
                @if ($single_ticket->openby->profile_photo) 
                    <img loading="lazy" src="{{ asset('uploads/crm/profiles') }}/{{ $single_ticket->openby->profile_photo }}" alt="user image" class="ticket-main__aside__header__avatar__image">
                @else
                    <img loading="lazy" src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="user image" class="ticket-main__aside__header__avatar__image">
                @endif
                <span class="ticket-main__aside__header__avatar__name">{{ $single_ticket->openby->name ?? '' }}</span>
            </a>
        </div>
        <div class="ticket-main__aside__scroller">
            {{-- <div class="ticket-main__aside__body">
                <h3 class="ticket-main__aside__block__title">Ticket Details</h3>
                <h4 class="ticket-main__aside__body__sub-title">Created:</h4>
                <p class="ticket-main__aside__body__text">July 5th, 2022 at 10:05pm</p>
                <h4 class="ticket-main__aside__body__sub-title">Total Ticket:</h4>
                <p class="ticket-main__aside__body__text mb-0">12 Tickets</p>
            </div> --}}
            <div class="ticket-main__aside__footer">
                <h3 class="ticket-main__aside__block__title mb-3">{{ __('Assignee') }}</h3>
                <div class="ticket-main__aside__footer__list">
                    @foreach ($single_ticket->assignee as $assignee)
                        <a href="#!" class="ticket-main__aside__footer__list__item">
                            @if ($assignee->profile_photo)
                                <img loading="lazy" src="{{ asset('uploads/crm/profiles') }}/{{ $assignee->profile_photo }}" alt="agent image" class="ticket-main__aside__footer__list__item__image">
                            @else
                                <img loading="lazy" src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="agent image" class="ticket-main__aside__footer__list__item__image">
                            @endif
                            <span class="ticket-main__aside__footer__list__item__name">{{ $assignee->name }}</span>
                        </a>
                    @endforeach
                    {{-- <a href="#!" class="ticket-main__aside__footer__list__item">
                        <img src="https://i.pravatar.cc/" alt="agent image" class="ticket-main__aside__footer__list__item__image">
                        <span class="ticket-main__aside__footer__list__item__name">Agent Name</span>
                    </a>
                    <a href="#!" class="ticket-main__aside__footer__list__item">
                        <img src="https://i.pravatar.cc/" alt="agent image" class="ticket-main__aside__footer__list__item__image">
                        <span class="ticket-main__aside__footer__list__item__name">Agent Name</span>
                    </a>
                    <a href="#!" class="ticket-main__aside__footer__list__item">
                        <img src="https://i.pravatar.cc/" alt="agent image" class="ticket-main__aside__footer__list__item__image">
                        <span class="ticket-main__aside__footer__list__item__name">Agent Too Long Name</span>
                    </a>
                    <a href="#!" class="ticket-main__aside__footer__list__item">
                        <img src="https://i.pravatar.cc/" alt="agent image" class="ticket-main__aside__footer__list__item__image">
                        <span class="ticket-main__aside__footer__list__item__name">Agent Name</span>
                    </a>
                    <a href="#!" class="ticket-main__aside__footer__list__item">
                        <img src="https://i.pravatar.cc/" alt="agent image" class="ticket-main__aside__footer__list__item__image">
                        <span class="ticket-main__aside__footer__list__item__name">Agent Name</span>
                    </a>
                    <a href="#!" class="ticket-main__aside__footer__list__item">
                        <img src="https://i.pravatar.cc/" alt="agent image" class="ticket-main__aside__footer__list__item__image">
                        <span class="ticket-main__aside__footer__list__item__name">Agent Name</span>
                    </a>
                    <a href="#!" class="ticket-main__aside__footer__list__item">
                        <img src="https://i.pravatar.cc/" alt="agent image" class="ticket-main__aside__footer__list__item__image">
                        <span class="ticket-main__aside__footer__list__item__name">Agent Name</span>
                    </a> --}}
                </div>
                <div class="ticket-main__aside__footer__bottom text-center">
                    @if (checkAction(Auth::id(), 'ticketing', 'assign') || role() == 's_admin')
                        <button type="button" class="ticket-main__chat-card__send-btn" data-toggle="modal" data-target="#assignAgentModal">
                            <i class="bi bi-person-plus-fill"></i>
                            <span class="pl-1">{{ __('Assign Agent') }}</span>
                        </button>
                    @else
                        <button type="button" class="ticket-main__chat-card__send-btn">
                            <span class="novecologie-icon-lock py-1"></span>
                            <span class="pl-1">{{ __('Assign Agent') }}</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Assign Agents Modal -->
<div class="modal modal--aside fade" id="assignAgentModal" tabindex="-1" aria-labelledby="assignAgentModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close" aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <form action="#!" method="post" id="login-form" class="form mx-auto ticketAssignUpdateForm"> 
                    <input type="hidden" name="id"  value="{{ $single_ticket->id }}">
                    <h5 class="form__title position-relative text-center mb-4" id="createTicketModalTitle">{{ __('Assignee') }}</h5>
                    <div class="form-group">
                        <label for="ticketAssignUpdate" class="form-label">Sélectionner les utilisateurs</label>
                        <select name="user_id[]" id="ticketAssignUpdate" class="select2_select_option custom-select shadow-none form-control" multiple>
                            @foreach ($users as $user)
                                <option {{ \App\Models\CRM\TicketAssign::where('ticket_id', $single_ticket->id)->where('user_id', $user->id)->exists()? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center mt-4">
                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3" id="ticketAssignUpdateBtn">{{ __('Assign') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal modal--aside fade" id="ticketCloseModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>Etes-vous sûr de fermer ce ticket ??</span> 
                <form action="{{ route('ticket.closed') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $single_ticket->id }}">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                            {{ ('Cancel') }}
                        </button> 
                        <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1"> 
                            Fermé
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<div class="modal modal--aside fade" id="statusEditModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">Mettre à jour Statut installation</h1>
                <form action="{{ route('ticket.status.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $single_ticket->id }}">
                    <div class="form-group">
                        <label for="#">Sélectionner une Statut installation</label>
                        <select class="shadow-none form-control" name="status" required>
                            <option value="">{{ __('Select') }}</option>
                                <option {{ $single_ticket->client_status == 'Client installé' ? 'selected':'' }} value="Client installé">Client installé</option>
                                <option {{ $single_ticket->client_status == 'Client non installé' ? 'selected':'' }} value="Client non installé">Client non installé</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<div class="modal modal--aside fade" id="TicketDeleteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>{{ __('Are You Sure To Delete this') }} ?</span>
                <form action="{{ route('ticket.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $single_ticket->id }}">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                            Annuler
                        </button>
                        <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                            Confirmer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>