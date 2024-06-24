@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Advice Details') }}
@endsection

{{-- Menu Active --}}
@section('ourSolutionIndex')
active
@endsection
@section('css')

@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<div class="content-header-left col-md-12 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ route('superadmin.dashboard') }}">
                <h2 class="content-header-title float-left mb-0">{{ __('Super Admin Dashboard') }}</h2>
            </a>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Solution Details Section') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Our Solution Details Section') }}</h4>

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('update'))
                    <div class="alert alert-warning">{{ session('update') }}</div>
                    @endif
                    @if (session('delete'))
                    <div class="alert alert-danger">{{ session('delete') }}</div>
                    @endif
                    @if (session('deny'))
                    <div class="alert alert-danger">{{ session('deny') }}</div>
                    @endif
                </div>


                <div class="card-body">
                    <p class="card-text">

                    </p>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered">

                            <tbody>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Title') }}</th>
                                    <td>{{$solution->title}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Category') }}</th>
                                    <td>{{$solution->category}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Thumbnail') }}</th>
                                    <td><img width="200" src="{{ asset('uploads/our_solution')}}/{{ $solution->image}}"
                                            alt=""></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Details') }}</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-12">
                                                <div class="list-group" id="list-tab" role="tablist">
                                                    @foreach ($solution_details as $key => $item)
                                                    <a class="list-group-item list-group-item-action 
                                                               @if($key == 0)
                                                                active
                                                                @endif 
                                                                "
                                                        id="list-{{ $item->id }}-list" data-toggle="list" href="#list-{{ $item->id }}"
                                                        role="tab" aria-controls="home">{{ $item->question }}</a>
                                                    @endforeach
                                                   
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-7 col-sm-12">
                                                <div class="tab-content" id="nav-tabContent">
                                                    @foreach ($solution_details as $key => $item)
                                                        
                                                    <div class="tab-pane fade show 
                                                    @if($key == 0)
                                                    active
                                                    @endif " id="list-{{ $item->id }}"
                                                        role="tabpanel" aria-labelledby="list-{{ $item->id }}-list">{!! $item->answer !!}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="font-weight-bold">{{ __('Reasons') }}</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-12">
                                                <div class="list-group" id="list-tab" role="tablist">
                                                    @foreach ($solution_reasons as $key => $item)
                                                    <a class="list-group-item list-group-item-action 
                                                               @if($key == 0)
                                                                active
                                                                @endif 
                                                                "
                                                        id="list-{{ $item->id }}-list" data-toggle="list" href="#list-{{ $item->id }}"
                                                        role="tab" aria-controls="home">{{ $item->title}}</a>
                                                    @endforeach
                                                   
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-7 col-sm-12">
                                                <div class="tab-content" id="nav-tabContent">
                                                    @foreach ($solution_reasons as $key => $item)
                                                        
                                                    <div class="tab-pane fade show 
                                                    @if($key == 0)
                                                    active
                                                    @endif " id="list-{{ $item->id }}"
                                                    
                                                        role="tabpanel" aria-labelledby="list-{{ $item->id }}-list">
                                                        <img src="{{ asset('uploads/our_solutionReasons') }}/{{ $item->image }}" alt="">
                                                        <br>
                                                        <br>
                                                        {!! $item->details !!}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- <tr>
                                    <th class="font-weight-bold">Edit</th>
                                    <td>
                                        <a class="btn btn-sm btn-secondary"
                                            href="{{ route('ourSolutions.edit',$solution->id) }}">
                                            <span>Edit</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">Delete</th>

                                    <td>
                                        <form action="{{route('ourSolutions.destroy',$solution->id)}}" method="POST">
                                            {{ method_field('DELETE') }}
                                            @csrf

                                            <a class="btn btn-sm btn-danger"
                                                href="{{route('ourSolutions.destroy',$solution->id) }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                

                                                <span>Delete</span>
                                            </a>
                                        </form>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection