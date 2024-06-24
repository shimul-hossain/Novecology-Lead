@push('plugins-link')
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('plugins-script')
<script src="{{ asset('crm_assets/assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush

@push('js')
<script>
    $('.select2_select_option').each(function(){
        $(this).select2({
            dropdownParent: $(this).parent(),
            templateSelection : function (tag, container){
                var $option = $('.select2_select_option option[value="'+tag.id+'"]');
                if ($option.attr('disabled')){
                    $(container).addClass('removed-remove-btn');
                }
                return tag.text;
            },
        })
    })
</script>
@endpush
