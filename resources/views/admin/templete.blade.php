{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Calendar') }}
@endsection

{{-- Backgroud color  --}}
@section('bodyBg')
secondary-bg    
@endsection

{{-- active menu  --}}
@section('savIndex')
active
@endsection


{{-- Main Content Part  --}}
@section('content')

@endsection






@push('js')
 
@endpush