{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Leads') }}
@endsection



{{-- active menu  --}}
@section('leadIndex')
active
@endsection 





{{-- Main Content Part  --}}
@section('content')
{{-- {{ Auth::user()->name }} --}} 
		<!-- Banner Section -->
		<section class="banner section-gap position-relative pb-xl-0">
			<div class="container">
				<a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a>
				<div class="row justify-content-center">
					 
                    <h3 class="text-white">Accès Refusé</h3>
					 
				</div>
			</div>
		</section> 
@endsection




