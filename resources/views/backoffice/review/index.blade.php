@extends('backoffice.app')

@section('reviewForm', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Review
@endsection

 

@section('css') 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
<div class="content-header-left col-md-12 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ route('backoffice.dashboard') }}">
                <h2 class="content-header-title float-left mb-0">{{ __('Super Admin Dashboard') }}</h2>
            </a>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Review</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection


@section('content')
    <section id="basic-vertical-layouts">
        <div class="row justify-content-center"> 
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        <div class="alert-body">
                            {{ session('success') }}
                        </div>
                    </div> 
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des reviews</h4> 
                    </div>

                    <div class="card-body"> 
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="data_table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Texte</th>
                                        <th>Revu par</th>
                                        <th>Revoir à</th> 
                                        <th>Rating</th> 
                                        <th>Masquer/Afficher</th>
                                        
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td> 
                                                {{ $loop->iteration }} 
                                            </td>
                                            <td> 
                                                {{ $review->opinion }}
                                            </td>
                                            <td> 
                                                {{ $review->name }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}
                                            </td>  
                                            <td> 
                                                {{ $review->rating }}
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch text-center">
                                                    <input type="checkbox" class="custom-control-input reviewStatusChange" {{ $review->status == 'show' ? 'checked':'' }} data-id="{{ $review->id }}" id="reviewItem{{ $review->id }}">
                                                    <label class="custom-control-label" for="reviewItem{{ $review->id }}"></label>
                                                </div>
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
        $('.reviewStatusChange').change(function(){
            let status;
            let review_id = $(this).data('id');
            if($(this).is(':checked')){
                status = 'show';
            }else{
                status = 'hide';
            }
            
            $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type : "POST",
				url  : "{{ route('review.status.change') }}",
				data : {status, review_id},
				success : response => {
					console.log(response);
				}
			})
        })
    });
</script>
@endsection