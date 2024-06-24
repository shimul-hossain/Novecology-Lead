@php
    $notification = App\Models\CRM\Notifications::where('user_id',Auth::id())->orderBy('id', 'desc')->take(20)->get();
@endphp


<div id="notificationList" class="dropdown-menu__body px-2 simple-bar">
    @foreach ($notification as $item)
    <div class="dropdown-menu__item__wrapper d-flex align-items-center justify-content-end position-relative">

        <a class="dropdown-item @if ($item->status == 0) active @endif d-flex align-items-center border-bottom"
            @if ($item->lead_id)
            href="{{ route('notification.view', [$item->id, $item->lead_id]) }}"
            @elseif($item->project_id)
            href="{{ route('notification.view.project', [$item->id, $item->project_id]) }}"
            @elseif($item->ticket_id)
            href="{{ route('notification.view.ticket', [$item->id, $item->ticket_id]) }}"
            @else
                @if ($item->client_id == '0')
                href="{{ route('notification.view.todo', $item->id) }}"
                @else
                href="{{ route('notification.view.client', [$item->id, $item->client_id]) }}"
                @endif
            @endif >
            {{-- <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="user" class="dropdown-item__image rounded-circle flex-shrink-0 "> --}}
            <div>
                <h4 class="dropdown-item__title">{{ $item->title }}</h4>
                <p class="dropdown-item__text mb-0">{{ $item->body }}</p>
                <span class="dropdown-item__badge">{{ \Carbon\Carbon::parse($item->created_at)->locale('fr')->translatedFormat('d F') }}, {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</span>
            </div>
        </a>
        <form action="{{ route('notification.delete') }}" method="POST" class="position-absolute d-flex align-items-center dropdown-item__trash-btn">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <button type="submit" class="dropdown-item__trash-btn__icon  bg-transparent border-0 w-100 h-100">
                <i class="bi bi-trash3"></i>
            </button>
        </form>
    </div>
    @endforeach
</div>
