@foreach ($company as $item)

<a href="{{ route('leads.company', $item->id) }}" class="primary-btn primary-btn--primary primary-btn--lg fix-btn-width rounded-pill  align-items-center justify-content-center companyBtn">
    {{ $item->company_name }}
    <span class="novecologie-icon-arrow-right ml-3"></span>
</a>    

@endforeach   

{{-- <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#startNewLeadModal">
    Launch demo modal
  </button> --}}
 