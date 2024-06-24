{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Leaderboard') }}
@endsection

@section('bodyBg')
secondary-bg
@endsection

{{-- active menu --}}
@section('settingsIndex')
active
@endsection

@push('plugins-link')
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/apexchart/css/apexcharts.min.css') }}">
@endpush
@push('css')
	<style>
        .td_img{
            width: 30px;
            height: 30px
        }
        .font-weight-bolder{
            color: #6e6b7b; 
        }
        
        
        .font-small-2{
            font-size: .8rem;
            color: #b9b9c3 ;
        }
        .stats_number{
            padding-right: 10px;
        }
        .stats_number::after{
            content: "%";
        }
    </style>
@endpush
 

{{-- Main Content Part --}}
@section('content')
<section class="dashboard py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap py-3">
                <h1 class="dashboard-title mb-0">{{ __('Leaderboards') }}</h1> 
            </div> 
            <div class="col-12">
                <div class="dashboard-card dashboard-card--auto">
                    <div class="dashboard-card__body p-0">
                        <div class="table-responsive simple-bar">
                            <table class="table table--dashboard no-wrap" id="leaderboardTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('LEADERBOARD') }}</th>
                                        <th>{{ __('TOTAL ASSIGN') }}</th>
                                        <th>{{ __('CONVERTED') }}</th>
                                        <th>{{ __('NOT CONVERTED') }}</th>  
                                        <th id="leaderboardStats">{{ __('STATS') }}</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($users as $user)        
                                            @if ($user->role == 's_admin')
                                                @continue
                                            @endif
                                            <tr> 
                                                <td>
                                                <div class="td_data d-flex align-items-center">
                                                    @if ($user->profile_photo)
                                                            <img src="{{ asset('uploads/crm/profiles') }}/{{ Auth::user()->profile_photo }}" alt="user image" class="navbar-account__user--avator td_img rounded-circle">
                                                    @else
                                                            <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="user image" class="navbar-account__user--avator td_img rounded-circle">
                                                    @endif
                                                        {{-- <div class="td_info">
                                                            <h4></h4>
                                                            <p></p>
                                                        </div> --}}
                                                        <div class="ml-3">
                                                            <div class="font-weight-bolder">{{ $user->name }}</div>
                                                            <div class="font-small-2">{{ $user->email }}</div>
                                                        </div>
                                                </div>
                                                </td>
                                                <td>{{ $user->getLeadAssign->count() }}</td>
                                                <td>{{ \App\Models\CRM\Lead::findMany($user->getLeadAssign->pluck('lead_id'))->where('convert_status', 'yes')->count() }}</td>
                                                <td>{{ \App\Models\CRM\Lead::findMany($user->getLeadAssign->pluck('lead_id'))->where('convert_status', 'no')->count() }}</td> 
                                                <td>@if (\App\Models\CRM\Lead::findMany($user->getLeadAssign->pluck('lead_id'))->where('convert_status', 'yes')->count()>0)
                                                   <span class="stats_number">{{ number_format(\App\Models\CRM\Lead::findMany($user->getLeadAssign->pluck('lead_id'))->where('convert_status', 'yes')->count()*100/$user->getLeadAssign->count(),2) }}</span>  
                                                   @if (number_format(\App\Models\CRM\Lead::findMany($user->getLeadAssign->pluck('lead_id'))->where('convert_status', 'yes')->count()*100/$user->getLeadAssign->count(),2) >= 50)
                                                   <i class="bi bi-graph-up-arrow text-success"></i>
                                                   @else
                                                   <i class="bi bi-graph-down-arrow text-danger"></i>
                                                   @endif
                                                @else
                                                <span class="stats_number">0.00</span>   <i class="bi bi-graph-down-arrow text-danger"></i>
                                                @endif</td>  
                                            </tr> 
                                        @endforeach 
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('plugins-script') 
@endpush

@push('js')
<script>
    $(document).ready(function(){
        var table = $('#leaderboardTable'); 
        var th = $('#leaderboardStats');
        var rows = table.find('tr:gt(0)').toArray().sort(comparer(th.index()))
        th.asc = !th.asc
        if (th.asc){rows = rows.reverse()}
        for (var i = 0; i < rows.length; i++){table.append(rows[i])}


        function comparer(index) {
            return function(a, b) {
                var valA = getCellValue(a, index), valB = getCellValue(b, index)
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
            }
        }
        function getCellValue(row, index){ return $(row).children('td').eq(index).text() }
    });
//   $('th').click(function(){
//         var table = $(this).parents('table').eq(0)
//         var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
//         this.asc = !this.asc
//         if (!this.asc){rows = rows.reverse()}
//         for (var i = 0; i < rows.length; i++){table.append(rows[i])}
//     })
   
</script> 
@endpush
 