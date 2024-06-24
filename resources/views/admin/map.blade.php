 @extends('layouts.master')

 {{-- Title part  --}}
@section('title')
{{ __('Map') }}
@endsection

@push('plugins-link')
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/row-calendar/css/style.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/leaflet.css') }}">
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/leaflet-gesture-handling.min.css') }}"> --}}
@endpush

@push('css')
<style>
    .filter-pan__btn.active{
        border: 1px solid #222222;
    }
    .filter-card-wrapper{
        position: relative;
        transition: padding .3s linear;
    }
    .filter-card-wrapper.active{
        padding-left: 300px;
    }
    .filter-left{
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        transform: translateX(-100%);
        width: 300px;
        z-index: 999;
        transition: transform .3s linear;
    }
    .filter-left.active{
        transform: translateX(0);
    }
</style>
@endpush

@push('plugins-link')
<style>
    /* Style marker popup window */
    /* .gm-style .gm-style-iw-c,
    .gm-style .gm-style-iw-tc::after
    {
        color: #ffffff;
        background-color: #9e95f5;
    } */
    .gm-ui-hover-effect > span {
        background-color: #FF0708;
    }

    /* Hide google map brand content */
    .gm-style-cc,
    .gm-style-mtc,
    .gm-svpc,
    a[title="Open this area in Google Maps (opens a new window)"][aria-label="Open this area in Google Maps (opens a new window)"],
    [aria-label] > div > [alt="Google"]
    {
        display: none !important;
    }
</style>
@endpush

{{-- active menu  --}}
@section('mapIndex')
    active
@endsection

@section('bodyBg')
secondary-bg
@endsection

{{-- Main Content Part  --}}
@section('content')
		<!-- Map Section -->
        <section>
            <form action="{{ route('map.filter') }}" method="get">
                <div class="container">
                    <div class="row align-items-center justify-content-end py-3">
                        <div class="col-lg mb-3 mb-lg-0">
                            <div class="filter-pan bg-white px-3 pt-3 border rounded-lg">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <select id="categoryItemSelect" name="type" class="select2_select_option custom-select shadow-none form-control">
                                                <option value="" selected >Catégorie</option>
                                                <option {{ request()->type == 'prospect'? 'selected':'' }} value="prospect">Prospect</option>
                                                <option {{ request()->type == 'client'? 'selected':'' }} value="client">Client</option>
                                                <option {{ request()->type == 'chantier'? 'selected': ''  }} value="chantier">Chantier</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <select id="labelItemSelect" name="label" class="select2_select_option custom-select shadow-none form-control">
                                                <option value="">Etiquette</option>
                                                @if (request()->type)
                                                    @foreach ($statuses as $status)
                                                        <option {{ request()->label == $status->id? 'selected':'' }} value="{{ $status->id }}">{{ $status->status }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group d-flex align-items-center">
                                            <select id="statusItemSelect" data-placeholder="Statut" name="status[]" class="select2_select_option custom-select shadow-none form-control" multiple>
                                                @if (request()->type && request()->label)
                                                    @foreach ($sub_statuses as $s_status)
                                                        <option {{ request()->status && in_array($s_status->id, request()->status)? 'selected':'' }} value="{{ $s_status->id }}">{{ $s_status->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <button type="button" class="add-btn ml-2 {{ request()->type2 ? 'd-none' : '' }}" id="addSecondFilterOption">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="secondFilterWrap" style="display: {{ request()->type2 ? '' : 'none' }}">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select id="categoryItemSelect2" name="type2" class="select2_select_option custom-select shadow-none form-control">
                                                    <option value="" selected >Catégorie</option>
                                                    <option {{ request()->type2 == 'prospect'? 'selected':'' }} value="prospect">Prospect</option>
                                                    <option {{ request()->type2 == 'client'? 'selected':'' }} value="client">Client</option>
                                                    <option {{ request()->type2 == 'chantier'? 'selected': ''  }} value="chantier">Chantier</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select id="labelItemSelect2" name="label2" class="select2_select_option custom-select shadow-none form-control">
                                                    <option value="">Etiquette</option>
                                                    @if (request()->type2)
                                                        @foreach ($statuses2 as $status)
                                                            <option {{ request()->label2 == $status->id? 'selected':'' }} value="{{ $status->id }}">{{ $status->status }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group d-flex align-items-center">
                                                <select id="statusItemSelect2" data-placeholder="Statut" name="status2[]" class="select2_select_option custom-select shadow-none form-control" multiple>
                                                    @if (request()->type2 && request()->label2)
                                                        @foreach ($sub_statuses2 as $s_status)
                                                            <option {{ request()->status2 && in_array($s_status->id, request()->status2)? 'selected':'' }} value="{{ $s_status->id }}">{{ $s_status->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <button type="button" class="remove-btn ml-2" id="removeSecondFilterOption">×</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <div class="filter-pan bg-white px-3 pt-3 border rounded-lg">
                                <div class="row align-items-center justify-content-center justify-content-sm-end">
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-sm filter-pan__btn rounded-circle shadow-none {{ session('filter-card-user') }}" data-toggle="filter" data-filter-card="filter-card-user">
                                                <i class="bi bi-person-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-sm filter-pan__btn rounded-circle shadow-none {{ session('filter-card-client') }}" data-toggle="sidebar-filter" data-filter-card="filter-card-client">
                                                <i class="bi bi-person-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-sm filter-pan__btn rounded-circle shadow-none {{ session('filter-card-setting') }}" data-toggle="filter" data-filter-card="filter-card-setting">
                                                <i class="bi bi-tools"></i>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- <div class="col-auto">
                                        <div class="form-group">
                                            <a href="{{ route('map.index') }}" class="btn btn-sm rounded-circle shadow-none">
                                                <svg width="2em" height="2em" viewBox="0 0 140 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M84.6695 96.9092C78.5286 100.772 71.4201 102.818 64.1654 102.813C42.8562 102.813 25.5195 85.4758 25.5195 64.1667C25.5195 45.7217 38.8079 29.7967 56.722 26.2792C57.3119 27.7731 58.3368 29.0555 59.6639 29.9604C60.991 30.8652 62.5592 31.3508 64.1654 31.3542C65.7692 31.3505 67.3352 30.8662 68.6609 29.9636C69.9867 29.061 71.0115 27.7817 71.6029 26.2908C76.3862 27.2271 80.8954 28.98 85.002 31.6196C87.3179 33.1071 89.7999 29.4992 87.3674 27.9388C82.7004 24.9547 77.4945 22.9126 72.0433 21.9275C71.7137 20.0764 70.7443 18.3999 69.3044 17.1908C67.8645 15.9817 66.0456 15.3169 64.1654 15.3125C62.2877 15.317 60.4712 15.98 59.0322 17.1861C57.5932 18.3922 56.6229 20.065 56.2904 21.9129C36.1362 25.6667 21.1445 43.4963 21.1445 64.1667C21.1445 87.8879 40.4441 107.188 64.1654 107.188C72.2679 107.188 80.1633 104.912 87 100.61C89.3216 99.1521 87.1254 95.3662 84.6695 96.9062V96.9092ZM64.1654 19.6875C65.1071 19.7252 65.9977 20.1258 66.6506 20.8054C67.3036 21.485 67.6683 22.3909 67.6683 23.3333C67.6683 24.2758 67.3036 25.1817 66.6506 25.8613C65.9977 26.5409 65.1071 26.9415 64.1654 26.9792C63.2237 26.9415 62.3331 26.5409 61.6801 25.8613C61.0271 25.1817 60.6625 24.2758 60.6625 23.3333C60.6625 22.3909 61.0271 21.485 61.6801 20.8054C62.3331 20.1258 63.2237 19.7252 64.1654 19.6875Z" fill="black"/>
                                                    <path d="M94.3091 111.504C85.3135 117.27 74.85 120.327 64.1654 120.313C51.9037 120.313 39.9279 116.203 30.1745 108.78C30.6728 107.729 30.9337 106.581 30.9387 105.417C30.9364 103.291 30.0906 101.252 28.5869 99.7482C27.0832 98.2445 25.0444 97.3987 22.9179 97.3964C21.7104 97.3964 20.5787 97.6822 19.552 98.1605C12.1291 88.4043 8.01953 76.4284 8.01953 64.1668C8.01953 33.2093 33.2079 8.02092 64.1654 8.02092C76.2404 8.02092 87.7525 11.8068 97.4591 18.9672C99.6787 20.6063 102.347 17.1384 100.055 15.4468C89.6732 7.75383 77.0867 3.61527 64.1654 3.64592C30.7958 3.64592 3.64453 30.7972 3.64453 64.1668C3.64453 77.4697 8.12745 90.4605 16.227 101.01C15.3602 102.315 14.8975 103.847 14.897 105.414C14.8993 107.541 15.7451 109.58 17.2488 111.083C18.7525 112.587 20.7913 113.433 22.9179 113.435C24.5454 113.435 26.0562 112.942 27.322 112.108C37.8716 120.205 50.8624 124.688 64.1654 124.688C75.7416 124.688 86.9795 121.401 96.6716 115.182C98.9466 113.724 96.7358 109.941 94.3091 111.504ZM22.9179 109.063C21.9762 109.025 21.0856 108.625 20.4326 107.945C19.7796 107.266 19.415 106.36 19.415 105.417C19.415 104.475 19.7796 103.569 20.4326 102.889C21.0856 102.21 21.9762 101.809 22.9179 101.771C23.8596 101.809 24.7502 102.21 25.4031 102.889C26.0561 103.569 26.4208 104.475 26.4208 105.417C26.4208 106.36 26.0561 107.266 25.4031 107.945C24.7502 108.625 23.8596 109.025 22.9179 109.063Z" fill="black"/>
                                                    <path d="M64.1667 56.1458C59.7421 56.1458 56.1458 59.7421 56.1458 64.1667C56.1458 68.5912 59.7421 72.1875 64.1667 72.1875C68.5913 72.1875 72.1875 68.5912 72.1875 64.1667C72.1875 62.7521 71.7879 61.4396 71.1433 60.2846L80.5875 50.8375C83.6504 54.6039 85.3194 59.3121 85.3125 64.1667C85.3063 69.773 83.0765 75.1479 79.1122 79.1122C75.1479 83.0765 69.773 85.3063 64.1667 85.3125C59.8268 85.3088 55.594 83.9643 52.0475 81.463C48.5009 78.9617 45.8138 75.4257 44.3537 71.3387C47.0079 70.0292 48.8542 67.3225 48.8542 64.1667C48.8542 61.0108 47.0079 58.3042 44.3537 56.9946C45.8138 52.9077 48.5009 49.3717 52.0475 46.8703C55.594 44.369 59.8268 43.0245 64.1667 43.0208C67.0075 43.0208 69.7958 43.5808 72.4529 44.6892C75.0138 45.7567 76.7637 41.7433 74.1358 40.6496C70.9786 39.327 67.5897 38.6459 64.1667 38.6458C58.7864 38.6427 53.5432 40.343 49.1887 43.5029C44.8341 46.6628 41.5918 51.1202 39.9263 56.2362C37.9739 56.4546 36.17 57.3834 34.8582 58.8459C33.5463 60.3083 32.8182 62.2021 32.8125 64.1667C32.8125 68.2792 35.9333 71.6392 39.9263 72.0971C41.5914 77.2133 44.8337 81.671 49.1883 84.831C53.5429 87.991 58.7863 89.6911 64.1667 89.6875C78.2396 89.6875 89.6875 78.2396 89.6875 64.1667C89.6875 58.1 87.5642 52.3542 83.6879 47.7371L92.9658 38.4621C98.9584 45.1557 102.431 53.7283 102.786 62.7054C102.894 65.4879 107.269 65.3858 107.155 62.5362C106.759 52.4588 102.832 42.8417 96.0604 35.3675L105.335 26.0925C114.605 36.1054 119.919 48.9679 120.254 62.615C120.324 65.415 124.699 65.3567 124.629 62.51C124.265 47.7342 118.495 33.81 108.427 22.9979L112.379 19.0458C114.304 17.1208 111.341 13.9008 109.288 15.9542L103.857 21.3792L68.0487 57.19C66.866 56.5139 65.529 56.1543 64.1667 56.1458ZM64.1667 67.8125C63.225 67.7748 62.3344 67.3742 61.6814 66.6946C61.0284 66.015 60.6638 65.1091 60.6638 64.1667C60.6638 63.2242 61.0284 62.3183 61.6814 61.6387C62.3344 60.9591 63.225 60.5585 64.1667 60.5208C65.1084 60.5585 65.999 60.9591 66.6519 61.6387C67.3049 62.3183 67.6696 63.2242 67.6696 64.1667C67.6696 65.1091 67.3049 66.015 66.6519 66.6946C65.999 67.3742 65.1084 67.7748 64.1667 67.8125ZM40.8333 67.8125C39.8916 67.7748 39.001 67.3742 38.3481 66.6946C37.6951 66.015 37.3304 65.1091 37.3304 64.1667C37.3304 63.2242 37.6951 62.3183 38.3481 61.6387C39.001 60.9591 39.8916 60.5585 40.8333 60.5208C41.775 60.5585 42.6656 60.9591 43.3186 61.6387C43.9716 62.3183 44.3362 63.2242 44.3362 64.1667C44.3362 65.1091 43.9716 66.015 43.3186 66.6946C42.6656 67.3742 41.775 67.7748 40.8333 67.8125ZM122.474 124.997C122.975 125.609 123.229 126.239 123.229 126.875C123.229 129.29 119.335 131.979 113.75 131.979C108.165 131.979 104.271 129.29 104.271 126.875C104.271 126.239 104.525 125.609 105.026 125C106.794 122.847 103.46 120.006 101.649 122.217C100.503 123.614 99.8958 125.221 99.8958 126.875C99.8958 132.189 105.983 136.354 113.75 136.354C121.517 136.354 127.604 132.189 127.604 126.875C127.604 125.224 126.998 123.614 125.854 122.22C124.23 120.242 120.671 122.809 122.474 124.997Z" fill="black"/>
                                                    <path d="M113.749 67.8125C101.286 67.8125 91.1445 77.9538 91.1445 90.4167C91.1445 96.7167 93.8133 102.786 98.477 107.083C104.544 112.63 108.995 119.058 111.704 126.192C112.398 128.027 115.099 128.027 115.793 126.192C118.503 119.058 122.951 112.63 129.026 107.077C131.33 104.955 133.17 102.379 134.431 99.5123C135.691 96.6453 136.346 93.5486 136.353 90.4167C136.353 77.9538 126.212 67.8125 113.749 67.8125ZM126.072 103.851C120.836 108.637 116.706 114.045 113.749 119.971C110.791 114.045 106.664 108.637 101.432 103.857C99.5738 102.144 98.0897 100.067 97.0724 97.7539C96.055 95.4412 95.5264 92.9433 95.5195 90.4167C95.5195 80.3658 103.698 72.1875 113.749 72.1875C123.8 72.1875 131.978 80.3658 131.978 90.4167C131.978 95.4946 129.82 100.392 126.072 103.851Z" fill="black"/>
                                                    <path d="M113.749 76.5625C106.107 76.5625 99.8945 82.775 99.8945 90.4167C99.8945 98.0583 106.107 104.271 113.749 104.271C121.39 104.271 127.603 98.0583 127.603 90.4167C127.603 82.775 121.39 76.5625 113.749 76.5625ZM113.749 99.8958C108.522 99.8958 104.27 95.6433 104.27 90.4167C104.27 85.19 108.522 80.9375 113.749 80.9375C118.975 80.9375 123.228 85.19 123.228 90.4167C123.228 95.6433 118.975 99.8958 113.749 99.8958Z" fill="black"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-auto">
                                        <div class="form-group">
                                            <button type="submit" class="secondary-btn border-0 w-100">
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="filter-card-user" style="display: {{ session('filter-card-user') == 'active' ? '':'none' }}">
                        <div class="bg-white px-3 pt-3 mb-3 border rounded-lg">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Profil</label>
                                        <select name="role" id="roleFilter" class="select2_select_option custom-select shadow-none form-control filter-card-user__input">
                                            <option selected value="">{{ __('Select') }}</option>
                                            @foreach ($roles as $role)
                                                <option {{ request()->role == $role->id ? 'selected':'' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Utilisateur</label>
                                        <select name="user" id="filterUserList" class="select2_select_option custom-select shadow-none form-control filter-card-user__input">
                                            <option selected value="">{{ __('Select') }}</option>
                                            @if (request()->role)
                                                @foreach ($all_users->where('role_id', request()->role) as $user)
                                                    <option {{ request()->user == $user->id ? 'selected':'' }}  value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 align-self-center">
                                    <div class="calendar-wrapper">
                                        <div class="calendar-header">
                                            <div class="calendar-header__top justify-content-center py-2">
                                                <button type="button" class="calendar-header__top__btn filterDateChangeArray" data-type="left" data-start-date="{{ $week_start }}">
                                                    <i class="bi bi-chevron-left"></i>
                                                </button>
                                                <h3 class="calendar-header__top__title mx-3" id="mapDateFilterWrap">
                                                    <label class="label-flatpickr"> <span id="filterDateRangeLabel">{{ \Carbon\Carbon::parse($week_start)->locale(app()->getLocale())->translatedFormat('d F') }} - {{ \Carbon\Carbon::parse($week_end)->locale(app()->getLocale())->translatedFormat('d F') }}</span>
                                                        <div class="label-flatpickr__container">
                                                            <div class="form-group">
                                                                <input type="date" name="custom_filter_date" id="filterDate" value="{{ \Carbon\Carbon::parse($week_start)->format('Y-m-d') }}" class="flatpickr">
                                                            </div>
                                                        </div>
                                                    </label>
                                                </h3>
                                                <button type="button" class="calendar-header__top__btn filterDateChangeArray" data-type="right" data-start-date="{{ $week_start }}">
                                                    <i class="bi bi-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">De</label>
                                        <input type="date" name="from" value="{{ request()->from }}" class="flatpickr flatpickr-input form-control shadow-none bg-white filter-card-user__input" placeholder="Date Mois, Année">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">a</label>
                                        <input type="date" name="to" value="{{ request()->to }}" class="flatpickr flatpickr-input form-control shadow-none bg-white filter-card-user__input" placeholder="Date Mois, Année">
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div id="filter-card-setting" style="display: {{ session('filter-card-setting') == 'active' ? '':'none' }}">
                        <div class="bg-white px-3 pt-3 mb-3 border rounded-lg">
                            <div class="row">
                                <div class="col-lg col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Type de ticket</label>
                                        <select name="ticket_type" id="ticketTypeChange" class="select2_select_option custom-select shadow-none form-control filter-card-setting__input">
                                            <option selected value="">{{ __('Select') }}</option>
                                            <option {{ request()->ticket_type == 'Administratif' ? 'selected':'' }} value="Administratif">Admnistratif</option>
                                            <option {{ request()->ticket_type == 'Technique' ? 'selected':'' }} value="Technique">Technique</option>
                                            <option {{ request()->ticket_type == 'Financier' ? 'selected':'' }} value="Financier">Financier</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Statut ticket</label>
                                        <select name="ticket_status" class="select2_select_option custom-select shadow-none form-control filter-card-setting__input">
                                            <option selected value="">{{ __('Select') }}</option>
                                            <option {{ request()->ticket_status == 'Ouvert' ? 'selected':'' }} value="Ouvert">Ouvert</option>
                                            <option {{ request()->ticket_status == 'Fermé' ? 'selected':'' }} value="Fermé">Fermé</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Type de problème</label>
                                        <select name="problem_type" id="ticketTypeProblem" class="select2_select_option custom-select shadow-none form-control filter-card-setting__input">
                                            <option selected value="">{{ __('Select') }}</option>
                                            @if (request()->ticket_type == 'Administratif')
                                                @foreach ($problems as $problem)
                                                    <option {{ request()->problem_type == $problem->id ? 'selected':'' }} value="{{ $problem->id }}">{{ $problem->name }}</option>
                                                @endforeach
                                            @else
                                                @foreach ($problems->where('ticket_type', request()->ticket_type) as $problem)
                                                    <option {{ request()->problem_type == $problem->id ? 'selected':'' }} value="{{ $problem->id }}">{{ $problem->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-card-wrapper {{ session('filter-card-client') }}" data-id="filter-card-client">
                    <div data-id="filter-card-client" id="filter-card-client__wrap" class="filter-left bg-white p-3 {{ session('filter-card-client') }}">
                        {{-- <input type="text" name="proejct[]" class="form-control shadow-none" value="1" placeholder="Client name"> --}}
                        @if (request()->project)
                            @php
                                $prev = 0;
                            @endphp
                            @foreach (request()->project as $item)
                                @if ($loop->first)
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col pr-0">
                                                <select name="project[]" class="select2_select_option form-control shadow-none filter-card-client__input">
                                                    <option value="">{{ __('Select') }}</option>
                                                    @foreach ($projects as $project)
                                                        <option {{ $item == $project['id'] ? 'selected':'' }} value="{{ $project['id'] }}">{{ $project['Nom'].' '.$project['Prenom'].'-'.$project['tag'].'-'.$project['Code_Postal'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-sm border h-100 shadow-none filter-card-client__add">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group__wrap">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col pr-0"  data-toggle="tooltip" data-placement="top" data-html="true" title='{{ getAddressLocation($prev, $item) }}'>
                                                    <select name="project[]" class="select2_select_option form-control shadow-none">
                                                        <option value="">{{ __('Select') }}</option>
                                                        @foreach ($projects as $project)
                                                            <option {{ $item == $project['id'] ? 'selected':'' }} value="{{ $project['id'] }}">{{ $project['Nom'].' '.$project['Prenom'].'-'.$project['tag'].'-'.$project['Code_Postal'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-sm border h-100 shadow-none filter-card-client__remove">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @php
                                    $prev =  $item;
                                @endphp
                            @endforeach
                        @else
                            <div class="form-group">
                                <div class="row">
                                    <div class="col pr-0">
                                        <select name="project[]" class="select2_select_option form-control shadow-none filter-card-client__input">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project['id'] }}">{{ $project['Nom'].' '.$project['Prenom'].'-'.$project['tag'].'-'.$project['Code_Postal'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-sm border h-100 shadow-none filter-card-client__add">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="map position-relative h-100">
                        <div class="map-wrapper position-relative h-100">
                            <div id="custom-map"></div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
@endsection

@push('plugins-script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E&callback=initMap" defer></script>
@endpush

@push('js')

<script defer>
    let currentInfoWindow;
    let map;
    let defaultLat = 46.2276;
    let defaultLng = 2.2137;

    // Function to create a custom icon with a specified color
    function createCustomIcon(colorCode) {
        return {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" width="45.716" height="60.955" viewBox="0 0 45.716 60.955"><path id="geo-alt-fill" d="M24.858,60.955s22.858-21.662,22.858-38.1A22.858,22.858,0,1,0,2,22.858C2,39.293,24.858,60.955,24.858,60.955Zm0-26.668A11.429,11.429,0,1,1,36.287,22.858,11.429,11.429,0,0,1,24.858,34.287Z" transform="translate(-2)" fill="' + colorCode + '"/></svg>'),
            scaledSize: new google.maps.Size(26, 35),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(22.858, 60.955)
        }
    };


    // Initialize the map
    function initMap() {
        // Specify the coordinates for the map center
        let mapCenter = { lat: defaultLat, lng: defaultLng };

        // Create a new map instance
        map = new google.maps.Map(document.getElementById('custom-map'), {
            zoom: 5,
            center: mapCenter
        });

        let allLocations = [
            @forelse ($items as $item)
                @if ($item['latitude'])
                    {
                        position: { lat: {{ $item['latitude'] }}, lng: {{ $item['longitude'] }} },
                        icon: createCustomIcon("{{ $item['color'] }}"),
                        content:
                        `
                        <table style="text-align:left">
                            <tr>
                                <th>
                                    Nom
                                </th>
                                <td>
                                    : {{ $item['Nom'] }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Prenom
                                </th>
                                <td>
                                    : {{ $item['Prenom'] }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Département
                                </th>
                                <td>
                                    : {{ $item['Département'] }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Téléphone
                                </th>
                                <td>
                                    : {{ $item['phone'] }}
                                </td>
                            </tr>
                            @if ($item['type'] != 'client')
                                <tr>
                                    <th>
                                        Projet
                                    </th>
                                    <td>
                                        : {{ $item['tag'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Etiquette
                                    </th>
                                    <td>
                                        : {{ $item['status'] }} 
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Statut
                                    </th>
                                    <td>
                                        : {{ $item['sub_status'] }} 
                                    </td>
                                </tr>
                            @endif
                        </table>
                        `
                    },
                @endif
            @empty
                {
                    position: { lat: defaultLat, lng: defaultLng },
                    icon: createCustomIcon('rgba(255,0,0,0.92)'),
                    content: 'No Item Found'
                }
            @endforelse
        ];

        allLocations.forEach(function(markerData) {
            let marker = new google.maps.Marker({
                position: markerData.position,
                map: map,
                title: 'Custom Marker',
                icon: markerData.icon
            });

            let infowindow = new google.maps.InfoWindow({
                content: markerData.content
            });

            marker.addListener('click', function() {
                // Close the currently open info window
                if (currentInfoWindow) {
                    currentInfoWindow.close();
                }

                // Open the clicked marker's info window
                infowindow.open(map, marker);

                // Set the currently open info window
                currentInfoWindow = infowindow;
            });
        });

        map.addListener('click', function() {
            if (currentInfoWindow) {
                currentInfoWindow.close();
            }
        });
    };
</script>

<script>
    $(document).ready(function () {
        $('body').on('click', '.filterDateChangeArray', function(){ 
            let type = $(this).data('type');
            let start_date = $(this).attr('data-start-date'); 
            $.ajax({
				type : "POST",
				url  : "{{ route('map.date.change') }}",
				data : {type, start_date},
				success : response => {
                    $("#mapDateFilterWrap").html(response.view);
                    $('.filterDateChangeArray').attr('data-start-date', response.date); 
                    $('input[type=date]').wrap('<div class="datepicker-input"></div>');
                    document.querySelectorAll('input[type=date]').forEach(e => {
                        flatpickr(e, {
                            minDate: e.getAttribute('min'),
                            maxDate: e.getAttribute('max'),
                            defaultDate: e.getAttribute('value'),
                            altFormat: 'j F Y',
                            dateFormat: 'Y-m-d',
                            allowInput: true,
                            altInput: true,
                            locale: "fr",
                            onReady: (selectedDates, dateStr, instance) => {
                                const mainInputDataId = instance.input.dataset.id;
                                const altInput = instance.input.parentElement?.querySelector(".input");
                                altInput.setAttribute("onkeypress", "return false");
                                altInput.setAttribute("onpaste", "return false");
                                altInput.setAttribute("autocomplete", "off");
                                altInput.setAttribute("id", mainInputDataId);
                            },
                        });
                    });
				}
			})

		});
        $('body').on('change', '#filterDate', function(){ 
            $.ajax({
				type : "POST",
				url  : "{{ route('map.date.change2') }}",
				data : {date:$(this).val()},
				success : response => {
                    $("#filterDateRangeLabel").text(response.label);
                    $('.filterDateChangeArray').attr('data-start-date', response.date); 
				}
			})
		});
        $('body').on('click', '#addSecondFilterOption', function(){ 
            $(this).addClass('d-none');
            $("#secondFilterWrap").slideDown(); 
		});
        $('body').on('click', '#removeSecondFilterOption', function(){ 
            $('#addSecondFilterOption').removeClass('d-none');
            $("#secondFilterWrap").slideUp(); 
            $("#categoryItemSelect2").val('').trigger('change');
            $("#labelItemSelect2").val('').trigger('change');
            $("#statusItemSelect2").val('').trigger('change');
		});
        $('body').on('change', '#ticketTypeChange', function(){ 
            let value = $(this).val(); 

			$.ajax({
				type : "POST",
				url  : "{{ route('map.ticket.type.change') }}",
				data : {value},
				success : response => {
                    $('#ticketTypeProblem').html(response);
				}
			})
		});


        $('body').on('click', '.filter-pan__btn', function(){

			let value, tab = $(this).data('filter-card');
            $(this).toggleClass('active');
            $('.'+tab+'__input').val('').trigger('change');
            if(tab == 'filter-card-client'){
                $(`[data-id="${tab}"]`).toggleClass('active');
                $('#filter-card-client__wrap > *:not(:first-child)').remove();
            }else{
                $('#' + tab).slideToggle();
            }

            if($(this).hasClass('active')){
               value = 'active';
            }
            console.log('tab', tab);
			$.ajax({
				type : "POST",
				url  : "{{ route('map.filter.tab.active') }}",
				data : {tab, value},
				success : response => {

				}
			})
		});

        $('body').on('click', '.filter-card-client__remove', function(){
			$(this).closest('.form-group__wrap').slideUp(function(){
                $(this).remove();
            })
		});

        $('body').on('click', '.filter-card-client__add', function(){
			let data = `
                    <div class="form-group__wrap" style="display:none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col pr-0">
                                    <select name="project[]" class="select2_select_option form-control shadow-none">
                                        <option value="">{{ __('Select') }}</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project['id'] }}">{{ $project['Nom'].' '.$project['Prenom'].'-'.$project['tag'].'-'.$project['Code_Postal'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-sm border h-100 shadow-none filter-card-client__remove">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
            $('#filter-card-client__wrap').append(data);
            $('.form-group__wrap').slideDown();
            $('.select2_select_option').select2();
            $('.select2_select_option').each(function(){
                $(this).select2({
                    width: '100%',
                    dropdownParent: $(this).parent(),
                    templateSelection : function (tag, container){
                        var $option = $('.select2_select_option option[value="'+tag.id+'"]');
                        if ($option.attr('disabled')){
                        $(container).addClass('removed-remove-btn');
                        }
                        return tag.text;
                    },
                })
            })
		});

        $('body').on('change', '#roleFilter', function(){
			let role_id = $(this).val();
			$.ajax({
				type : "POST",
				url  : "{{ route('planning.filter.role.change') }}",
				data : {role_id},
				success : response => {
					$('#filterUserList').html(response)
				}
			})
		});

        $("#categoryItemSelect").change(function(){
            let value = $(this).val();
            $('#labelItemSelect').html('<option value="">Etiquette</option>');
			$('#statusItemSelect').html('');
            $.ajax({
                url     : "{{ route('map.category.change') }}",
                type    : "post",
                data    : {value},
                success : response => {
					$('#labelItemSelect').html(response.status);
					// $('#statusItemSelect').html(response.sub_status);
				}
            });
        });

        $("#labelItemSelect").change(function(){
            let category = $("#categoryItemSelect").val(); 
            let label = $(this).val(); 
			$('#statusItemSelect').html('');
            $.ajax({
                url     : "{{ route('map.label.change') }}",
                type    : "post",
                data    : {category, label},
                success : response => { 
					$('#statusItemSelect').html(response.sub_status);
				}
            });
        });
        $("#categoryItemSelect2").change(function(){
            let value = $(this).val();
            $('#labelItemSelect2').html('<option value="">Etiquette</option>');
			$('#statusItemSelect2').html('');
            $.ajax({
                url     : "{{ route('map.category.change') }}",
                type    : "post",
                data    : {value},
                success : response => {
					$('#labelItemSelect2').html(response.status);
				}
            });
        });

        $("#labelItemSelect2").change(function(){
            let category = $("#categoryItemSelect2").val(); 
            let label = $(this).val(); 
			$('#statusItemSelect2').html('');
            $.ajax({
                url     : "{{ route('map.label.change') }}",
                type    : "post",
                data    : {category, label},
                success : response => { 
					$('#statusItemSelect2').html(response.sub_status);
				}
            });
        });


        // $('[data-toggle="filter"]').on("click", function(){
        //     $(this).toggleClass('active')
        //     $('#' + $(this).data('filter-card')).slideToggle();
        // });

        // $('[data-toggle="sidebar-filter"]').on("click", function(){
        //     $(this).toggleClass('active')
        //     $(`[data-id="${$(this).data('filter-card')}"]`).toggleClass('active');
        // });
    });
</script>

@endpush
