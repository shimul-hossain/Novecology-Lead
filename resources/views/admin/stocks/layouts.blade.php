{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	Stock
@endsection

@section('bodyBg')
secondary-bg
@endsection
@push('css')
	 <style>
		 @media (min-width: 992px) {
			#v-pills-tab {
				min-width: 315px;
			}
		}
        .active_sidbar{
            background-color : #0070C0 !important;
            color: white !important;
        };
	 </style>
     @stack('css_style')
@endpush

{{-- active menu  --}}

{{-- Main Content Part  --}}
@section('content')
		<!-- Settings Section -->
		<section class="settings section-gap position-relative">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-auto col-lg-4 mb-4 mb-lg-0">
						<div class="nav flex-column nav-pills parent-nav-pills" style="height: 100vh;" id="v-pills-tab" role="tablist" aria-orientation="vertical">   
                            @if (checkAction(Auth::id(), 'stocks', 'dashboard') || role() == 's_admin')
                                <a class="nav-link @yield('DashboardActive') mx-3 p-1 text-center" href="{{ route('stock.index') }}" style="border: 2px solid #2F528F; margin-bottom: 25px"> 
                                    Dashboard
                                </a>	 
                            @else
                                <a class="nav-link @yield('DashboardActive') mx-3 p-1 text-center" href="{{ route('stock.index') }}" style="border: 2px solid #2F528F; margin-bottom: 25px"> 
                                    <span class="novecologie-icon-lock py-1"></span> Dashboard
                                </a>	 
							@endif
                            @if (checkAction(Auth::id(), 'stocks', 'mouvements') || role() == 's_admin')
                                <a class="nav-link @yield('MouvementsActive') mx-3 p-1 text-center" href="{{ route('stock.mouvements') }}" style="border: 2px solid #2F528F; margin-bottom: 25px"> 
                                    Mouvements
                                </a>
                            @endif
                            @if (checkAction(Auth::id(), 'stocks', 'etat_des_stocks') || role() == 's_admin')
                                <a class="nav-link @yield('EtatActive') mx-3 p-1 text-center" href="{{ route('stock.etat.des.stocks') }}" style="border: 2px solid #2F528F; margin-bottom: 25px"> 
                                    Etat des Stocks
                                </a>
                            @endif
                            @if (checkAction(Auth::id(), 'stocks', 'commandes') || role() == 's_admin')
                                <a class="nav-link @yield('CommandesActive') mx-3 p-1 text-center" href="{{ route('stock.commandes') }}" style="border: 2px solid #2F528F; margin-bottom: 25px"> 
                                    Commandes
                                </a>
                            @endif
                            @if (checkAction(Auth::id(), 'stocks', 'installations') || role() == 's_admin')
                                <a class="nav-link @yield('SuiviActive') mx-3 p-1 text-center" href="{{ route('stock.installations') }}" style="border: 2px solid #2F528F; margin-bottom: 25px"> 
                                    Installations
                                </a> 
                            @endif   
                            {{-- <a class="nav-link @yield('CommandesActive') mx-3 p-1 text-center" href="{{ route('stock.commandes') }}" style="border: 2px solid #2F528F; margin-bottom: 25px"> 
                                Commandes
                            </a>
                            <a class="nav-link @yield('SuiviActive') mx-3 p-1 text-center" href="{{ route('stock.suivi.poseurs') }}" style="border: 2px solid #2F528F; margin-bottom: 25px"> 
                                Installations
                            </a> --}}
						</div>
					</div>
					<div class="col-xl-8 col-lg-8">
						<div class="tab-content bg-white" id="v-pills-tabContent"> 
							 @yield('tab-content')
						</div>
					</div>
				</div>
			</div>
		</section> 

        @yield('modal-content')



@endsection

@push('js')
    @stack('stockJs')
	<script> 
		$(document).ready(function(){ 
            $('.nav-link').each(function(){
                if($(this).hasClass('active_sidbar')){
                    // $(this).attr('href', 'javascript:void(0)');
                } 
            });
		})
	</script>
@endpush
