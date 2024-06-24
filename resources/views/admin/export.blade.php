 @extends('layouts.master')

 {{-- Title part  --}}
@section('title')
{{ __('Export') }}
@endsection

@push('plugins-link')
@endpush

@push('css')
<style>
    .filter-pan__btn.active{
        border: 1px solid #222222;
    }
    .filter-card-wrapper{
        position: relative;
        transition: padding .3s linear;
    }
    .filter-card-wrapper.active{
        padding-left: 300px;
    }
    .filter-left{
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        transform: translateX(-100%);
        width: 300px;
        z-index: 999;
        transition: transform .3s linear;
    }
    .filter-left.active{
        transform: translateX(0);
    }
</style>
@endpush


@section('bodyBg')
secondary-bg
@endsection

{{-- Main Content Part  --}}
@section('content')
		<!-- Map Section -->
        <section>
            <form action="{{ route('export') }}" method="post">
                @csrf
                <div class="container">
                    <div class="row align-items-center justify-content-end py-3">
                        <div class="col-12">
                            <h1 class="mb-3">Export</h1>
                        </div>
                        <div class="col-lg mb-3 mb-lg-0">
                            <div class="filter-pan bg-white px-3 pt-3 border rounded-lg">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <select id="categoryItemSelect" name="type" class="select2_select_option custom-select shadow-none form-control">
                                                <option value="" disabled>Catégorie</option>
                                                <option value="prospect">Prospect</option>
                                                <option value="client">Client</option>
                                                <option value="chantier">Chantier</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <select id="labelItemSelect" name="label" class="select2_select_option custom-select shadow-none form-control">
                                                <option value="">Etiquette</option>
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <select id="statusItemSelect" name="status" class="select2_select_option custom-select shadow-none form-control">
                                                <option value="">Statut</option>
                                                {{-- @foreach ($sub_statuses as $s_status)
                                                    <option value="{{ $s_status->id }}">{{ $s_status->name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <div class="filter-pan bg-white px-3 pt-3 border rounded-lg">
                                <div class="row align-items-center justify-content-center justify-content-sm-end">
                                    <div class="col-sm-auto">
                                        <div class="form-group">
                                            <button type="submit" name="submit_btn" value="regular" class="secondary-btn border-0">
                                                <i class="bi bi-download"></i> Télécharger
                                            </button> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3" id="exportHeader">
                            @include('admin.lead_export_header')
                        </div>
                        {{-- <div class="col-12 mt-3">
                            <div class="card w-100 mb-3">
                                <div class="card-body text-right">
                                    <button type="submit" class="secondary-btn border-0">
                                        <i class="bi bi-download"></i> Télécharger
                                    </button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </form>
        </section>
@endsection

@push('plugins-script')
@endpush

@push('js')


<script>
    $(document).ready(function () {
        $("#categoryItemSelect").change(function(){
            let value = $(this).val();
            $.ajax({
                url     : "{{ route('export.category.change') }}",
                type    : "post",
                data    : {value},
                success : response => {
					$('#labelItemSelect').html(response.status);
					$('#statusItemSelect').html('<option value="">Statut</option>');
					$('#exportHeader').html(response.header_field);
				}
            });
        });
        $("#labelItemSelect").change(function(){
            let category = $("#categoryItemSelect").val();
            let label = $(this).val();
            if(label){
                $.ajax({
                    url     : "{{ route('export.label.change') }}",
                    type    : "post",
                    data    : {category,label},
                    success : response => { 
                        $('#statusItemSelect').html(response.sub_status);
                    }
                });
            }else{
                $('#statusItemSelect').html('<option value="">Statut</option>');
            }
        });
    });
</script>

@endpush
