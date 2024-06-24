@extends('layouts.frontend')

@section('society')
active
@endsection

@section('content')

@include('includes.inner_page_menu')

<!-- Sub Banner Section -->
<section class="section-gap mission pt-0">
    @foreach ($ourSociety as $key => $item)
        <div class="py-3">
            <div class="container">
                <div class="row {{ ($loop->iteration % 2 == 0) ? 'flex-lg-row-reverse' : '' }}">
                    @if ($item->image != null)
                    <div class="col-xl-5 col-lg-6 col-md-4">
                        <img src="{{asset('uploads/our_society')}}/{{ $item->image }}" alt="team image" class="img-fluid rounded p-xl-4" loading="lazy">
                    </div>
                    @endif
                    <div class="col-xl-7 col-lg-6 col-md-8 d-flex align-items-center">
                        <div class="{{ ($loop->iteration % 2) ? 'pl-xl-5' : 'pr-xl-5' }} pt-4 pt-md-0">
                            <div class="section-header">
                                <h4 class="text-uppercase">À propos de nous</h4>
                                <h1 class="section-header__title">
                                    <strong class="font-weight-bold">{{ $item->title }}</strong>
                                </h1>
                            </div>
                            <div>{!! $item->details !!}</div>
                        </div>
                    </div>
                </div>
                
                {{-- @if ($ourSociety->last() === $item)
                    <div class="row {{ ($loop->iteration % 2 == 0) ? 'justify-content-start' : 'justify-content-end' }}">
                        <div class="col-lg-7">
                            <div class="d-flex align-items-center">
                                <div style="margin: 0 10px">
                                    <img width="60" id="image-37-1339" src="{{ asset('uploads/OurSocieteLogo') }}/{{ $logo->image1 }}" class="ct-image">
                                </div>
                                <div style="margin: 0 10px">
                                    <img width="100" id="image-41-1339" src="{{ asset('uploads/OurSocieteLogo') }}/{{ $logo->image2 }}" class="ct-image">
                                </div>
                                <div style="margin: 0 10px">
                                    <img width="100" id="image-41-1339" src="{{ asset('uploads/OurSocieteLogo') }}/{{ $logo->image3 }}" class="ct-image">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif --}}
            </div>
        </div>
    @endforeach
</section>
@endsection
