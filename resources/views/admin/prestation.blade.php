<div class="form-group">
    <label class="form-label" for="titre">{{ __('Titre :') }} <span class="text-danger">**</span></label>
    <input type="text" id="titre" value="{{ $prestation->title }}" name="title" class="form-control shadow-none">
    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
</div>
<hr class="w-100 m-1">
<div class="form-group">
    <label class="form-label" for="des">{{ __('Description :') }} <span class="text-danger">**</span></label>
    <textarea id="des" id="description" name="description" class="text-area shadow-none form-control">{{ $prestation->designation }}</textarea>
    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
</div>
<hr class="w-100 m-1">
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="#" class="form-label">Ordre :</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary shadow-none position_decrease" data-id="0" type="button" id="button-addon1">-</button>
            </div>
            <input type="number"  class="form-control shadow-none" id="position0" name="order" value="1" min="0" aria-label="Example text with button addon" aria-describedby="button-addon1">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary shadow-none position_increase" data-id="0" type="button" id="button-addon2">+</button>
              </div>
          </div>
    </div>
</div>
<hr class="w-100 m-1">
<div class="row align-items-center">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-label" for="pu_ttc0">{{ __('P.U TTC :') }} <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="number" name="pu_ttc" id="pu_ttc0" data-id="0" value="{{ $prestation->price }}" class="form-control shadow-none product_total_count" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                  <span class="input-group-text">€</span>
                </div>
              </div>
            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-label" for="travaux">{{ __('Taux appliqué :') }} <span class="text-danger">*</span></label>
            <select class="select2_select_option form-control w-100" name="tax" required>
                <option {{ $prestation->tax == '0' ? 'selected':'' }} value="0">Non spécifiée</option>
                <option {{ $prestation->tax == '5.5' ? 'selected':'' }} value="5.5">Taux réduit à 5,5 %</option>
                <option {{ $prestation->tax == '20' ? 'selected':'' }} value="20">Taux normal à 20 %</option>
            </select>
            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
        </div>
    </div>
    <hr class="w-100 m-1">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-label" for="quantity0">{{ __('Quantité :') }} <span class="text-danger">*</span></label>
            <input type="number" name="quantity"  id="quantity0" data-id="0" value="1" class="form-control shadow-none product_total_count" required>
            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-label" for="travaux">{{ __('Unité :') }} <span class="text-danger">*</span></label>
            <select name="unit" class="select2_select_option form-control w-100" required>
                <option {{ $prestation->unit == 'm²' ? 'selected':'' }} value="m²">m²</option>
                <option {{ $prestation->unit == 'm³' ? 'selected':'' }} value="m³">m³</option>
                <option {{ $prestation->unit == 'ml' ? 'selected':'' }} value="ml">ml</option>
                <option {{ $prestation->unit == 'litre' ? 'selected':'' }} value="litre">litre</option>
                <option {{ $prestation->unit == 'heure' ? 'selected':'' }} value="heure">heure</option>
                <option {{ $prestation->unit == 'jour' ? 'selected':'' }} value="jour">jour</option>
            </select>
            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
        </div>
    </div>
    <hr class="w-100 m-1">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="form-label" for="total_ttc0">{{ __('Total T.T.C :') }}</label>
            <div class="input-group">
                <input type="number" name="total_ttc" id="total_ttc0" value="{{ $prestation->price }}" class="form-control shadow-none" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                  <span class="input-group-text">€</span>
                </div>
              </div>
            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="switches d-flex align-items-center">
            <label for="priceDesabled" class="form-label m-0 mr-5">Afficher les prix :</label>
            <div class="custom-control custom-switch">
                <input type="checkbox" name="view_price" class="custom-control-input" id="priceDesabled">
                <label class="custom-control-label" for="priceDesabled"></label>
              </div>
        </div>
    </div>
</div>