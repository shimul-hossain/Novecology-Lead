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
				<div class="row justify-content-center"> 
                    <h2 class="text-danger">Désolé, votre compte a été désactivé</h2>
				</div>
			</div>
		</section> 
@endsection




