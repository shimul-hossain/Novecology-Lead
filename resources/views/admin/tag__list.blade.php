@foreach ($barame_travaux_tags as $tag) 
    @if ($tagList && in_array($tag->id, $tagList))
        <option  value="disabled" disabled="disabled" selected>{{ $tag->tag }}</option>
    @endif  
@endforeach
 

