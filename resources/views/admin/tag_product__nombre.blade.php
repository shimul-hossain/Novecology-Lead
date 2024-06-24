@if ($products)
    @foreach ($products as $product)
        <div class="form-group">
            <label class="form-label">{{ \App\Models\CRM\Product::find($product)->reference ?? '' }} : <button style="background-color: #B4C7E6" type="button" class="primary-btn primary-btn--sm rounded">Nombre</button></label> 
            <input type="number" name="tag_product_nombre[{{ $tag_id }}__{{ $product }}]" class="form-control shadow-none travaux_disabled tag_product_nombre" 
            @if ($tag_product_nombre && isset($tag_product_nombre[$product]))
                value="{{ $tag_product_nombre[$product] }}"
            @endif 
            data-product-id="{{ $product }}" data-tag-id="{{ $tag_id }}">
        </div>
    @endforeach
@endif