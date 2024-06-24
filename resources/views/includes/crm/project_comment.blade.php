
@foreach ($comments as $comment)
    @if($comment->lead_reset_status == 1  && role() != 's_admin' && role() != 'manager_direction' && role() != 'manager' && role() != 's_admin' && role() != 'adv' && role() != 'adv_copy_1693686130')
        @continue
    @endif
    <div class="ticket-main__chat-card__body__list__item {{ \Auth::id() == $comment->user_id ? '':'' }}">
        <div class="ticket-main__chat-card__body__list__item__header">
            <a href="#!" class="ticket-main__chat-card__body__list__item__header__user-meta"> 
                @if ($comment->getUser)
                    @if($comment->getUser->profile_photo)  
                        <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $comment->getUser->profile_photo }}" alt="image" class="ticket-main__chat-card__body__list__item__header__user__image"> 
                    @else
                        <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="image" class="ticket-main__chat-card__body__list__item__header__user__image"> 
                    @endif
                @else
                    <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="image" class="ticket-main__chat-card__body__list__item__header__user__image"> 
                @endif

                <span class="ticket-main__chat-card__body__list__item__header__user__name">@if ($comment->lead_reset_status == 1) <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}"> @endif {{ $comment->getUser->name ?? '' }}</span>
            </a>
            <div class="d-md-inline">
                <span class="ticket-main__chat-card__body__list__item__header__text ticket-main__chat-card__body__list__item__header__text--muted">{{ __('replied on') }}</span>
                <span class="ticket-main__chat-card__body__list__item__header__text">{{ \Carbon\Carbon::parse($comment->created_at)->locale('fr')->translatedFormat('d F Y') .' a '. \Carbon\Carbon::parse($comment->created_at)->format('H:i') }}</span> @if ($comment->getCategory)
                <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: {{ $comment->getCategory->background_color ?? '#fff' }}">{{ $comment->getCategory->name ?? '' }}</span>    
                @endif 
            </div>
            @if (role() == 's_admin' && isset($type))
                @if ($type == 'lead')
                    <form action="{{ route('lead.comment.delete') }}" method="POST" class="d-inline" style="float: right">
                        @csrf
                        <input type="hidden" name="id" value="{{ $comment->id }}">
                        <button type="submit" class="btn btn-icon shadow-none">
                            <i class="bi bi-trash3"></i>
                        </button> 
                    </form> 
                @elseif ($type == 'client')
                    <form action="{{ route('client.comment.delete') }}" method="POST" class="d-inline" style="float: right">
                        @csrf
                        <input type="hidden" name="id" value="{{ $comment->id }}">
                        <button type="submit" class="btn btn-icon shadow-none">
                            <i class="bi bi-trash3"></i>
                        </button> 
                    </form> 
                @elseif ($type == 'project')
                    <form action="{{ route('project.comment.delete') }}" method="POST" class="d-inline" style="float: right">
                        @csrf
                        <input type="hidden" name="id" value="{{ $comment->id }}">
                        <button type="submit" class="btn btn-icon shadow-none">
                            <i class="bi bi-trash3"></i>
                        </button> 
                    </form> 
                @endif
            @endif
            @if (isset($type))
                @if ($type == 'client')
                    <div class="d-inline"  style="float: right">
                        <button type="button" data-toggle="modal" data-target="#clientCommentPinModal{{ $comment->id }}" class="btn btn-icon shadow-none {{ $comment->pin_status ? 'text-warning':'' }}">
                            <i class="bi bi-pin-fill"></i>
                        </button> 
                    </div>
                    <div class="modal modal--aside fade" id="clientCommentPinModal{{ $comment->id }}" tabindex="-1" aria-labelledby="TicketMessageStoreModal" aria-hidden="true">
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
                                    <form action="{{ route('client.comment.pin') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $comment->id }}">
                                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                                Annuler
                                            </button>
                                            <button type="submit" class="primary-btn btn-primary primary-btn--md rounded border-0 my-3 mx-1">
                                                Confirmer
                                            </button>
                                        </div>     
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($type == 'project')
                    <div class="d-inline"  style="float: right">
                        <button type="button" data-toggle="modal" data-target="#projectCommentPinModal{{ $comment->id }}" class="btn btn-icon shadow-none {{ $comment->pin_status ? 'text-warning':'' }}">
                            <i class="bi bi-pin-fill"></i>
                        </button> 
                    </div>
                    <div class="modal modal--aside fade" id="projectCommentPinModal{{ $comment->id }}" tabindex="-1" aria-labelledby="TicketMessageStoreModal" aria-hidden="true">
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
                                    <form action="{{ route('project.comment.pin') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $comment->id }}">
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                                Annuler
                                            </button>
                                            <button type="submit" class="primary-btn btn-primary primary-btn--md rounded border-0 my-3 mx-1">
                                                Confirmer
                                            </button>
                                        </div>     
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="ticket-main__chat-card__body__list__item__body">
            <p class="ticket-main__chat-card__body__list__item__body__text">{!! $comment->comment !!}</p>
        </div>
        <div class="ticket-main__chat-card__body__list__item__footer">
            @foreach ($comment->file as $file)
                <a href="{{ asset('uploads/crm/comment_file') }}/{{ $file->name }}" target="_blank" class="ticket-main__chat-card__body__list__item__footer__btn">
                    @if ($file->type == 'png' || $file->type == 'jpg' || $file->type == 'jpeg' || $file->type == 'gif')
                        <i class="bi bi-image-fill"></i>
                    @else
                        <i class="bi bi-file-earmark-text-fill"></i>
                    @endif
                    <span class="ticket-main__chat-card__body__list__item__footer__btn__text">{{ $file->name }}</span>
                </a>
                <a href="{{ asset('uploads/crm/comment_file') }}/{{ $file->name }}" download="{{ $file->name }}" target="_blank" class="ticket-main__chat-card__body__list__item__footer__btn">
                    <span class="ticket-main__chat-card__body__list__item__footer__btn__text"><i class="bi bi-download"></i></span>
                </a>
            @endforeach
        </div>
    </div>
@endforeach 