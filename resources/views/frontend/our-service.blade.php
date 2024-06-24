@extends('layouts.frontend')

@section('service')
active
@endsection

@section('content')

@include('includes.inner_page_menu')


@foreach ( $ourService as $key => $item)
@if ($key % 2 == 0)
<!-- Sub Banner Section -->
<section class="sub-banner">
    <div class="container">
        <div class="row flex-lg-row-reverse">
            @if ($item->image != null)
            <div class="col-lg-5">
                <img src="{{asset('uploads/our_society')}}/{{ $item->image }}" alt="team image"
                    class="img-fluid px-lg-3">
            </div>
            @endif
            <div class="col-lg-7">
                <div class="section-header">
                    <h1 class="section-header__title section-header__title--lg">
                        <strong class="font-weight-bold">{{ $item->title }}</strong>
                    </h1>
                </div>
                <p>{!! $item->details !!}</p>
            </div>
        </div>
    </div>
</section>
@else
<section class="mission section-gap">
    <div class="container">
        <div class="row">
            @if ($item->image != null)
            <div class="col-lg-5">
                <img src="{{asset('uploads/our_society')}}/{{ $item->image }}" alt="team image"
                    class="img-fluid px-lg-3">
            </div>
            @endif
            <div class="col-lg-7">
                <div class="section-header">
                    <h1 class="section-header__title section-header__title--lg">

                        <strong class="font-weight-bold">{{ $item->title }}</strong>
                    </h1>
                </div>
                <p>{!! $item->details !!}</p>
            </div>
        </div>
    </div>

    

</section>

@endif
@endforeach
{{-- 
<style>
    .short_list_img {
        display: inline-block;
        width: 300px;
        height: 60px;
        object-fit: cover;
        margin-top: 20px;
        margin-bottom: 80px
    }

</style>
<div class="text-center">
    <a class="short_list_img" href="undefined" >
        <img class="img-fluid" src="https://core.sortlist.com//_/apps/core/images/badges-en/badge-flag-blue-light-xl.svg" alt="flag" />
    </a>
 </div> --}}

@include('includes.simulate_project_modal')


@include('includes.contact_modal')


@endsection