@if ($item)
  <div class="form-group">
      <label class="form-label">Département</label>
      <input type="text" readonly value="{{ $department }}" class="form-control shadow-none px-3">
  </div>
  <div class="form-group">
      <label class="form-label">Travaux</label>
      <select disabled class="select2_select_option shadow-none form-control" multiple> 
          @foreach ($travaux as $travaux)
            <option selected>{{ $travaux->travaux }}</option>  
          @endforeach
      </select> 
  </div>
  <div class="form-group">
      <label class="form-label">TAG</label>
      <select disabled class="select2_select_option shadow-none form-control" multiple> 
          @foreach ($tags as $travaux)
            <option selected>{{ $travaux->tag }}</option>  
          @endforeach
      </select> 
  </div>
@else
    <div class="form-group">
        <label class="form-label">Département</label>
        <input type="text" disabled class="form-control shadow-none px-3">
    </div>
    <div class="form-group">
        <label class="form-label">Travaux</label>
        <select disabled class="select2_select_option shadow-none form-control">

        </select>
    </div> 
    <div class="form-group">
        <label class="form-label">TAG</label>
        <select disabled class="select2_select_option shadow-none form-control">

        </select>
    </div>
@endif