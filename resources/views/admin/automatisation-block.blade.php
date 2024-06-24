{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
{{ __('Automatisation') }}
@endsection

{{-- active menu  --}}
@section('automatisationIndex')
active
@endsection

@section('bodyBg', 'secondary-bg')

{{-- Main Content Part  --}}
@section('content')
		<section class="section-gap">
			<div class="container">
               <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="my-2">Mes automatisations</h1>
                <a class="btn btn-success" href="{{ route('automatisation.block.create') }}">+ Créer</a>
               </div>
                <div class="row match-height">
                    @foreach ($items as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="automatisation-card">
                            <div class="automatisation-card__header">
                                <div class="d-flex align-items-center">
                                    <span class="automatisation-btn-icon">
                                        <i class="bi bi-repeat"></i>
                                    </span>
                                    <i class="bi bi-arrow-right mx-2"></i>
                                    <span class="automatisation-btn-icon">
                                        @if ($item->sending_type == 'send_email')
                                        <i class="bi bi-envelope-fill"></i>
                                        @else
                                        <i class="bi bi-phone-fill"></i>
                                        @endif
                                    </span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label class="switch-checkbox mr-2">
                                        <input data-id="{{ $item->id }}" type="checkbox" {{ $item->active == 'yes' ? 'checked':'' }} class="switch-checkbox__input">
                                        <span class="switch-checkbox__label"></span>
                                    </label>
                                    <div class="dropdown dropdown--custom">
                                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--custom bg-white border-0">
                                            <a href="{{ route('automatisation.block.edit', $item->id) }}" class="dropdown-item border-0">
                                                <span class="novecologie-icon-edit mr-1"></span>
                                                Éditer
                                            </a>
                                            <form action="{{ route('automatisation.block.delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="id">
                                                <button type="submit" class="dropdown-item border-0">
                                                    <span class="novecologie-icon-trash mr-1"></span>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="automatisation-card__body">
                                <ul class="automatisation-card__list">
                                    <li class="automatisation-card__list__item">Lorsque le statut {{ $item->type_de_campagne == 'status_not_change' ? 'ne':'' }} change des {{ $item->automatisation_for }} passe à <span class="badge--custom text-uppercase" style="color: #42a5f6">{{ getStatus($item->id) }} </span></li>
                                    <li class="automatisation-card__list__item"><span class="btn btn-primary">Envoyer</span></li>
                                    <li class="automatisation-card__list__item">
                                        <span class="d-block mb-1">
                                            Envoyer un {{ ($item->sending_type == 'send_email') ? 'Email' : 'SMS' }} au <span class="badge--custom" style="color: #42a5f6">{{ $item->select_to }}</span>
                                        </span>
                                        <span>
                                            @if ($item->sending_type == 'send_email')
                                                Email type: <span class="badge--custom text-uppercase" style="color: #42a5f6">{{ $item->getEmailTemplate->name ?? '' }}</span>
                                            @else
                                                SMS type: <span class="badge--custom text-uppercase" style="color: #42a5f6">{{ $item->getsmsTemplate->name ?? '' }}</span>
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            {{-- <div class="automatisation-card__footer">
                                <div class="custom-control custom-switch text-center">
                                    <input type="checkbox" class="custom-control-input" id="automatisationFooterCustomSwitch-{{ $item->id }}">
                                    <label class="custom-control-label" for="automatisationFooterCustomSwitch-{{ $item->id }}"></label>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
			</div>
		</section>
@endsection

@push('js')
<script>
	$(document).ready(function(){

        $('.switch-checkbox__input').on('change', function(){
            let id = $(this).data('id');
            if($(this).is(':checked')){
                var status = 'yes';
            }else{
                var status = 'no';
            }

            // alert(status);


            $.ajax({
                url: "{{ route('automatisation.activate.block') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "status": status
                },
                success: function(response){
                    $('#successMessage').html(response.message);
					$('.toast.toast--success').toast('show');
                }
            });


        });


	});
</script>
@endpush
