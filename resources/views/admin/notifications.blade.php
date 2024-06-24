@extends('layouts.master')


{{-- Title part  --}}
@section('title')
 	{{ __('Notifications') }}
@endsection



@section('bodyBg')
secondary-bg
@endsection




{{-- Main content part  --}}
@section('content')
    <!-- Notifications Section -->
    <section class="section-gap todo-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="notifications-wrapper bg-white shadow-sm rounded-lg py-3">
                        <div class="notifications__header px-3">
                            <h1 class="notifications__header__title">{{ __('Notifications') }}</h1>
                        </div>
                        <div class="notifications__body simple-bar mt-3">
                            <ul class="notifications__list mb-0 d-flex flex-column">
                                @php
                                     $notifications = App\Models\CRM\Notifications::where('user_id',Auth::id())->orderBy('id', 'desc')->take(200)->get();
                                @endphp
                                @foreach ($notifications as $notification)
                                    <li class="notifications__list__items @if ($notification->status == 0)
                                        active
                                    @endif">
                                        <div class="notifications__list__items__card d-flex flex-column-reverse flex-xl-row justify-content-between px-3">
                                            <div class="notifications__list__items__card__left d-flex align-items-center flex-shrink-0">
                                                {{-- <div class="notifications__list__items__card__avatar rounded-circle overflow-hidden mr-2">
                                                    <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="w-100 h-100">
                                                </div> --}}
                                                <div>
                                                    @if ($notification->lead_id)
                                                        <a href="{{ route('notification.view', [$notification->id, $notification->lead_id]) }}">
                                                            <h4 class="notifications__list__items__card__title mb-1">{{ $notification->title }}</h4>
                                                        </a>
                                                    @elseif ($notification->project_id)
                                                        <a href="{{ route('notification.view.project', [$notification->id, $notification->project_id]) }}">
                                                            <h4 class="notifications__list__items__card__title mb-1">{{ $notification->title }}</h4>
                                                        </a>
                                                    @elseif ($notification->client_id)
                                                        @if ($notification->client_id == '0')
                                                        <a href="{{ route('notification.view.todo', $notification->id) }}">
                                                            <h4 class="notifications__list__items__card__title mb-1">{{ $notification->title }}</h4>
                                                        </a>
                                                        @else
                                                        <a href="{{ route('notification.view.client', [$notification->id, $notification->client_id]) }}">
                                                            <h4 class="notifications__list__items__card__title mb-1">{{ $notification->title }}</h4>
                                                        </a>
                                                        @endif
                                                    @endif

                                                    <span class="notifications__list__items__card__text-sm">{{ $notification->body }}</span>
                                                </div>
                                            </div>
                                            <div class="notifications__list__items__card__right d-flex align-items-center justify-content-between flex-shrink-0 mb-2 mb-xl-0 ml-xl-3">
                                                <span class="notifications__list__items__card__time">
                                                    <i class="bi bi-clock-history notifications__list__items__card__time__icon"></i>
                                                    <span class="notifications__list__items__card__time__text">{{ \Carbon\Carbon::parse($notification->created_at)->locale('fr')->translatedFormat('d F') }}, {{ \Carbon\Carbon::parse($notification->created_at)->format('H:i') }}</span>
                                                </span>
                                                <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                    <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                        <form action="{{ route('notification.unread') }}" method="POST" class="@if ($notification->status == 0)
                                                            d-none
                                                        @endif">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item border-0">
                                                                <input type="hidden" name="id" value="{{ $notification->id }}">
                                                                <span class="novecologie-icon-check mr-1"></span>
                                                                {{ __('Mark as unread') }}
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('notification.read') }}" method="POST" class="@if ($notification->status == 1)
                                                            d-none
                                                        @endif">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item border-0">
                                                                <input type="hidden" name="id" value="{{ $notification->id }}">
                                                                <span class="novecologie-icon-check mr-1"></span>
                                                                {{ __('Mark as read') }}
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('notification.delete') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $notification->id }}">
                                                            <button type="submit" class="dropdown-item border-0">
                                                                <span class="novecologie-icon-trash mr-1"></span>
                                                                {{ __('Remove') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                                {{-- <li class="notifications__list__items">
                                    <div class="notifications__list__items__card d-flex align-items-center justify-content-between px-3">
                                        <div class="notifications__list__items__card__left d-flex align-items-center flex-shrink-0">
                                            <div class="notifications__list__items__card__avatar rounded-circle overflow-hidden mr-2">
                                                <img src="./assets/images/user/avatar-sm-2.jpg" alt="avatar image" class="w-100 h-100">
                                            </div>
                                            <div>
                                                <h4 class="notifications__list__items__card__title mb-1">Congratulation Sam 🎉</h4>
                                                <span class="notifications__list__items__card__text-sm">Won the monthly best seller badge</span>
                                            </div>
                                        </div>
                                        <div class="notifications__list__items__card__right flex-shrink-0 ml-3">
                                            <div class="navbar dropdown dropdown--custom p-0 d-inline-block">
                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                    <button type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-check mr-1"></span>
                                                        Mark as unread
                                                    </button>
                                                    <button type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-trash mr-1"></span>
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

