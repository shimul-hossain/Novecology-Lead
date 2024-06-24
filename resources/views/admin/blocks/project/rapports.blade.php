<div class="accordion" id="leadAccordionrapports">
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-14">
            <h2 class="mb-0">
                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
                    Rapports client
                    <button data-tab="Rapports" data-block="Rapports client" data-tab-class="rapports__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-rapports" aria-expanded="false" class="d-flex ml-auto border-0 edit-toggler edit-toggler--lock__access {{ session('rapports__part') }} position-relative ml-1 {{ session('rapports__part') == 'active' ? 'collapsed':'' }}">
                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                    </button>
                </div>
            </h2>
        </div>
        <div id="leadCardCollapse-rapports" class="collapse {{ session('rapports__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-14">
            <div class="card-body px-0 pb-0">
                @foreach ($project->getFile as $file)
                <div class="card lead__card border-bottom" style="border-color: black !important;">
                    <div class="card-header bg-transparent border-0 p-0" id="leadCard-14">
                        <h2 class="mb-0">
                            <div class="btn text-left lead__card__toggler shadow-none w-100 collapseBtn">
                                <div class="row">
                                    <div class="col-12 flex-grow-1 d-flex align-items-xl-center">
                                        <div class="lead__card__toggler__content w-100">
                                            <h3 class="lead__card__toggler__content__heading">{{ $file->file_name ?? $file->name }}</h3>
                                        </div>
                                        <div class="d-flex">
                                            <a href="{{ asset('uploads/files') }}/{{ $file->name }}" target="_blank" class=" btn p-2 shadow-none">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ asset('uploads/files') }}/{{ $file->name }}" download="{{ $file->file_name ?? $file->name }}" class=" btn p-2 shadow-none">
                                                <i class="bi bi-download"></i>
                                            </a>
                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle p-2" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-right dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                    <button  type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#RapportFileEdit{{ $file->id }}">
                                                        Editer
                                                    </button>
                                                    <button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#RapportFileDelete{{ $file->id }}">
                                                        Supprimer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <p class="lead__card__toggler__content__row__text">
                                            <strong class="lead__card__toggler__content__row__title">Importé par : {{ $file->uploadedBy->name ?? '' }}</strong>
                                            <span class="text-dark"></span>
                                        </p>
                                    </div>
                                    <div class="col-xl-4">
                                        <p class="lead__card__toggler__content__row__text">
                                            <strong class="lead__card__toggler__content__row__title">Le :</strong>
                                            <span class="text-dark">{{ \Carbon\Carbon::parse($file->created_by)->format('d-m-Y') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </h2>
                    </div>
                </div>
                @push('all_modals')
                    <div class="modal modal--aside fade" id="RapportFileDelete{{ $file->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0">
                                <div class="modal-header border-0 pb-0">
                                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                        <span class="novecologie-icon-close"></span>
                                    </button>
                                </div>
                                <div class="modal-body text-center pt-0">
                                    <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                                    <span>{{ __('Are You Sure To Delete this') }} ??</span>
                                    <form action="{{ route('project.rapport.file.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $file->id }}">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                                Annuler
                                            </button>
                                            <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                                                Supprimer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal modal--aside fade" id="RapportFileEdit{{ $file->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0">
                                <div class="modal-header border-0 pb-0">
                                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                        <span class="novecologie-icon-close"></span>
                                    </button>
                                </div>
                                <div class="modal-body text-center pt-0">
                                    <h1 class="form__title position-relative mb-4">Mettre à jour le nom du fichier </h1>
                                    <form action="{{ route('project.rapport.file.name.edit') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $file->id }}">
                                        <div class="form-group text-left">
                                            <label for="#">Nom de fichier</label>
                                            <input type="text" name="name" value="{{ $file->file_name ?? $file->name }}" class="form-control shadow-none">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                                                {{ __('Submit') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endpush
                @endforeach
                <div class="text-right">
                    @if ($user_actions->where('module_name', 'collapse_rapports')->where('action_name', 'create')->first() || $role == 's_admin')
                        <form action="{{ route('project.rapport.file.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <input type="file" hidden name="file" id="rapportFileUpload" onchange="this.closest('form').submit()">
                        </form>
                        <label type="button" for="rapportFileUpload" style="font-size: 35px; line-height: 0;" class="btn p-1 mt-3 shadow-none">
                            <svg width="1em" height="1em" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 -0.0010376C7.85049 -0.0010376 0 7.84945 0 17.499C0 27.1485 7.85049 34.999 17.5 34.999C27.1495 34.999 35 27.1485 35 17.499C35 7.84938 27.1495 -0.0010376 17.5 -0.0010376ZM17.5 32.8115C9.0567 32.8115 2.18751 25.9423 2.18751 17.499C2.18751 9.05566 9.0567 2.18647 17.5 2.18647C25.9433 2.18647 32.8125 9.05559 32.8125 17.499C32.8125 25.9423 25.9433 32.8115 17.5 32.8115ZM27.2071 17.499C27.2071 18.1031 26.7173 18.5927 26.1133 18.5927H18.5938V26.1123C18.5938 26.7164 18.104 27.206 17.5 27.206C16.896 27.206 16.4062 26.7164 16.4062 26.1123V18.5927H8.88668C8.28266 18.5927 7.79293 18.1031 7.79293 17.499C7.79293 16.8949 8.28266 16.4052 8.88668 16.4052H16.4062V8.88565C16.4062 8.28155 16.896 7.79189 17.5 7.79189C18.104 7.79189 18.5938 8.28155 18.5938 8.88565V16.4052H26.1133C26.7173 16.4052 27.2071 16.8949 27.2071 17.499Z" fill="currentColor"/>
                            </svg>
                        </label>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>