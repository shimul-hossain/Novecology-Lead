<label class="form-label">{{ $type }}</label>
<select name="project_id" class="select2_select_option form-control w-100" id="clientSelect">
    <option value="" selected>{{ __('Select') }}</option>
    @if ($type == 'Prospect')
        @foreach ($items as $item)
            <option value="{{ $item->id }}">{{ $item->Prenom.' '.$item->Nom }} - {{ $item->LeadTravaxTags()->count() > 0 ? implode(', ', $item->LeadTravaxTags->pluck('tag')->toArray()) : '' }} - {{ $item->Code_Postal }}</option>
        @endforeach
    @elseif ($type == 'Chantier')
        @foreach ($items as $item)
            <option value="{{ $item->id }}">{{ $item->Prenom.' '.$item->Nom }} - {{ $item->ProjectTravauxTags()->count() > 0 ? implode(', ', $item->ProjectTravauxTags->pluck('tag')->toArray()) : '' }} - {{ $item->Code_Postal }}</option>
        @endforeach
    @endif
</select>