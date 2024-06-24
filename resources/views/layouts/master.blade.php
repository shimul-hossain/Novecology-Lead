{{-- Header Part  --}}
@include('includes.crm.header')

{{-- Navbar Part  --}}
@include('includes.crm.navbar')

    {{-- Main Content Part  --}}
    @yield('content')

{{-- Footer Part  --}}
@include('includes.crm.footer')