@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Translation') }}  
@endsection

{{-- Menu Active --}}
@section('translation')
active
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
                    <li class="breadcrumb-item">{{ __('Translation') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Translate') }}</h4>
                    <input style="max-width: 25% !important;"type="search" id="search" class="form-control" placeholder="{{ __('Search') }}...">

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
                   <div class="table table-responsive"> 
                        <table class="table table-bordered" id="dataTables">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th width="50%" >{{ __('Key') }}</th>
                                    <th width="50%">{{ __('Value') }}</th>
                                    <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($json as $key => $item)
                                    <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $key }}</td>
                                    <td>
                                        <form action="{{ route('modifyFr') }}" method="POST">
                                            @csrf
                                        <input type="hidden" name="key" value="{{ $key }}">

                                            <input class="form-control" id="localValue{{ $loop->index }}" type="text" name="value" value="{{ $item }}">
                                    </td>
                                    <td>
                                            <button type="submit" data-key="{{ $key }}" data-index="{{ $loop->index }}" class="btn btn-primary modifyButton">{{ __('Modifier') }}</button>
                                        </form>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table> 
                   </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('body').on('click', '.modifyButton', function(e){
                e.preventDefault(); 
                var key = $(this).attr('data-key');
                var index = $(this).attr('data-index');
                var value = $('#localValue'+index).val();
                console.log(value);
                $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                $.ajax({
                    type: "POST", 
                    url:"{{ route('modifyFr') }}",
                    data: {
                        key		:key,
                        value	:value,
                    },
                    success: function(data){ 
                        $('#successMessage').text(data);
                        $('.toast.toast--success').toast('show');
                    },
                    
                });  
            })
            $("#search").on("input", function() {
                var value = $(this).val().toLowerCase();
                $("#dataTables tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        }); 
    </script>
@endsection
@section('css')
   <style>
        /* Common Toast Style */
    .toast {
    top: 0;
    right: 0;
    position: absolute;
    -webkit-transform: translateX(130%);
        -moz-transform: translateX(130%);
        -ms-transform: translateX(130%);
        -o-transform: translateX(130%);
            transform: translateX(130%);
    -webkit-transition: opacity .3s linear, -webkit-transform .3s ease-in-out;
    transition: opacity .3s linear, -webkit-transform .3s ease-in-out;
    -o-transition: opacity .3s linear, -o-transform .3s ease-in-out;
    -moz-transition: transform .3s ease-in-out, opacity .3s linear, -moz-transform .3s ease-in-out;
    transition: transform .3s ease-in-out, opacity .3s linear;
    transition: transform .3s ease-in-out, opacity .3s linear, -webkit-transform .3s ease-in-out, -moz-transform .3s ease-in-out, -o-transform .3s ease-in-out;
    -webkit-box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
    border-radius: .428rem;
    pointer-events: initial;
    max-width: 18.75rem;
    width: 100%;
    }

    .toast-wrapper {
    right: 1rem;
    top: 1rem;
    z-index: 9999;
    width: 100%;
    max-width: 25rem;
    pointer-events: none;
    }

    .toast-icon {
    font-size: 1.5625rem;
    }

    .toast-text {
    font-size: 1.0625rem;
    font-family: "SF Pro Display Medium", sans-serif;
    }

    .toast--success .toast-text, .toast--success .toast-icon {
    color: #288200;
    }

    .toast--error .toast-text, .toast--error .toast-icon {
    color: #ea5455;
    }

    .toast .close {
    font-size: 0.75rem;
    }

    .toast.show {
    /* position: relative; */
    -webkit-transform: translateX(0);
        -moz-transform: translateX(0);
        -ms-transform: translateX(0);
        -o-transform: translateX(0);
            transform: translateX(0);
    }

    .dark-layout .toast {
        background-color: rgba(40, 48, 70, 1);
        box-shadow: 0 4px 24px 0 rgb(65 65 65 / 24%);
    }
   </style>
@endsection