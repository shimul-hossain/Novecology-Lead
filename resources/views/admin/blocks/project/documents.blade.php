@php  
    $documents = \App\Models\CRM\Document::all();
    
@endphp
<div class="accordion" id="leadAccordion10">
    @if ($user_actions->where('module_name', 'collapse_generate_document')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_generate_document')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-22">
        <h2 class="mb-0">
            <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
            <span id="document_generate" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
            {{ __('Generation de document') }}
                {{-- <span class="d-block ml-auto">
                    <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                </span> --}}
                <button data-tab="Section Documents" data-block="Generation de document" data-tab-class="generation_de_document__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-22" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('generation_de_document__part') }} position-relative ml-auto mr-1 {{ session('generation_de_document__part') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>
            </div>
        </h2>
        </div>
        <div id="leadCardCollapse-22" class="collapse {{ session('generation_de_document__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-22">
        <div class="card-body row">
            <div class="col-12 custom-space">
                @if ($user_actions->where('module_name', 'collapse_generate_document')->where('action_name', 'edit')->first() || $role == 's_admin')
                <form action="{{ route('generate.document') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                        <label class="form-label" for="documentGenerator">SELECTIONNER DOCUMENT <span class="text-danger">*</span></label>
                        <select name="document" id="documentGenerator" class="select2_select_option custom-select shadow-none form-control">
                            <option selected value="">{{ __('Select') }}</option>
                            @if ($role == 's_admin')
                                @foreach ($documents as $document)
                                    <option value="{{ $document->id }}">{{ $document->name }}</option>
                                @endforeach
                            @else
                                @foreach ($documents as $document)
                                    @if ($user_actions->where('module_name', 'document-file')->where('action_name', $document->id)->first())
                                        <option value="{{ $document->id }}">{{ $document->name }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="row" id="documentFieldWrap"></div>
                    <div class="text-center">
                        <button type="submit" name="submit_type" value="pdf" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill  align-items-center justify-content-center border-0 mt-5
                            d-inline-flex
                            "> Générer un document
                        </button>
                        <button type="submit" name="submit_type" value="signature" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill  align-items-center justify-content-center border-0 mt-5
                            d-inline-flex
                            "> Signature
                        </button>
                    </div>
                </form>
                @else
                <div class="text-center">
                    <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill  align-items-center justify-content-center border-0 mt-5
                        d-inline-flex
                        ">
                        <span class="novecologie-icon-lock py-1"></span>
                    </button>
                </div>
                @endif
            </div>
        </div>
        </div>
    </div>
    @endif
</div>