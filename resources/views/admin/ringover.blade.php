{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Ringover') }}
@endsection

{{-- Backgroud color  --}}
@section('bodyBg')
secondary-bg    
@endsection

{{-- active menu  --}}
@section('ringover')
active
@endsection


{{-- Main Content Part  --}}
@section('content')

<div id="ringover-container"></div>
 
@endsection

@push('js')
<script  src="https://webcdn.ringover.com/resources/SDK/1.0.5/ringover-sdk.js" type="text/javascript"></script>
<script>
    // Set options
    const options = {
        type: "absolute",
        animation: false,
        size: "auto",
        padding: "0px",
        border: false,
        trayicon: false,
        container: "ringover-container",
        position: {
            top: 	"0px",
            bottom: "0px",
            left: 	"0px",
            right: 	"0px",
        },
        trayposition: {
            top: 	"0px",
            bottom: "0px",
            left: 	"0px",
            right: 	"0px",
        },
    };

    // Create instance
    const simpleSDK = new window.RingoverSDK(options);

    // Generate iframe
    simpleSDK.generate();
</script>
@endpush