
@php

$numero_de_dossiers = $project->getSubventions->pluck('numero_de_dossier')->toArray();


$emails = [$project->Email, $project->Compte_email, $project->Compte_Email_de_récupération_email, $project->Email_de_transfert_Email, $project->Compte_MaPrimeRenov_email];
$all_emails = \App\Models\StoreEmail::where(function($query) use ($numero_de_dossiers) {
                foreach ($numero_de_dossiers as $key => $value) {
                    if($key == 0){
                        $query->where('subject', 'LIKE', '%'.$value.'%')->orWhere('body', 'LIKE', '%'.$value.'%'); 
                    }else{
                        $query->orWhere('subject', 'LIKE', '%'.$value.'%')->orWhere('body', 'LIKE', '%'.$value.'%'); 
                    }
                }
            })->orWhereIn('from', $emails)->get();
@endphp
<div class="accordion" id="leadAccordionEmail">
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-email">
            <h2 class="mb-0">
                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
                    <span id="subvention_information-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
                    <span class="mr-auto">Email</span>
                    <button data-tab="Email" data-block="Email" data-tab-class="email__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-email" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('email__part') }} position-relative ml-1 {{ session('email__part') == 'active' ? 'collapsed':'' }}">
                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                    </button>
                </div>
            </h2>
        </div>
        <div id="leadCardCollapse-email" class="collapse {{ session('email__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-14">
            <div class="card-body px-0 pb-0">
                <div class="accordion" id="subventionInnerAccordionParent">
                    @foreach ($all_emails as $email)
                        <div class="card lead__card border-bottom" style="border-color: black !important;">
                            <div class="card-header bg-transparent border-0 p-0" id="leadCard-14">
                                <h2 class="mb-0">
                                    <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-xl-center w-100 collapseBtn">
                                        <div class="lead__card__toggler__content w-100">
                                            <div class="lead__card__toggler__content__row">
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <p class="lead__card__toggler__content__row__text">
                                                            <strong class="lead__card__toggler__content__row__title">Email :</strong>
                                                            <span class="text-dark">{{ $email->email_id }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-xl-3">
                                                        <p class="lead__card__toggler__content__row__text">
                                                            <strong class="lead__card__toggler__content__row__title">Date : </strong>
                                                            <span class="text-dark">@if (strtotime($email->date))
                                                                {{ \Carbon\Carbon::parse($email->date)->format('d-m-Y') }}
                                                            @endif</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-xl-5">
                                                        <p class="lead__card__toggler__content__row__text">
                                                            <strong class="lead__card__toggler__content__row__title">Email :</strong>
                                                            <span class="text-dark">{{ $email->from }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" data-toggle="false" aria-expanded="false" class="btn {{ $email->important == 1 ? 'text-warning':'' }} d-flex border-0 shadow-none email_important_btn" data-id="{{ $email->id }}">
                                            <i class="bi bi-star-fill"></i>
                                        </button>
                                        <button data-tab="Email" data-block="Email" data-tab-class="email__part{{ $loop->iteration }}" type="button" data-toggle="collapse" data-target="#EmailCardCollapse-{{ $email->id }}" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('email__part'.($loop->iteration)) }} position-relative ml-1 {{ session('email__part'.($loop->iteration)) == 'active' ? 'collapsed':'' }}">
                                            <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                            <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                        </button>
                                    </div>
                                </h2>
                            </div>
                            <div id="EmailCardCollapse-{{ $email->id }}" class="collapse {{ session('email__part'.($loop->iteration)) == 'active' ? 'show':'' }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <iframe src="{{ route('email.body', $email->id) }}" class="w-100" loading="lazy" height="500" frameborder="0"></iframe>
                                        {{-- {!! $email->body !!} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>