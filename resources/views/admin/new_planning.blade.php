{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Calendar') }}
@endsection

@section('bodyBg')
secondary-bg
@endsection

{{-- active menu  --}}
@section('planningIndex')
active
@endsection

@push('css')
<style>
    #filterAccordion .card-header .btn::after{
        content: '\F64D';
    }
    #filterAccordion .card-header .btn[aria-expanded="true"]::after{
        content: '\F63B';
    }

    #filterAccordion .card-header .btn::after{
        background-color: #f7f7f7;
        padding: 5px;
    }    
    h4{
        font-size: 16px;
        font-weight: bold;
    }
</style>
@endpush

@push('plugins-link')
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/row-calendar/css/style.css') }}">
@endpush

{{-- Main Content Part  --}}
@section('content')

<div class="full-preloader position-fixed w-100 h-100" style="display: none">
    <div class="full-preloader__wrapper d-flex align-items-center justify-content-center w-100 h-100">
        <svg class="preloader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
            <path class="preloader__icon__path" fill="currentColor" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
            </path>
        </svg>
    </div>
</div>

<!-- Banner Section -->
<section class="py-4 position-relative">
	<div class="container">
		<div class="row bg-white py-3 rounded-lg shadow-sm">
			<div class="{{ ($sales_user &&  !checkAction(Auth::id(), 'collapse_intervention', 'create')) ? 'col-12':'col-lg-2' }} mb-2 mb-lg-0 {{ role() == 'Referent_Technique' ? 'mt-lg-5':'' }}">
				<div class="planing-navigation text-center mb-2 d-lg-none">
					<div class="btn-group">
                        <a href="{{ route('calendar.index') }}" class="btn btn-outline-secondary">
							<svg width="1.3em" height="1.3em" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.3848 8.90625C13.7655 8.92224 13.177 9.17948 12.7446 9.62314C12.3123 10.0668 12.0703 10.6618 12.0703 11.2813C12.0703 11.9007 12.3123 12.4957 12.7446 12.9394C13.177 13.383 13.7655 13.6403 14.3848 13.6563C15.0041 13.6403 15.5926 13.383 16.0249 12.9394C16.4573 12.4957 16.6992 11.9007 16.6992 11.2813C16.6992 10.6618 16.4573 10.0668 16.0249 9.62314C15.5926 9.17948 15.0041 8.92224 14.3848 8.90625ZM14.3848 10.0938C14.5408 10.0938 14.6952 10.1246 14.8393 10.1843C14.9834 10.2441 15.1144 10.3316 15.2246 10.442C15.3349 10.5523 15.4224 10.6833 15.482 10.8274C15.5417 10.9716 15.5723 11.126 15.5723 11.282C15.5722 11.438 15.5414 11.5925 15.4817 11.7366C15.422 11.8807 15.3344 12.0116 15.2241 12.1219C15.1137 12.2322 14.9827 12.3196 14.8386 12.3793C14.6945 12.4389 14.54 12.4696 14.384 12.4695C14.0689 12.4694 13.7668 12.3442 13.5441 12.1213C13.3214 11.8985 13.1964 11.5963 13.1965 11.2813C13.1966 10.9662 13.3218 10.6641 13.5447 10.4414C13.7675 10.2187 14.0697 10.0936 14.3848 10.0938Z" fill="currentColor"/>
                                <path d="M12.1326 18.0111C13.3359 18.0111 15.4362 18.0111 16.6395 18.0008C16.8606 17.9999 17.0783 17.9458 17.274 17.8429C17.4697 17.74 17.6378 17.5915 17.7638 17.4098C17.8899 17.2282 17.9704 17.0188 17.9983 16.7995C18.0263 16.5802 18.0009 16.3573 17.9244 16.1499C17.6629 15.4201 17.1824 14.789 16.5485 14.3427C15.9147 13.8965 15.1585 13.657 14.3833 13.6569C13.6076 13.6585 12.8512 13.8981 12.2161 14.3434C11.581 14.7886 11.0978 15.4181 10.8319 16.1467C10.7547 16.3562 10.7293 16.5812 10.7578 16.8026C10.7863 17.024 10.8679 17.2353 10.9956 17.4184C11.1234 17.6014 11.2935 17.751 11.4914 17.8542C11.6894 17.9574 11.9093 18.0112 12.1326 18.0111ZM12.1326 16.8236C12.1006 16.8236 12.0683 16.816 12.0399 16.8012C12.0116 16.7865 11.9872 16.7651 11.9689 16.7389C11.9507 16.7126 11.939 16.6824 11.935 16.6507C11.9309 16.619 11.9346 16.5867 11.9457 16.5568L11.9465 16.556C12.1287 16.0556 12.46 15.6231 12.8958 15.3171C13.3316 15.011 13.8508 14.846 14.3833 14.8444C15.5011 14.8444 16.4527 15.5585 16.8082 16.5544L16.8097 16.5607C16.8204 16.589 16.8239 16.6194 16.8201 16.6494C16.8162 16.6793 16.8051 16.7079 16.7876 16.7325C16.7705 16.7575 16.7475 16.7778 16.7208 16.7919C16.694 16.806 16.6642 16.8133 16.634 16.8133H16.6292C15.4283 16.8236 13.3327 16.8236 12.1326 16.8236ZM16.4258 7.12565V5.14648C16.4258 4.35912 16.113 3.60401 15.5563 3.04726C14.9995 2.49051 14.2444 2.17773 13.457 2.17773H3.95703C3.16967 2.17773 2.41456 2.49051 1.85781 3.04726C1.30106 3.60401 0.988281 4.35912 0.988281 5.14648V14.6465C0.988281 15.4338 1.30106 16.189 1.85781 16.7457C2.41456 17.3025 3.16967 17.6152 3.95703 17.6152H8.70703C8.8645 17.6152 9.01553 17.5527 9.12688 17.4413C9.23823 17.33 9.30078 17.179 9.30078 17.0215C9.30078 16.864 9.23823 16.713 9.12688 16.6016C9.01553 16.4903 8.8645 16.4277 8.70703 16.4277H3.95703C3.48461 16.4277 3.03155 16.2401 2.6975 15.906C2.36345 15.572 2.17578 15.1189 2.17578 14.6465V5.14648C2.17578 4.67407 2.36345 4.221 2.6975 3.88695C3.03155 3.5529 3.48461 3.36523 3.95703 3.36523H13.457C13.9294 3.36523 14.3825 3.5529 14.7166 3.88695C15.0506 4.221 15.2383 4.67407 15.2383 5.14648V7.12565C15.2383 7.28312 15.3008 7.43415 15.4122 7.5455C15.5235 7.65685 15.6746 7.7194 15.832 7.7194C15.9895 7.7194 16.1405 7.65685 16.2519 7.5455C16.3632 7.43415 16.4258 7.28312 16.4258 7.12565Z" fill="currentColor"/>
                                <path d="M4.75 1.58398V3.95898C4.75 4.11646 4.81256 4.26748 4.92391 4.37883C5.03526 4.49018 5.18628 4.55273 5.34375 4.55273C5.50122 4.55273 5.65225 4.49018 5.7636 4.37883C5.87494 4.26748 5.9375 4.11646 5.9375 3.95898V1.58398C5.9375 1.42651 5.87494 1.27549 5.7636 1.16414C5.65225 1.05279 5.50122 0.990234 5.34375 0.990234C5.18628 0.990234 5.03526 1.05279 4.92391 1.16414C4.81256 1.27549 4.75 1.42651 4.75 1.58398ZM11.4792 1.58398V3.95898C11.4792 4.11646 11.5417 4.26748 11.6531 4.37883C11.7644 4.49018 11.9154 4.55273 12.0729 4.55273C12.2304 4.55273 12.3814 4.49018 12.4928 4.37883C12.6041 4.26748 12.6667 4.11646 12.6667 3.95898V1.58398C12.6667 1.42651 12.6041 1.27549 12.4928 1.16414C12.3814 1.05279 12.2304 0.990234 12.0729 0.990234C11.9154 0.990234 11.7644 1.05279 11.6531 1.16414C11.5417 1.27549 11.4792 1.42651 11.4792 1.58398ZM4.75 8.51107H7.20417C7.36164 8.51107 7.51266 8.44851 7.62401 8.33716C7.73536 8.22581 7.79792 8.07479 7.79792 7.91732C7.79792 7.75985 7.73536 7.60882 7.62401 7.49747C7.51266 7.38612 7.36164 7.32357 7.20417 7.32357H4.75C4.59253 7.32357 4.44151 7.38612 4.33016 7.49747C4.21881 7.60882 4.15625 7.75985 4.15625 7.91732C4.15625 8.07479 4.21881 8.22581 4.33016 8.33716C4.44151 8.44851 4.59253 8.51107 4.75 8.51107ZM4.75 11.6777H8.70833C8.86581 11.6777 9.01683 11.6152 9.12818 11.5038C9.23953 11.3925 9.30208 11.2415 9.30208 11.084C9.30208 10.9265 9.23953 10.7755 9.12818 10.6641C9.01683 10.5528 8.86581 10.4902 8.70833 10.4902H4.75C4.59253 10.4902 4.44151 10.5528 4.33016 10.6641C4.21881 10.7755 4.15625 10.9265 4.15625 11.084C4.15625 11.2415 4.21881 11.3925 4.33016 11.5038C4.44151 11.6152 4.59253 11.6777 4.75 11.6777Z" fill="currentColor"/>
                            </svg>
						</a>
						<a href="{{ route('planning.index') }}" class="btn btn-outline-secondary active">
							<i class="bi bi-calendar2-week"></i>
						</a>
						<a href="{{ route('planning.weeks.view') }}" class="btn btn-outline-secondary">
							<i class="bi bi-card-list"></i>
						</a>
                        @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager' && role() != 'sales_manager_externe' && role() != 'installer' && role() != 'energy_auditor')
                            <a href="{{ route('planning.map.view') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-geo-alt"></i>
                            </a>
                        @endif
					</div>
				</div>
				<div class="text-center text-lg-left mb-2">
                    @if (checkAction(Auth::id(), 'collapse_intervention', 'create') || role() == 's_admin')
					    <button data-toggle="modal" data-target="#rightAsideModal" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 w-100"><i class="bi bi-plus-lg mr-1"></i>Ajouter une intervention</button>
                    @endif
				</div>
                @if (!$sales_user)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold mb-0">Utilisateurs</h3>
                        </div>
                        <div class="card-body px-2">
                            <form action="{{ route('planning.filter') }}" method="POST">
                                @csrf
                                <div id="filterAccordion">
                                    @foreach ($roles as $role)
                                        @if ($all_access)
                                            <div class="card mb-2 border-0">
                                                <div class="card-header border-0">
                                                    <button class="btn btn-block border-0 bg-white text-left shadow-none {{ Auth::user()->planningFilter()->whereIn('user_id', $role->getUsers()->pluck('id'))->count() > 0 ? '':'collapsed' }}" type="button" data-toggle="collapse" data-target="#collapse{{ $role->id }}" aria-expanded="{{ Auth::user()->planningFilter()->whereIn('user_id', $role->getUsers()->pluck('id'))->count() > 0 ? 'true':'false' }}">
                                                        {{ $role->name }}
                                                    </button>
                                                </div>
                                                <div id="collapse{{ $role->id }}" class="collapse {{ Auth::user()->planningFilter()->whereIn('user_id', $role->getUsers()->pluck('id'))->count() > 0 ? 'show':'' }}" style="">
                                                    <div class="card-body">
                                                        @foreach ($role->getUsers as $user)
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox mb-0">
                                                                    <input type="checkbox" name="user_filter[]" {{ Auth::user()->planningFilter()->where('user_id', $user->id)->exists() ? 'checked':'' }} value="{{ $user->id }}" class="custom-control-input" id="planningUserFilter-{{ $user->id }}">
                                                                    <label class="custom-control-label" for="planningUserFilter-{{ $user->id }}">{{ $user->name }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif(role() == 'Referent_Technique')
                                            @if ($role->id == '4' || $role->id == '9')
                                                <div class="card mb-2 border-0">
                                                    <div class="card-header border-0">
                                                        <button class="btn btn-block border-0 bg-white text-left shadow-none {{ Auth::user()->planningFilter()->whereIn('user_id', $role->getUsers()->pluck('id'))->count() > 0 ? '':'collapsed' }}" type="button" data-toggle="collapse" data-target="#collapse{{ $role->id }}" aria-expanded="{{ Auth::user()->planningFilter()->whereIn('user_id', $role->getUsers()->pluck('id'))->count() > 0 ? 'true':'false' }}">
                                                            {{ $role->name }}
                                                        </button>
                                                    </div>
                                                    <div id="collapse{{ $role->id }}" class="collapse {{ Auth::user()->planningFilter()->whereIn('user_id', $role->getUsers()->pluck('id'))->count() > 0 ? 'show':'' }}" style="">
                                                        <div class="card-body">
                                                            @foreach ($role->getUsers as $user)
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-checkbox mb-0">
                                                                        <input type="checkbox" name="user_filter[]" {{ Auth::user()->planningFilter()->where('user_id', $user->id)->exists() ? 'checked':'' }} value="{{ $user->id }}" class="custom-control-input" id="planningUserFilter-{{ $user->id }}">
                                                                        <label class="custom-control-label" for="planningUserFilter-{{ $user->id }}">{{ $user->name }}</label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            @if (role() == $role->value)
                                                <div class="card mb-2 border-0">
                                                    <div class="card-header border-0">
                                                        <button class="btn btn-block border-0 bg-white text-left shadow-none {{ Auth::user()->planningFilter()->whereIn('user_id', [Auth::id()])->count() > 0 ? '':'collapsed' }}" type="button" data-toggle="collapse" data-target="#collapse{{ $role->id }}" aria-expanded="{{ Auth::user()->planningFilter()->whereIn('user_id', [Auth::id()])->count() > 0 ? 'true':'false' }}">
                                                            {{ $role->name }}
                                                        </button>
                                                    </div>
                                                    
                                                    <div id="collapse{{ $role->id }}" class="collapse {{ Auth::user()->planningFilter()->whereIn('user_id', [Auth::id()])->count() > 0 ? 'show':'' }}" style="">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox mb-0">
                                                                    <input type="checkbox" name="user_filter[]" {{ Auth::user()->planningFilter()->where('user_id', Auth::id())->exists() ? 'checked':'' }} value="{{ Auth::id() }}" class="custom-control-input" id="planningUserFilter-{{ Auth::id() }}">
                                                                    <label class="custom-control-label" for="planningUserFilter-{{ Auth::id() }}">{{ Auth::user()->name }}</label>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 w-100">
                                        Valider
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
			<div class="{{ ($sales_user &&  !checkAction(Auth::id(), 'collapse_intervention', 'create')) ? 'col-12':'col-lg-10' }}">
				<div class="planing-navigation text-center mb-2 d-none d-lg-block">
					<div class="btn-group">
                        <a href="{{ route('calendar.index') }}" class="btn btn-outline-secondary">
							<svg width="1.3em" height="1.3em" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.3848 8.90625C13.7655 8.92224 13.177 9.17948 12.7446 9.62314C12.3123 10.0668 12.0703 10.6618 12.0703 11.2813C12.0703 11.9007 12.3123 12.4957 12.7446 12.9394C13.177 13.383 13.7655 13.6403 14.3848 13.6563C15.0041 13.6403 15.5926 13.383 16.0249 12.9394C16.4573 12.4957 16.6992 11.9007 16.6992 11.2813C16.6992 10.6618 16.4573 10.0668 16.0249 9.62314C15.5926 9.17948 15.0041 8.92224 14.3848 8.90625ZM14.3848 10.0938C14.5408 10.0938 14.6952 10.1246 14.8393 10.1843C14.9834 10.2441 15.1144 10.3316 15.2246 10.442C15.3349 10.5523 15.4224 10.6833 15.482 10.8274C15.5417 10.9716 15.5723 11.126 15.5723 11.282C15.5722 11.438 15.5414 11.5925 15.4817 11.7366C15.422 11.8807 15.3344 12.0116 15.2241 12.1219C15.1137 12.2322 14.9827 12.3196 14.8386 12.3793C14.6945 12.4389 14.54 12.4696 14.384 12.4695C14.0689 12.4694 13.7668 12.3442 13.5441 12.1213C13.3214 11.8985 13.1964 11.5963 13.1965 11.2813C13.1966 10.9662 13.3218 10.6641 13.5447 10.4414C13.7675 10.2187 14.0697 10.0936 14.3848 10.0938Z" fill="currentColor"/>
                                <path d="M12.1326 18.0111C13.3359 18.0111 15.4362 18.0111 16.6395 18.0008C16.8606 17.9999 17.0783 17.9458 17.274 17.8429C17.4697 17.74 17.6378 17.5915 17.7638 17.4098C17.8899 17.2282 17.9704 17.0188 17.9983 16.7995C18.0263 16.5802 18.0009 16.3573 17.9244 16.1499C17.6629 15.4201 17.1824 14.789 16.5485 14.3427C15.9147 13.8965 15.1585 13.657 14.3833 13.6569C13.6076 13.6585 12.8512 13.8981 12.2161 14.3434C11.581 14.7886 11.0978 15.4181 10.8319 16.1467C10.7547 16.3562 10.7293 16.5812 10.7578 16.8026C10.7863 17.024 10.8679 17.2353 10.9956 17.4184C11.1234 17.6014 11.2935 17.751 11.4914 17.8542C11.6894 17.9574 11.9093 18.0112 12.1326 18.0111ZM12.1326 16.8236C12.1006 16.8236 12.0683 16.816 12.0399 16.8012C12.0116 16.7865 11.9872 16.7651 11.9689 16.7389C11.9507 16.7126 11.939 16.6824 11.935 16.6507C11.9309 16.619 11.9346 16.5867 11.9457 16.5568L11.9465 16.556C12.1287 16.0556 12.46 15.6231 12.8958 15.3171C13.3316 15.011 13.8508 14.846 14.3833 14.8444C15.5011 14.8444 16.4527 15.5585 16.8082 16.5544L16.8097 16.5607C16.8204 16.589 16.8239 16.6194 16.8201 16.6494C16.8162 16.6793 16.8051 16.7079 16.7876 16.7325C16.7705 16.7575 16.7475 16.7778 16.7208 16.7919C16.694 16.806 16.6642 16.8133 16.634 16.8133H16.6292C15.4283 16.8236 13.3327 16.8236 12.1326 16.8236ZM16.4258 7.12565V5.14648C16.4258 4.35912 16.113 3.60401 15.5563 3.04726C14.9995 2.49051 14.2444 2.17773 13.457 2.17773H3.95703C3.16967 2.17773 2.41456 2.49051 1.85781 3.04726C1.30106 3.60401 0.988281 4.35912 0.988281 5.14648V14.6465C0.988281 15.4338 1.30106 16.189 1.85781 16.7457C2.41456 17.3025 3.16967 17.6152 3.95703 17.6152H8.70703C8.8645 17.6152 9.01553 17.5527 9.12688 17.4413C9.23823 17.33 9.30078 17.179 9.30078 17.0215C9.30078 16.864 9.23823 16.713 9.12688 16.6016C9.01553 16.4903 8.8645 16.4277 8.70703 16.4277H3.95703C3.48461 16.4277 3.03155 16.2401 2.6975 15.906C2.36345 15.572 2.17578 15.1189 2.17578 14.6465V5.14648C2.17578 4.67407 2.36345 4.221 2.6975 3.88695C3.03155 3.5529 3.48461 3.36523 3.95703 3.36523H13.457C13.9294 3.36523 14.3825 3.5529 14.7166 3.88695C15.0506 4.221 15.2383 4.67407 15.2383 5.14648V7.12565C15.2383 7.28312 15.3008 7.43415 15.4122 7.5455C15.5235 7.65685 15.6746 7.7194 15.832 7.7194C15.9895 7.7194 16.1405 7.65685 16.2519 7.5455C16.3632 7.43415 16.4258 7.28312 16.4258 7.12565Z" fill="currentColor"/>
                                <path d="M4.75 1.58398V3.95898C4.75 4.11646 4.81256 4.26748 4.92391 4.37883C5.03526 4.49018 5.18628 4.55273 5.34375 4.55273C5.50122 4.55273 5.65225 4.49018 5.7636 4.37883C5.87494 4.26748 5.9375 4.11646 5.9375 3.95898V1.58398C5.9375 1.42651 5.87494 1.27549 5.7636 1.16414C5.65225 1.05279 5.50122 0.990234 5.34375 0.990234C5.18628 0.990234 5.03526 1.05279 4.92391 1.16414C4.81256 1.27549 4.75 1.42651 4.75 1.58398ZM11.4792 1.58398V3.95898C11.4792 4.11646 11.5417 4.26748 11.6531 4.37883C11.7644 4.49018 11.9154 4.55273 12.0729 4.55273C12.2304 4.55273 12.3814 4.49018 12.4928 4.37883C12.6041 4.26748 12.6667 4.11646 12.6667 3.95898V1.58398C12.6667 1.42651 12.6041 1.27549 12.4928 1.16414C12.3814 1.05279 12.2304 0.990234 12.0729 0.990234C11.9154 0.990234 11.7644 1.05279 11.6531 1.16414C11.5417 1.27549 11.4792 1.42651 11.4792 1.58398ZM4.75 8.51107H7.20417C7.36164 8.51107 7.51266 8.44851 7.62401 8.33716C7.73536 8.22581 7.79792 8.07479 7.79792 7.91732C7.79792 7.75985 7.73536 7.60882 7.62401 7.49747C7.51266 7.38612 7.36164 7.32357 7.20417 7.32357H4.75C4.59253 7.32357 4.44151 7.38612 4.33016 7.49747C4.21881 7.60882 4.15625 7.75985 4.15625 7.91732C4.15625 8.07479 4.21881 8.22581 4.33016 8.33716C4.44151 8.44851 4.59253 8.51107 4.75 8.51107ZM4.75 11.6777H8.70833C8.86581 11.6777 9.01683 11.6152 9.12818 11.5038C9.23953 11.3925 9.30208 11.2415 9.30208 11.084C9.30208 10.9265 9.23953 10.7755 9.12818 10.6641C9.01683 10.5528 8.86581 10.4902 8.70833 10.4902H4.75C4.59253 10.4902 4.44151 10.5528 4.33016 10.6641C4.21881 10.7755 4.15625 10.9265 4.15625 11.084C4.15625 11.2415 4.21881 11.3925 4.33016 11.5038C4.44151 11.6152 4.59253 11.6777 4.75 11.6777Z" fill="currentColor"/>
                            </svg>
						</a>
						<a href="{{ route('planning.index') }}" class="btn btn-outline-secondary active">
							<i class="bi bi-calendar2-week"></i>
						</a>
						<a href="{{ route('planning.weeks.view') }}" class="btn btn-outline-secondary">
							<i class="bi bi-card-list"></i>
						</a>
                        @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager' && role() != 'sales_manager_externe' && role() != 'installer' && role() != 'energy_auditor')
                            <a href="{{ route('planning.map.view') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-geo-alt"></i>
                            </a>
                        @endif
					</div>
				</div>
				<div class="calendar-filters">
					<form action="{{ $url_status == 1 ? route('planning.menu.filter', $current_date) : route('planning.menu.filter')  }}" method="get">
						<div class="row row-cols-xl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 align-items-end"> 
                            @if ($all_access)
                                <div class="col">
                                    <div class="form-group">
                                        <label for="intervention_client" class="form-label">Client</label>
                                        <select id="intervention_client" name="client" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($projects as $project)
                                                <option {{ request()->client == $project['id'] ? 'selected':'' }} value="{{ $project['id'] }}">{{ $project['Nom'].' '.$project['Prenom'].'-'.$project['tag'].'-'.$project['Code_Postal'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="code_postal" class="form-label">Département</label>
                                        <select name="code_postal" id="code_postal" class="select2_select_option shadow-none form-control">
                                            <option value="" selected>{{ __("Select") }}</option>
                                            @foreach ($departments as $department)
                                                <option {{ request()->code_postal == $department->postal_code ? 'selected':'' }} value="{{ $department->postal_code < 10 ? '0':'' }}{{ $department->postal_code }}">{{ $department->city }}( {{ $department->postal_code < 10 ? '0':'' }}{{ $department->postal_code }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Type d’intervention</label>
                                        <select  name="intervention_type" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ request()->intervention_type == 'Etude' ? 'selected':'' }} value="Etude">Etude</option>
                                            <option {{ request()->intervention_type == 'Pré-Visite Technico-Commercial' ? 'selected':'' }} value="Pré-Visite Technico-Commercial">Pré-Visite Technico-Commercial</option>
                                            <option {{ request()->intervention_type == 'Contre Visite Technique' ? 'selected':'' }} value="Contre Visite Technique">Contre Visite Technique</option>
                                            <option {{ request()->intervention_type == 'Installation' ? 'selected':'' }} value="Installation">Installation</option>
                                            <option {{ request()->intervention_type == 'SAV' ? 'selected':'' }} value="SAV">SAV</option>
                                            <option {{ request()->intervention_type == 'Prévisite virtuelle' ? 'selected':'' }} value="Prévisite virtuelle">Prévisite virtuelle</option>
                                            <option {{ request()->intervention_type == 'Déplacement' ? 'selected':'' }} value="Déplacement">Déplacement</option>
                                            <option {{ request()->intervention_type == 'DPE' ? 'selected':'' }} value="DPE">DPE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Travaux</label>
                                        <select name="travaux" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($bareme_travaux_tags->where('rank', 1) as $travaux)
                                                <option {{ request()->travaux == $travaux->id ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label  class="form-label">Statut planning</label>
                                        <select name="statut_planning" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($status_planning as $item)
                                                <option {{ request()->statut_planning == $item->name ? 'selected':'' }} value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Profil</label>
                                        <select name="role" id="roleFilter" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($filter_role as $role)
                                                @if ($all_access)
                                                    <option {{ request()->role == $role->id ? 'selected':'' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                                @else
                                                    @if (role() == $role->value)
                                                        <option {{ request()->role == $role->id ? 'selected':'' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Utilisateur</label>
                                        <select name="user_id" id="filterUserList" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @if (request()->role)
                                                @foreach ($users->where('role_id', request()->role) as $user)
                                                    <option {{ request()->user_id == $user->id ? 'selected':'' }}  value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col d-flex">
                                    <div class="form-group">
                                        <button class="secondary-btn border-0 mr-1" type="submit">{{ __('Submit') }}</button>
                                    </div>
                                    @if (\Request::route()->getName() == 'planning.menu.filter')
                                        <div class="form-group">
                                            @if ($url_status == 1)
                                                <a href="{{ route('planning.index', $current_date) }}" class="btn btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
                                            @else
                                                <a href="{{ route('planning.index') }}" class="btn btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endif
							<div class="ml-auto col">
								<div class="form-group">
                                    <select id="planningView" class="custom-select">
                                        <option {{ planningView() == '1' ? 'selected':'' }} value="1">1 jour</option>
                                        <option {{ planningView() == '3' ? 'selected':'' }} value="3">3 jours</option>
                                        <option {{ planningView() == '5' ? 'selected':'' }} value="5">5 jours</option>
                                        <option {{ planningView() == '7' ? 'selected':'' }} value="7">1 semaine</option>
                                        <option {{ planningView() == '15' ? 'selected':'' }} value="15">2 semaines</option>
                                        <option {{ planningView() == '30' ? 'selected':'' }} value="30">Mois complet</option>
                                    </select>
								</div>
							</div>
						</div>
					</form>
				</div>
                <div class="calendar-header">
                    <div class="calendar-header__top">
                            {{-- @if (planningView() == '30') --}}
                                <a href="{{ route('planning.index',$prev_month) }}" class="calendar-header__top__btn">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                                <h3 class="calendar-header__top__title">
                                    <label class="label-flatpickr">{{ ucFirst($month) }}
                                        <form action="{{ route('planning.custom.filter') }}" method="post" class="label-flatpickr__container">
                                            @csrf
                                            <div class="form-group">
                                                <input type="date" name="custom_filter_date" value="{{ $current_date }}" class="flatpickr" onchange="this.closest('form').submit()">
                                            </div>
                                        </form>
                                    </label>
                                </h3>
                                <a href="{{ route('planning.index',$next_month) }}" class="calendar-header__top__btn">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            {{-- @else
                                <h3 class="calendar-header__top__title mx-auto py-2">{{ $month }}</h3>
                            @endif --}}
                        </div>
                    </div>
				<div class="calendar" style="--day-length: {{ $days_in_month }};">
					<div class="calendar-header">
						<div class="calendar__row">
                            @if (!$sales_user)
                                <div class="calendar__row__item">
                                    <div class="calendar__row__item__filter">
                                        <input type="search" id="calendar__row__item__filter__search" name="filter" class="calendar__row__item__filter__input" placeholder="Filtre">
                                    </div>
                                </div>
                            @endif
							<div class="calendar__row__container">
								@foreach ($full_month as $key => $day)
									<div class="calendar__row__container__col">
										<time class="calendar__row__container__col__date" datetime="{{ $day['date'] }}">
											<span class="calendar__row__container__col__date__name">{{ $day['day'] }}</span>
											<span class="calendar__row__container__col__date__number">{{ \Carbon\Carbon::parse($day['date'])->format('d') }}</span>
										</time>
									</div>
								@endforeach
							</div>
						</div>
					</div> 
                    <div class="calendar-body">
                        @foreach ($filteredUser as $fUser)
                        @php 
                            $i = 1;
                            $position = [];
                            $same_date = 'empty';
                            $event_layer = 1;
                            $result = \App\Models\CRM\ProjectIntervention::whereIn('id', $interventions->where('user_id', $fUser->id)->pluck('id'))->select('Date_intervention')
                            ->selectRaw('count(Date_intervention) as qty')
                            ->groupBy('Date_intervention')
                            ->orderBy('qty', 'DESC')
                            ->first();
                        @endphp
                            <div class="calendar__row">
                                @if (!$sales_user)
                                    <div class="calendar__row__item">
                                        <div class="calendar__row__item__list" style="color: {{ $fUser->color }};background-color: {{ $fUser->background_color }}">
                                            <span class="calendar__row__item__list__text">{{ $fUser->name }}</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="calendar__row__container" style="--total-event-layer: {{ $result->qty ?? 1 }};">
                                    @foreach ($full_month as $date)
                                        <div class="calendar__row__container__col" data-date="{{ $date['date'] }}"></div>
                                        @php
                                            $position[$date['date']] = $loop->iteration;
                                        @endphp
                                    @endforeach
                                    @foreach ($interventions->where('user_id', $fUser->id) as $intervention)
                                        @php
                                            if($intervention->Date_intervention == $same_date){
                                                ++$event_layer;
                                            }else{
                                                $event_layer = 1;
                                                $same_date = $intervention->Date_intervention;
                                            }
                                        @endphp

                                        <div class="calendar__row__container__event" style="--event-color: {{ $fUser->background_color }}; --event-start: {{ $position[\Carbon\Carbon::parse($intervention->Date_intervention)->format('Y-m-d')] ?? '' }}; --event-end: {{ $position[\Carbon\Carbon::parse($intervention->Date_intervention)->format('Y-m-d')] ?? '' }}; --event-layer: {{ $event_layer }};">
                                            <button type="button" class="calendar__row__container__event__arrow getPreviousLocation" data-distance="0" data-user-id="{{ $fUser->id }}" data-intervention-id="{{ $intervention->id }}" data-toggle="tooltip" data-placement="top" data-html="true" title='Emplacement introuvable'> 
                                                <i class="bi bi-chevron-up"></i>
                                                {{-- @if (checkAction(Auth::id(), 'project', 'magic-planning') || role() == 's_admin')
                                                    <a href="{{ route('magic.planning', $intervention->project_id) }}" target="_blank" class="calendar__row__container__event__arrow__inner-btn" data-project-id="{{ $intervention->project_id }}">
                                                        <img  loading="lazy"  src="{{ asset('dashboard_assets/images/magic-planing.png') }}" alt="magic" width="9" />
                                                    </a>
                                                @endif --}}
                                            </button>
                                            <div role="button" tabindex="0" class="calendar__row__container__event__card interventionEditModal" data-id="{{ $intervention->id }}">
                                                <span class="calendar__row__container__event__text">{{ $intervention->getProject->Nom }}</span>
                                                <span class="calendar__row__container__event__indicator" style="background-color: {{ $intervention->getStatusPlanning ? $intervention->getStatusPlanning->background_color : '#ff0000'  }};"></span>
                                            </div>
                                            <button type="button" class="calendar__row__container__event__arrow getNextLocation" data-distance="0" data-user-id="{{ $fUser->id }}" data-intervention-id="{{ $intervention->id }}" data-toggle="tooltip" data-html="true" data-placement="bottom" title='Emplacement introuvable'> 
                                                <i class="bi bi-chevron-down"></i>
                                            </button>
                                            <div class="calendar__row__container__event__details">
                                                <h3 class="calendar__row__container__event__details__title"><strong>Nom: </strong>{{ $intervention->getProject->Nom.' '.$intervention->getProject->Prenom }}</h3>
                                                <p class="calendar__row__container__event__details__text"><strong>Ville: </strong>{{ $intervention->getProject->Ville }}</p>
                                                <p class="calendar__row__container__event__details__text"><strong>Code Postal: </strong>{{ $intervention->getProject->Code_Postal }}</p>
                                                <p class="calendar__row__container__event__details__text"><strong>Téléphone: </strong>{{ $intervention->getProject->phone }}</p>
                                                <p class="calendar__row__container__event__details__text"><strong>Type d’intervention: </strong>{{ $intervention->type }}</p>
                                                <p class="calendar__row__container__event__details__text"><strong>Attribué à: </strong>{{ $intervention->getUser->name ?? '' }}</p>
                                                <p class="calendar__row__container__event__details__text"><strong>Travaux: </strong>
                                                    @foreach ($intervention->getProject->ProjectTravaux as $travaux)
                                                    {{ $travaux->tag }} {{ $loop->last ? '':', ' }}
                                                @endforeach</p>
                                            </div>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp 
                                    @endforeach
                                </div>
                            </div>
                        @endforeach 
                    </div> 
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Right Aside Modal -->
<div class="modal modal--aside fade rightAsideModal" id="rightAsideModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
	<div class="modal-dialog m-0 h-100 bg-white">
		<div class="modal-content simple-bar border-0 h-100 rounded-0">
			<div class="modal-header border-0 pb-0">
				<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
					<span class="novecologie-icon-close"></span>
				</button>
			</div>
			<div class="modal-body pt-0">
				<div class="d-flex flex-column align-items-center mb-2">
					<h1 id="addEventheader" class="modal-title text-center">Ajouter une intervention</h1>
				</div>
				<form action="{{ route('planning.intervention.store') }}" class="form" id="addEventForm" method="POST">
					@csrf
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="project_id0">Selection un chantier <span class="text-danger">*</span></label>
								<select class="select2_select_option custom-select shadow-none form-control required_field" data-error-message="Le champ chantier est requis" id="project_id0" name="project_id">
									<option value="" selected>{{ __('Select') }}</option>
									@foreach ($projects as $project)
										<option value="{{ $project['id'] }}">{{ $project['Nom'].' '.$project['Prenom'].'-'.$project['tag'].'-'.$project['Code_Postal'] }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="intervention0">Selection une intervention <span class="text-danger">*</span></label>
								<select class="select2_select_option custom-select shadow-none form-control inteventionChange required_field" data-error-message="Le champ intervention est requis" data-id="0" id="intervention0" name="type">
									<option value="" selected>{{ __('Select') }}</option>
									<option value="Etude">Etude</option>
									<option value="Pré-Visite Technico-Commercial">Pré-Visite Technico-Commercial</option>
									<option value="Contre Visite Technique">Contre Visite Technique</option>
									<option value="Installation">Installation</option>
									<option value="SAV">SAV</option>
									<option value="Prévisite virtuelle">Prévisite virtuelle</option>
									<option value="Déplacement">Déplacement</option>
                                    <option value="DPE">DPE</option>
								</select>
							</div>
						</div>
						<div class="col-12 interventionInfoWrap0" style="display: none">
							<div class="row" id="interventionInfoWrap0">

							</div>
						</div>

						<div class="col-12 text-center">
							<button type="submit" class="secondary-btn primary-btn--md border-0 interventionSubmitBtn">{{ __('Add') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<form action="{{ route('planning.view.change') }}" method="POST" id="planningViewForm">
    @csrf
    <input type="hidden" name="view_type" id="planningViewInput" value="30">
</form>
<div id="renderModal"> 
</div>
<div id="projectLocationMapModal"> 
</div>

@endsection

@push('js')
<script>

	$(document).ready(function () { 
        let rendaring = false;

        // $("body").on('click','.interventionProjectLocation', function(){
        //     $(".full-preloader").fadeIn("slow");
        //     let project_id = $(this).data('project-id');
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         type : "POST",
        //         url  : "{{ route('planning.project.location.distance') }}",
        //         data : {project_id},
        //         success : response => {
        //             $(".getPreviousLocation").tooltip('hide');
        //             $(".getNextLocation").tooltip('hide');
        //             $(".full-preloader").fadeOut("slow");
        //             $('#projectLocationMapModal').html(response.view);
        //             const mapContainer = document.getElementById('custom-map')
        //             if(mapContainer) {
        //                 (function(){
        //                     let defaultColor = "#6c418e";
        //                     let defaultLocationName = "France";
        //                     let lat = 46.2276;
        //                     let lng = 2.2137;
        //                     let mapImageUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        //                     // let mapImageUrl = 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png';


        //                     const svgIconsCount = [
        //                         '<path fill="#000000" d="M521.76,313.5l-44.85,10.64l-14.06-57.01l77.92-22.04h53.59v267.97h-72.6V313.5z"/>',
        //                         '<path fill="#000000" d="M433.95,457.56l99.59-76.02c24.71-19.38,34.59-31.55,34.59-47.89c0-17.1-11.78-27.37-30.03-27.37   c-17.86,0-31.93,10.64-52.83,34.59l-49.79-41.43c28.51-36.49,57.01-57.01,108.33-57.01c57.77,0,98.06,34.59,98.06,84.76v0.76   c0,42.57-22.05,64.62-61.58,93.12L534.68,453h109.85v60.06H433.95V457.56z"/>',
        //                         '<path fill="#000000" d="M428.82,471.24l46.75-46.37c19.38,19.38,38.77,30.41,63.48,30.41c21.29,0,33.83-10.64,33.83-26.99v-0.76   c0-17.1-14.82-27.37-43.33-27.37h-31.17l-10.26-38.39l60.82-55.11H447.45v-59.67H639.4v52.45l-63.48,54.73   c38.01,8.36,68.8,29.27,68.8,74.88v0.76c0,53.59-43.71,88.56-102.63,88.56C490.4,518.37,455.05,500.13,428.82,471.24z"/>',
        //                         '<path fill="#000000" d="M555.39,461.36H426.16l-11.78-52.07l137.98-164.2h74.12v161.16h33.83v55.11h-33.83v51.69h-71.08V461.36z    M555.39,406.63v-76.78l-63.86,76.78H555.39z"/>',
        //                         '<path fill="#000000" d="M427.87,476.18l42.19-49.41c21.29,18.25,41.81,28.89,64.62,28.89c24.33,0,38.77-11.78,38.77-31.17v-0.76   c0-19.39-15.96-30.79-39.15-30.79c-16.34,0-30.03,5.7-42.57,13.3l-43.71-24.71l7.6-134.55h177.89v60.82H513.78l-2.28,40.29   c12.16-5.7,24.71-9.5,42.57-9.5c47.51,0,91.22,26.61,91.22,84.38v0.76c0,58.91-45.23,94.64-109.85,94.64   C488.31,518.37,455.62,502.03,427.87,476.18z"/>',
        //                         '<path fill="#000000" d="M462.46,487.97c-19.77-19.77-32.69-49.79-32.69-99.59v-0.76c0-82.86,40.29-145.96,123.53-145.96   c37.63,0,62.72,9.88,88.56,29.27l-34.59,51.69c-16.34-12.16-31.55-20.14-52.83-20.14c-38.39,0-48.27,35.73-50.17,57.01   c17.1-13.3,34.59-20.53,57.39-20.53c46.75,0,87.8,29.65,87.8,82.86v0.76c0,59.29-47.51,95.78-105.67,95.78   C505.79,518.37,481.85,507.35,462.46,487.97z M578.01,426.77v-0.76c0-19.38-14.82-34.21-38.01-34.21   c-23.19,0-36.87,14.44-36.87,33.83v0.76c0,19.38,14.44,34.59,37.63,34.59C563.95,460.98,578.01,446.16,578.01,426.77z"/>',
        //                         '<path fill="#000000" d="M563.95,308.94H440.79v-61.96h204.87v55.49L528.22,513.05h-81.34L563.95,308.94z"/>',
        //                         '<path fill="#000000" d="M430.91,439.69v-0.76c0-32.31,16.34-51.69,45.23-63.86c-20.15-11.78-36.11-29.27-36.11-58.16v-0.76   c0-42.57,40.29-73.74,99.97-73.74c59.67,0,100.35,31.17,100.35,73.74v0.76c0,28.89-15.58,46.37-36.49,58.16   c26.99,12.16,45.61,30.79,45.61,63.1v0.76c0,47.89-45.61,78.68-109.47,78.68S430.91,486.07,430.91,439.69z M578.39,432.47v-0.76   c0-17.86-15.58-29.27-38.39-29.27s-38.39,11.4-38.39,29.27v0.76c0,16.34,13.68,30.03,38.39,30.03   C564.71,462.5,578.39,448.82,578.39,432.47z M573.07,325.67v-0.76c0-14.82-12.16-28.13-33.07-28.13   c-20.15,0-32.69,13.3-32.69,28.13v0.76c0,16.72,12.92,29.27,32.69,29.27C559.77,354.93,573.07,342.39,573.07,325.67z"/>',
        //                         '<path fill="#000000" d="M576.49,401.68c-16.34,15.2-35.35,21.67-56.63,21.67c-51.69,0-89.32-32.31-89.32-84.38v-0.76   c0-58.92,45.23-96.54,106.05-96.54c38.39,0,61.58,10.64,81.72,30.79c19.38,19.38,31.93,49.79,31.93,98.82v0.76   c0,86.66-43.33,146.34-122.77,146.34c-39.91,0-68.42-12.16-93.12-31.55l34.59-50.93c18.62,14.82,35.73,21.29,57.01,21.29   C564.71,457.18,574.59,422.97,576.49,401.68z M577.25,335.93v-0.76c0-20.91-14.82-36.49-38.01-36.49   c-23.19,0-37.25,15.2-37.25,36.11v0.76c0,20.14,14.82,34.97,38.01,34.97C563.19,370.52,577.25,355.31,577.25,335.93z"/>',
        //                         '<path fill="#000000" d="M383.02,313.5l-44.85,10.64l-14.06-57.01l77.92-22.04h53.59v267.97h-72.6V313.5z"/><path fill="#000000" d="M497.05,380.78v-0.76c0-75.26,47.89-138.35,123.53-138.35c75.64,0,122.77,62.34,122.77,137.59v0.76   c0,75.26-47.51,138.36-123.53,138.36C544.18,518.37,497.05,456.04,497.05,380.78z M669.23,380.78v-0.76   c0-42.57-20.15-73.36-49.41-73.36c-29.27,0-48.65,30.03-48.65,72.6v0.76c0,42.95,20.15,72.98,49.41,72.98   C650.23,453,669.23,422.97,669.23,380.78z"/>'
        //                     ];

        //                     let customSvgMarkerIcon = function(colorCode, index){
        //                         return L.divIcon({
        //                             html: `
        //                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 1080 1080" xml:space="preserve">
        //                                 ${svgIconsCount[index]}
        //                                 <path fill="${colorCode}" d="M922.06,379.62C915.75,174.04,747.2,9.3,540.14,9.12h-0.28C488.1,9.16,438.74,19.49,393.72,38.18  C258.66,94.22,162.67,225.43,157.94,379.62c-0.23,7.6-7.9,143.89,107.89,307.21l235.12,360.43c7.59,14.49,22.57,23.59,38.92,23.63  h0.28c16.35-0.04,31.34-9.14,38.92-23.63l235.12-360.43C929.97,523.51,922.3,387.21,922.06,379.62z M540,661.88  c-151.18,0-273.74-122.56-273.74-273.74S388.82,114.4,540,114.4s273.74,122.56,273.74,273.74S691.18,661.88,540,661.88z"/>
        //                             </svg>
        //                             `,
        //                             iconSize: [52, 70],
        //                             iconAnchor: [26, 37],
        //                             popupAnchor: [-13, -35],
        //                         });
        //                     }

        //                     let defaultSvgMarkerIconMain = function(colorCode){
        //                         return L.divIcon({
        //                             html: ` 
        //                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 1080 1080" style="enable-background:new 0 0 1080 1080;" xml:space="preserve">
        //                                 <path fill="${colorCode}" d="M922.06,379.62C915.75,174.04,747.2,9.3,540.14,9.12h-0.28C488.1,9.16,438.74,19.49,393.72,38.18  C258.66,94.22,162.67,225.43,157.94,379.62c-0.23,7.6-7.9,143.89,107.89,307.21l235.12,360.43c7.59,14.49,22.57,23.59,38.92,23.63  h0.28c16.35-0.04,31.34-9.14,38.92-23.63l235.12-360.43C929.97,523.51,922.3,387.21,922.06,379.62z M540,661.88  c-151.18,0-273.74-122.56-273.74-273.74S388.82,114.4,540,114.4s273.74,122.56,273.74,273.74S691.18,661.88,540,661.88z"/>
        //                             </svg>
        //                             `,
        //                             iconSize: [52, 70],
        //                             iconAnchor: [26, 37],
        //                             popupAnchor: [-13, -35],
        //                         });
        //                     };

        //                     let userMarkerIcon = L.Icon.extend({
        //                             options: {
        //                                 iconSize: [37, 37],
        //                                 iconAnchor: [37, 39],
        //                                 popupAnchor: [-18.5, -37],
        //                                 className: "user-marker-icon"
        //                             }
        //                     });
        //                     let mainMarkerIcon = L.icon({
        //                         iconSize: [40, 40],
        //                         iconAnchor: [20, 20],
        //                         popupAnchor: [-20, -40],
        //                         iconUrl: "{{ asset('crm_assets/assets/images/map/markers/marker-icon-main.svg') }}",
        //                         shadowUrl: "",
        //                     });
        //                     let defaultMarkerIcon = L.icon({
        //                         iconSize: [26, 35],
        //                         iconAnchor: [26, 37],
        //                         popupAnchor: [-13, -35],
        //                         iconUrl: "{{ asset('crm_assets/assets/images/map/markers/marker-icon-new.svg') }}",
        //                     });
        //                     var allLocations = [];

        //                     response.projects.forEach((project, index) => {
        //                     allLocations.push([`
        //                     <table style="text-align:left">
        //                             <tr>
        //                                 <th>
        //                                     Nom
        //                                 </th>
        //                                 <td>
        //                                     : ${project.Nom}   
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Prenom
        //                                 </th>
        //                                 <td>
        //                                     : ${project.Prenom}
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Département
        //                                 </th>
        //                                 <td>
        //                                     : ${project.Département}
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Téléphone
        //                                 </th>
        //                                 <td>
        //                                     : ${project.phone}
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Project
        //                                 </th>
        //                                 <td>
        //                                     : ${project.tag}
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Etiquette
        //                                 </th>
        //                                 <td>
        //                                     : ${project.status}
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Statut
        //                                 </th>
        //                                 <td>
        //                                     : ${project.sub_status}
        //                                 </td>
        //                             </tr>
        //                         </table>
        //                     `, project.latitude, project.longitude,
        //                         customSvgMarkerIcon(project.color, index)
        //                     ]);
        //                     allLocations.push([`
        //                         <table style="text-align:left">
        //                             <tr>
        //                                 <th>
        //                                     Nom
        //                                 </th>
        //                                 <td>
        //                                     : ${response.main_project.Nom}   
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Prenom
        //                                 </th>
        //                                 <td>
        //                                     : ${response.main_project.Prenom}
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Département
        //                                 </th>
        //                                 <td>
        //                                     : ${response.main_project.Département}
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Téléphone
        //                                 </th>
        //                                 <td>
        //                                     : ${response.main_project.phone}
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Project
        //                                 </th>
        //                                 <td>
        //                                     : ${response.main_project.tag}
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Etiquette
        //                                 </th>
        //                                 <td>
        //                                     : ${response.main_project.status}
        //                                 </td>
        //                             </tr>
        //                             <tr>
        //                                 <th>
        //                                     Statut
        //                                 </th>
        //                                 <td>
        //                                     : ${response.main_project.sub_status}
        //                                 </td>
        //                             </tr>
        //                         </table>
        //                     `, response.main_project.latitude, response.main_project.longitude,
        //                     defaultSvgMarkerIconMain("#000000")
        //                     ]);
        //                 });


        //                     let map = L.map('custom-map', {
        //                         center: [lat, lng],
        //                         zoom: 7,
        //                         minZoom: 5,
        //                         attributionControl: false,
        //                         gestureHandling: true
        //                     });

        //                     L.tileLayer(mapImageUrl).addTo(map);
        //                     // $.getJSON('{{ asset("crm_assets/assets/json/geo-FRA.json") }}').then(function(geoJSON) {
        //                     //     const osm = new L.TileLayer.BoundaryCanvas(mapImageUrl, {
        //                     //         boundary: geoJSON,
        //                     //     })
        //                     //     map.addLayer(osm)
        //                     //     const franceLayer = L.geoJSON(geoJSON)
        //                     //     map.fitBounds(franceLayer.getBounds())
        //                     // });

        //                     for (var i = 0; i < allLocations.length; i++) {
        //                     marker = new L.marker([allLocations[i][1], allLocations[i][2]], {icon: allLocations[i][3]})
        //                         .bindPopup(allLocations[i][0])
        //                         .addTo(map);
        //                     map.panTo(L.latLng(allLocations[i][1], allLocations[i][2]));
        //                     };

        //                     var circles;
        //                     var main_marker;

        //                     function onLocationFound(e) {
        //                         var radius = e.accuracy / 2;

        //                         if (!map.hasLayer(circles) && !map.hasLayer(main_marker)) {
        //                             map.panTo(L.latLng(e.latlng));
        //                         }

        //                         if (map.hasLayer(circles) && map.hasLayer(main_marker)) {
        //                             map.removeLayer(circles);
        //                             map.removeLayer(main_marker);
        //                         }


        //                         main_marker = new L.marker(e.latlng, {icon: mainMarkerIcon, riseOnHover: true}).addTo(map);
        //                         circles = new L.circle(e.latlng, radius, {fillColor: '#000000', fillOpacity: 0.14 , stroke: false }).addTo(map);
        //                         circles.bindPopup("You are within " + radius + " meters from this point");

        //                         map.addLayer(main_marker);
        //                         map.addLayer(circles);
        //                     };

        //                     function onLocationError() {
        //                         // $('.toast.toast--error').toast('show');
        //                         L.marker([lat, lng], {icon: defaultSvgMarkerIcon(defaultColor)}).addTo(map)
        //                             .bindPopup('Default Location <br>' + defaultLocationName)
        //                             .openPopup();

        //                         map.panTo(L.latLng(lat, lng));
        //                     };

        //                     // map.on('locationfound', onLocationFound);
        //                     // map.on('locationerror', onLocationError);

        //                     map.locate({
        //                         // setView: true,
        //                         watch: true,
        //                         maxZoom: 13,
        //                     });

        //                 })()
        //             };

        //             $("#interventionProjectLocationModal").modal('show');
        //             setTimeout(function () {
        //                 window.dispatchEvent(new Event("resize"));
        //                 $('#custom-map').css('min-height', '430px');
        //             }, 500);
        //         }, 
        //         error : errors => {
        //             $(".full-preloader").fadeOut("slow");
        //         }
        //     }); 
        // });

        $('body').on('click', '.interventionEditModal', function(){  
            if(!rendaring){
                rendaring = true;
                let id = $(this).data('id'); 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type : "POST",
                    url  : "{{ route('planning.intervention.modal.render') }}",
                    data : {id},
                    success : response => {
                        $(".getPreviousLocation").tooltip('hide');
                        $(".getNextLocation").tooltip('hide');
                        $("#renderModal").html(response);   
                        $("#planningInterventionEdit").modal('show');
                        rendaring = false;
                        $('.select2_select_option').each(function(){
                            $(this).select2({
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
                        var select2_with_color = $(".select2_color_option");
                        if(select2_with_color.length){
                            function renderCustomResultTemplat(option) {
                                if (!option.id) {
                                    return option.text;
                                }
    
                                let $returnTemplate = `
                                <div class="px-3 py-2" style="color: ${$(option.element).data('color')}; background-color: ${$(option.element).data('background')}">
                                    ${option.text}
                                </div>
                                `
    
                                return $returnTemplate;
                            }
    
                            function renderCustomSelectionTemplat(option) {
                                if (option.id === '') {
                                    let $returnTemplate = `<div class="px-3 h-100">${option.text}</div>`
                                    return $returnTemplate;
                                }
    
                                if (!option.id) {
                                    return option.text;
                                }
    
                                let $returnTemplate = `
                                <div class="px-3 h-100" style="color: ${$(option.element).data('color')}; background-color: ${$(option.element).data('background')}">
                                    ${option.text}
                                </div>
                                `
    
                                return $returnTemplate;
                            }
    
                            select2_with_color.each(function(){
                                $(this).wrap('<div class="position-relative select2_color_option-parent"></div>').select2({
                                    width: '100%',
                                    dropdownParent: $(this).parent(),
                                    templateResult: renderCustomResultTemplat,
                                    templateSelection: renderCustomSelectionTemplat,
                                    escapeMarkup: function (es) {
                                        return es;
                                    }
                                });
    
                            });
                        }

                        const isMobile = () => /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                        if(isMobile()){
                            $('.waze-mobile-button').removeClass('d-none');
                        }
    
                        @if (role() != 's_admin' && !checkAction(Auth::id(), 'collapse_intervention', 'edit'))
                            $('.intervention_disabled').prop('disabled', true);
                        @endif 
                    },error : errors => {
                        rendaring = false;
                    }
                });  
            }
		});

        $("body").on('mouseenter','.getPreviousLocation', function(){
            $(".getPreviousLocation").tooltip('hide');
            $(".getNextLocation").tooltip('hide');
            if($(this).data('distance') == '0'){
                let user_id = $(this).data('user-id');
                let intervention_id = $(this).data('intervention-id');
                let type = 'previous';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type : "POST",
                    url  : "{{ route('planning.location.distance') }}",
                    data : {user_id, intervention_id, type},
                    success : response => {
                        $(".getPreviousLocation").tooltip('hide');
                        $(".getNextLocation").tooltip('hide');
                        $(this).attr('data-original-title', response).tooltip('show');
                        $(this).data('distance', '1');
                    }
                }); 
            }else{ 
                $(this).tooltip('show');
            }
        });
        $("body").on('mouseenter','.getNextLocation', function(){
            $(".getPreviousLocation").tooltip('hide');
            $(".getNextLocation").tooltip('hide');
            if($(this).data('distance') == '0'){
                let user_id = $(this).data('user-id');
                let intervention_id = $(this).data('intervention-id');
                let type = 'next';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type : "POST",
                    url  : "{{ route('planning.location.distance') }}",
                    data : {user_id, intervention_id, type},
                    success : response => {
                        $(".getPreviousLocation").tooltip('hide');
                        $(".getNextLocation").tooltip('hide');
                        $(this).attr('data-original-title', response).tooltip('show');
                        $(this).data('distance', '1');
                    }
                }); 
            }else{ 
                $(this).tooltip('show');
            }
        }); 

        $('body').on('change', '.intervention_travaux_change', function(){
            let travaux = $(this).val();
            let wrap = $(this).closest('.row').find('.intervention_travaux_product');
            if(travaux){ 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }); 

                $.ajax({
                    type: "POST",
                    url: "{{ route('intervention.travaux.change2') }}",
                    data: {travaux},
                    success: function (response) { 
                        wrap.html(response);
                    }, 
                    error: function(errors){   
                        wrap.html('<option value="" selected>{{ __("Select") }}</option>');
                    }
                });
            }else{
                wrap.html('<option value="" selected>{{ __("Select") }}</option>');
            }
        });

        $('body').on('click', '.interventionSubmitBtn', function(e){
			e.preventDefault();
            let form = $(this).closest('form');
            let required_input = form.find('.required_field');
            let error_status = false;
            required_input.each(function(){
                if(jQuery.type($(this).val()) == 'array'){ 
                }else{ 
                    if($(this).val() == null || !$(this).val().trim()){
                        $('#errorMessage').html($(this).data('error-message'));
                        $('.toast.toast--error').toast('show');
                        $(this).focus();
                        error_status = true;
                        return false;
                    }
                }
            });
            if(!error_status){
                form.submit();
            }
		});

        $('body').on('change','.other_field__system2', function(){
			let autre_box = $(this).data('autre-box');
            if($(this).val() == 'Oui'){
                $('.'+autre_box).slideDown();
            }else{
                $('.'+autre_box).slideUp();
            }
		});

		$('body').on('change', '#planningView', function(){
			 $("#planningViewInput").val($(this).val());
             $('#planningViewForm').submit();
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
		// $(".addEvent-btn").click(function(){
		// 	$("#addEventForm")[0].reset();
		// 	$('#eventAddButton').text("{{ __('Add') }}");
		// 	$('#projectSelect').html("<option value='' disabled>{{ __('Select') }}</option>");
		// 	$("#UserSelect").val(null).trigger("change");
		// 	$('#client_details_id').removeClass("d-inline-block");
		// 	$('#client_details_id').addClass("d-none");
		// });

		$('body').on('change', '#project_id0', function(){
			let type = $('#intervention0').val('').trigger('change');
			$('.interventionInfoWrap0').slideUp();

		});
		$('body').on('change', '.inteventionChange', function(){
			let type = $(this).val();
			if(type){
				let project_id = $('#project_id'+$(this).data('id')).val();
				$('.interventionInfoWrap'+$(this).data('id')).slideUp();
				if(project_id){
					$.ajax({
						type : 'POST',
						url  : '{{ route("planning.intervention.change") }}',
						data : {type, project_id},
						success : response => {
							$('#interventionInfoWrap'+$(this).data('id')).html(response);
							$('.select2_select_option').each(function(){
								$(this).select2({
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
							var select2_with_color = $(".select2_color_option");
                            if(select2_with_color.length){
                                function renderCustomResultTemplat(option) {
                                    if (!option.id) {
                                        return option.text;
                                    }

                                    let $returnTemplate = `
                                    <div class="px-3 py-2" style="color: ${$(option.element).data('color')}; background-color: ${$(option.element).data('background')}">
                                        ${option.text}
                                    </div>
                                    `

                                    return $returnTemplate;
                                }

                                function renderCustomSelectionTemplat(option) {
                                    if (option.id === '') {
                                        let $returnTemplate = `<div class="px-3 h-100">${option.text}</div>`
                                        return $returnTemplate;
                                    }

                                    if (!option.id) {
                                        return option.text;
                                    }

                                    let $returnTemplate = `
                                    <div class="px-3 h-100" style="color: ${$(option.element).data('color')}; background-color: ${$(option.element).data('background')}">
                                        ${option.text}
                                    </div>
                                    `

                                    return $returnTemplate;
                                }

                                select2_with_color.each(function(){
                                    $(this).wrap('<div class="position-relative select2_color_option-parent"></div>').select2({
                                        width: '100%',
                                        dropdownParent: $(this).parent(),
                                        templateResult: renderCustomResultTemplat,
                                        templateSelection: renderCustomSelectionTemplat,
                                        escapeMarkup: function (es) {
                                            return es;
                                        }
                                    });

                                });
                            }
							$('.interventionInfoWrap'+$(this).data('id')).slideDown();
						}
					})
				}else{
					$('#project_id'+$(this).data('id')).focus();
					$('#errorMessage').text("Veuillez sélectionner un chantier");
					$('.toast.toast--error').toast('show');
				}
			}

		});
		$('body').on('change', '.Statut_planning_input', function(){
            if($(this).val() == 'Annulé' || $(this).val() == 'Reportée'){
                $('.Statut_planning_wrap'+$(this).data('id')).slideDown();
            }else{
                $('.Statut_planning_wrap'+$(this).data('id')).slideUp();
            }
		});
		$('body').on('change', '.Faisabilité_du_chantier_input', function(){
            if($(this).val() == 'Faisable sous condition'){
                $('.Faisabilité_du_chantier_wrap'+$(this).data('id')).slideDown();
                $('.Faisabilité_du_chantier_wrap_Infaisable'+$(this).data('id')).slideUp();
                $('.required_field__optionFaisable_sous_condition'+$(this).data('id')).addClass('required_field');
                $('.required_field__optionInfaisable'+$(this).data('id')).removeClass('required_field');
            }else if($(this).val() == 'Infaisable'){
                $('.Faisabilité_du_chantier_wrap_Infaisable'+$(this).data('id')).slideDown();
                $('.Faisabilité_du_chantier_wrap'+$(this).data('id')).slideUp();
                $('.required_field__optionFaisable_sous_condition'+$(this).data('id')).removeClass('required_field');
                $('.required_field__optionInfaisable'+$(this).data('id')).addClass('required_field');

            }
            else{
                $('.Faisabilité_du_chantier_wrap'+$(this).data('id')).slideUp();
                $('.Faisabilité_du_chantier_wrap_Infaisable'+$(this).data('id')).slideUp();
                $('.required_field__optionFaisable_sous_condition'+$(this).data('id')).removeClass('required_field');
                $('.required_field__optionInfaisable'+$(this).data('id')).removeClass('required_field');

            }
		});

        $('body').on('change', '.Statut_contrat_input', function(){
            if($(this).val() == 'Devis Signé'){
                $('.Statut_contrat__Réflexion'+$(this).data('id')).slideUp();
                $('.Statut_contrat__KO'+$(this).data('id')).slideUp();
                $('.Statut_contrat__Signé'+$(this).data('id')).slideDown();
                $('.required_field__option'+$(this).data('id')).addClass('required_field');
            }else if($(this).val() == 'Réflexion'){
                $('.Statut_contrat__Signé'+$(this).data('id')).slideUp();
                $('.Statut_contrat__KO'+$(this).data('id')).slideUp();
                $('.Statut_contrat__Réflexion'+$(this).data('id')).slideDown();
                $('.required_field__option'+$(this).data('id')).removeClass('required_field');
            }else if($(this).val() == 'KO'){
                $('.Statut_contrat__Signé'+$(this).data('id')).slideUp();
                $('.Statut_contrat__Réflexion'+$(this).data('id')).slideUp();
                $('.Statut_contrat__KO'+$(this).data('id')).slideDown();
                $('.required_field__option'+$(this).data('id')).removeClass('required_field');
            }else{
                $('.required_field__option'+$(this).data('id')).removeClass('required_field');
                $('.Statut_contrat__Réflexion'+$(this).data('id')).slideUp();
                $('.Statut_contrat__KO'+$(this).data('id')).slideUp();
                $('.Statut_contrat__Signé'+$(this).data('id')).slideUp();
            }
        });

        $('body').on('click', '.add__new_intervention_travaux__1', function(){
            let count = +$('.interventionTravauxCount'+$(this).data('id')).val()+1;

            let data = `<div class="intervention_travaux__wrap" style="display:none">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="number[]" value="${count}">
                                    <label class="form-label" for="intervention_travaux0${count}">Travaux ${count}</label>
                                    <select name="travaux_id[${count}]" id="intervention_travaux0${count}" class="select2_select_option form-control intervention_disabled intervention_travaux_change">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($bareme_travaux_tags as $t_travaux)
                                            <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-group flex-grow-1">
                                    <label class="form-label" for="travaux">Produit</label>
                                    <select name="product_id[${count}]" class="select2_select_option form-control w-100 intervention_disabled intervention_travaux_product">
                                        <option value="" selected>{{ __('Select') }}</option> 
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                                <div class="form-group ml-3 pb-1">
                                    <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                </div>
                            </div>
                        </div>
                        </div>`;
            $('#Statut_contrat__Signé_end'+$(this).data('id')).before(data);
            $('.interventionTravauxCount'+$(this).data('id')).val(count)
            $('.select2_select_option').select2();
            $('.select2_select_option').each(function(){
                $(this).select2({
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
            $('.intervention_travaux__wrap').slideDown(1000);
		});
		$('body').on('click', '.add__new_intervention_travaux', function(){
            let intervention_id = $(this).data('id');
            let count = +$('.interventionTravauxCount'+$(this).data('id')).val()+1;
            let data = `<div class="intervention_travaux__wrap" style="display:none">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="number[]" value="${count}">
                                    <label class="form-label" for="intervention_travaux0${count}">Travaux ${count} <span class="text-danger">*</span></label>
                                    <select name="travaux_id[${count}]" id="intervention_travaux0${count}" class="select2_select_option form-control intervention_disabled required_field required_field__option${intervention_id}  intervention_travaux_change" data-error-message="Le champ travaux est requis">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($bareme_travaux_tags as $t_travaux)
                                            <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6  d-flex align-items-end">
                                <div class="form-group  flex-grow-1">
                                    <label class="form-label" for="travaux">Produit</label>
                                    <select name="product_id[${count}]" class="select2_select_option form-control w-100 intervention_disabled intervention_travaux_product" data-error-message="Le champ produit est requis">
                                        <option value="" selected>{{ __('Select') }}</option> 
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                                <div class="form-group ml-3 pb-1">
                                    <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                </div>
                            </div>
                        </div>
                        </div>`;
            $('#Statut_contrat__Signé_end'+$(this).data('id')).before(data);
            $('.interventionTravauxCount'+$(this).data('id')).val(count)
            $('.select2_select_option').select2();
            $('.select2_select_option').each(function(){
                $(this).select2({
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
            $('.intervention_travaux__wrap').slideDown(1000);
		});

		$('body').on('click', '.remove__intervention_travaux', function(){
            $(this).closest('.intervention_travaux__wrap').slideUp(function(){
                $(this).remove();
            })
        });

		$('body').on('change','.other_field__system', function(){
			let autre_box = $(this).data('autre-box');
			let input_type = $(this).data('input-type');
			let select_type = $(this).data('select-type');
			if(input_type == 'select'){
				if(select_type == 'single'){
					if($(this).val() == 'Autre'){
						$('.'+autre_box).slideDown();
					}else{
						$('.'+autre_box).slideUp();
					}
				}
			}else if(input_type == 'radio'){
				if($(this).val() == 'Autre'){
					$('.'+autre_box).slideDown();
				}else{
					$('.'+autre_box).slideUp();
				}
			}else if(input_type == 'radio_checkbox'){
				if($(this).is(":checked") && $(this).val() == 'Autre'){
					$('.'+autre_box).slideDown();
				}else{
					$('.'+autre_box).slideUp();
				}
			}
			else{
				if($(this).is(":checked")){
					$('.'+autre_box).slideDown();
				}else{
					$('.'+autre_box).slideUp();
				}
			}

		});

		$('body').on('change', '.Dossier_administratif_complet__input', function(){
            if($(this).val() == 'no'){
                $('.Dossier_administratif_complet__wrap'+$(this).data('id')).slideDown();
            }else{
                $('.Dossier_administratif_complet__wrap'+$(this).data('id')).slideUp();
            }
		});

		$('body').on('click', '.add__new_intervention_travaux__2', function(){
            let count = +$('.interventionTravauxCount'+$(this).data('id')).val()+1;

            let data = `<div class="intervention_travaux__wrap" style="display:none">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center">
                                <div class="form-group  w-100">
                                    <input type="hidden" name="number[]" value="${count}">
                                    <label class="form-label" for="intervention_travaux0${count}">Travaux ${count}</label>
                                    <select name="travaux_id[${count}]" id="intervention_travaux0${count}" class="select2_select_option form-control intervention_disabled">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($bareme_travaux_tags->where('rank', 2) as $t_travaux)
                                            <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ml-3 mt-3">
                                    <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        `;
            $('#Travaux_supplémentaires__start'+$(this).data('id')).append(data);
            $('.interventionTravauxCount'+$(this).data('id')).val(count)
            $('.select2_select_option').select2();
            $('.select2_select_option').each(function(){
                $(this).select2({
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
            $('.intervention_travaux__wrap').slideDown(1000);
		});
		$('body').on('click', '.add__new_intervention_travaux__3', function(){
            let count = +$('.interventionTravauxCount'+$(this).data('id')).val()+1;

            let data = `<div class="intervention_travaux__wrap" style="display:none">
                        <input type="hidden" name="number[]" value="${count}">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="intervention_travaux0${count}">Travaux ${count}</label>
                                    <select name="travaux_id[${count}]" id="intervention_travaux0${count}"  data-travaux-number="${count}" data-travaux-wrap="interventionTravauxControlProjectWrapa${count}" class="select2_select_option interventionTravauxChange form-control intervention_disabled  intervention_travaux_change">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($bareme_travaux_tags as $t_travaux)
                                            <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-group flex-grow-1">
                                    <label class="form-label" for="travaux">Produit</label>
                                    <select name="product_id[${count}]" class="select2_select_option form-control w-100 intervention_disabled  intervention_travaux_product">
                                        <option value="" selected>{{ __('Select') }}</option> 
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                                <div class="form-group ml-3 pb-1">
                                    <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                </div>
                            </div>
                            @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body" style="background-color: #fbfbfb">
                                            <div class="row">
                                                <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                                    <h4 class="mb-0 mr-2">Réception photos Installation <span class="text-danger">*</span></h4>
                                                    <label class="switch-checkbox switch-checkbox--danger">
                                                        <input type="hidden"  name="Réception_photos_Installation[${count}]" value="no" class="hiddenInput">
                                                        <input type="checkbox" value="yes" data-autre-box="Réception_photos_Installation__${count}" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                                        <span class="switch-checkbox__label"></span>
                                                    </label>
                                                </div>
                                                <div class="col-12 mt-3 Réception_photos_Installation__${count}"  style="display: none">
                                                    <div class="row ">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Réception_photos_Installation_Par${count}">Par</label>
                                                                <select name="Réception_photos_Installation_Par[${count}]" id="Réception_photos_Installation_Par${count}" class="select2_select_option form-control intervention_disabled">
                                                                    <option value="" selected>{{ __('Select') }}</option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Réception_photos_Installation_Le${count}">Le </label>
                                                                <input type="date" name="Réception_photos_Installation_Le[${count}]" id="Réception_photos_Installation_Le${count}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <h4 class="mt-2">Contrôle conformité photos</h4>
                                                        <select name="Contrôle_conformité_photos[${count}]" id="Contrôle_conformité_photos${count}" data-error-message="Le champ contrôle conformité photos est requis" data-autre-box="Contrôle_conformité_photos__${count}" class="select2_select_option other_field__system2 form-control intervention_disabled">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3 Contrôle_conformité_photos__${count}"  style="display: none">
                                                    <div class="row ">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Contrôle_conformité_photos_Par${count}">Par</label>
                                                                <select name="Contrôle_conformité_photos_Par[${count}]" id="Contrôle_conformité_photos_Par${count}" class="select2_select_option form-control intervention_disabled">
                                                                    <option value="" selected>{{ __('Select') }}</option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Contrôle_conformité_photos_Le${count}">Le </label>
                                                                <input type="date" name="Contrôle_conformité_photos_Le[${count}]" id="Contrôle_conformité_photos_Le${count}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12" id="interventionTravauxControlProjectWrapa${count}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        </div>`;
            $('#Statut_Installation__start'+$(this).data('id')).before(data);
            $('.interventionTravauxCount'+$(this).data('id')).val(count)
            $('.select2_select_option').select2();
            $('.select2_select_option').each(function(){
                $(this).select2({
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
            $('.intervention_travaux__wrap').slideDown(1500);
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
		});


		$('body').on('change', '.Statut_Installation_input', function(){
            if($(this).val() == 'Terminé - Complet'){
                $('.Statut_Installation__incomplete'+$(this).data('id')).slideUp();
                $('.Statut_Installation__complete'+$(this).data('id')).slideDown();
            }else{
                $('.Statut_Installation__complete'+$(this).data('id')).slideUp();
                $('.Statut_Installation__incomplete'+$(this).data('id')).slideDown();
            }
		});

		$('body').on('change', '.interventionTravauxChange', function(){
			let travaux_number = $(this).data('travaux-number');
			let travaux = $(this).val();
			if(travaux){
				$.ajax({
					type: 'POST',
					url : '{{ route("intervention.travaux.change") }}',
					data: {travaux, travaux_number},
					success : response => {
						$('#'+$(this).data('travaux-wrap')).html(response);
					}
				});
			}else{
				$('#'+$(this).data('travaux-wrap')).html('');
			}
		});

		$('body').on('change', '.checkboxChange', function(){
            if($(this).is(':checked')){
                $(this).closest('.switch-checkbox').find('.hiddenInput').val('yes');
            }else{
                $(this).closest('.switch-checkbox').find('.hiddenInput').val('no');
            }
		});

		$('body').on('change', '.Statut_SAV_input', function(){
            if($(this).val() == 'NON RESOLU'){
                $('.Statut_SAV_wrap'+$(this).data('id')).slideDown();
            }else{
                $('.Statut_SAV_wrap'+$(this).data('id')).slideUp();
            }
		});


		$("#calendar__row__item__filter__search").on("input", function() {
			var value = $(this).val().toLowerCase();
			$(".calendar__row .calendar__row__item .calendar__row__item__list__text").filter(function() {
			$(this).closest('.calendar__row').toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});

		$('#eventAddButton').click(function(e){
			e.preventDefault();
			var title 			= $('#title').val();
			var categorySelect = $('#categorySelect').val();
			var UserSelect 	= $('#UserSelect').val();
			var startDate 		= $('#startDate').val();
			var clientSelect 	= $('#clientSelect').val();
			var projectSelect 	= $('#projectSelect').val();
			var location 		= $('#location').val();

			if( title == ''){
				$('#errorMessage').text("{{ __('Please Enter Title') }}");
				$('.toast.toast--error').toast('show');
				$('#title').focus();
			}

			else if(categorySelect == ''){
				$('#errorMessage').text("{{ __('Please Select Category') }}");
				$('.toast.toast--error').toast('show');
				$('#categorySelect').focus();
			}
			else if(UserSelect == null){
				$('#errorMessage').text("{{ __('Please Select Assignee') }}");
				$('.toast.toast--error').toast('show');
				$('#UserSelect').focus();
			}
			else if(startDate == ''){
				$('#errorMessage').text("{{ __('Please Select Start Date') }}");
				$('.toast.toast--error').toast('show');
				$('#startDate').focus();
			}
			// else if(clientSelect == ''){
			// 	$('#errorMessage').text("{{ __('Please Select Client') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#clientSelect').focus();
			// }
			// else if(projectSelect == ''){
			// 	$('#errorMessage').text("{{ __('Please Select Project') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#projectSelect').focus();
			// }
			else if(location == ''){
				$('#errorMessage').text("{{ __('Please Enter Location') }}");
				$('.toast.toast--error').toast('show');
				$('#geocoder .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').focus();
			}

			else{
				// $('#addEventForm').submit();
			}

		});
		$('.eventEditButton').click(function(e){
			e.preventDefault();
			var id 				= $(this).attr('data-id');
			var title 			= $('#title'+id).val();
			var categorySelect 	= $('#categorySelect'+id).val();
			var UserSelect 		= $('#UserSelect'+id).val();
			var startDate 		= $('#startDate'+id).val();
			var clientSelect 	= $('#clientSelect'+id).val();
			var projectSelect 	= $('#projectSelect'+id).val();
			var location 		= $('#location'+id).val();

			if( title == ''){
				$('#errorMessage').text("{{ __('Please Enter Title') }}");
				$('.toast.toast--error').toast('show');
				$('#title'+id).focus();
			}

			else if(categorySelect == ''){
				$('#errorMessage').text("{{ __('Please Select Category') }}");
				$('.toast.toast--error').toast('show');
				$('#categorySelect'+id).focus();
			}
			else if(UserSelect == null){
				$('#errorMessage').text("{{ __('Please Select Assignee') }}");
				$('.toast.toast--error').toast('show');
				$('#UserSelect'+id).focus();
			}
			else if(startDate == ''){
				$('#errorMessage').text("{{ __('Please Select Start Date') }}");
				$('.toast.toast--error').toast('show');
				$('#startDate'+id).focus();
			}
			else if(clientSelect == ''){
				$('#errorMessage').text("{{ __('Please Select Client') }}");
				$('.toast.toast--error').toast('show');
				$('#clientSelect'+id).focus();
			}
			else if(projectSelect == ''){
				$('#errorMessage').text("{{ __('Please Select Project') }}");
				$('.toast.toast--error').toast('show');
				$('#projectSelect'+id).focus();
			}
			else if(location == ''){
				$('#errorMessage').text("{{ __('Please Enter Location') }}");
				$('.toast.toast--error').toast('show');
				$('#geocoder .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').focus();
			}

			else{
				$('#editEventForm'+id).submit();
			}

		});

		// $(document).on("click", ".calendar-body .calendar__row__container__col", function(){
		// 	$("#startDate").flatpickr({
		// 		altInput: true,
		// 		enableTime: true,
		// 		defaultDate: $(this).data("date"),
		// 	});
		// 	$("#endDate").flatpickr({
		// 		altInput: true,
		// 		enableTime: true,
		// 		minDate: $(this).data("date"),
		// 		defaultDate: "",
		// 	}).clear();
		// 	$('#rightAsideModal').modal('show');
		// });

        @if (role() != 's_admin' && !checkAction(Auth::id(), 'collapse_intervention', 'edit'))
            $('.intervention_disabled').prop('disabled', true);
        @endif 
	});

</script>

@endpush


@push('css')
	<style>
		@for ($i = 1; $i <= $days_in_month; $i++)
		.calendar-body .calendar__row__container__col:nth-of-type({{ $days_in_month }}n + {{ $i }}) {
			grid-column: {{ $i }}/{{ $i }};
		}
		@endfor
	</style>
@endpush
