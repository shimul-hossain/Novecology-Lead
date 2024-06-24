 	<!-- Footer Section -->
    {{-- <footer class="footer mt-auto" id="footerContent">
        <div class="container">
            <div class="row align-items-center justify-content-center position-relative">
                <div class="col-12">
                    <ul class="footer__list list-inline text-center text-lg-left mb-lg-0">
                        <li class="list-inline-item">
                            <a href="#!" class="footer__list__link">{{ __('Legal Notice') }}</a>
                        </li>
                        <li class="list-inline-item">-</li>
                        <li class="list-inline-item">
                            <a href="#!" class="footer__list__link">{{ __('Cookies policy') }}</a>
                        </li>
                    </ul>
                </div>
                <ul class="footer__social-list list-inline text-center mb-0">
                    <li class="list-inline-item">
                        <a href="#!" class="footer__social-list__link d-inline-flex align-items-center justify-content-center rounded-circle">
                            <span class="novecologie-icon-facebook"></span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!" class="footer__social-list__link d-inline-flex align-items-center justify-content-center rounded-circle">
                            <span class="novecologie-icon-linkedIn"></span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!" class="footer__social-list__link d-inline-flex align-items-center justify-content-center rounded-circle">
                            <span class="novecologie-icon-youTube"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer> --}}

    <!-- Toast Alert -->
    <div aria-live="polite" aria-atomic="true" class="toast-wrapper d-flex flex-column align-items-end justify-content-center position-fixed">
        <div class="toast toast--success border-0 py-2 w-100" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-body d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <span class="novecologie-icon-check toast-icon"></span>
                    <span class="toast-text ml-2" id="successMessage">
                        @if(session('success'))
                          {{ session('success') }}
                        @endif
                    </span>
                </div>
                <button type="button" class="close" data-dismiss="toast" aria-label="close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
        </div>
        <div class="toast toast--error border-0 py-2 w-100" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-body d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <span class="novecologie-icon-close toast-icon"></span>
                    <span class="toast-text ml-2" id="errorMessage">
                        @if(session('error'))
                        {{ session('error') }}
                        @endif
                    </span>
                </div>
                <button type="button" class="close" data-dismiss="toast" aria-label="close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
        </div>
    </div>


    <!-- Scroll To Top Button -->
    <div class="scroll-top position-fixed">
        <button class="scroll-top__btn border-0 d-inline-flex align-items-center justify-content-center">
            <span class="novecologie-icon-chevron-up"></span>
        </button>
    </div>
</main>

@stack('all_modals')
@stack('all_forms')


<!-- All Scripts -->
<script src="{{ asset('crm_assets/assets/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/fontawesome/js/all.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/nice-select/js/nice-select.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/flatpickr/js/flatpickr.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/flatpickr/js/flatpicker-fr.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/check-all-rows/js/TableCheckAll.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/select2/js/select2.min.js') }}"></script>
@stack('plugins-script')

{{-- script js  --}}
<script src="{{ asset('crm_assets/assets/js/script.js') }}"></script>

<script>
    $(document).ready(function () {
        var select2_with_color = $(".select2_color_option");
        if(select2_with_color.length){
            function renderCustomResultTemplat(option) {
                if (!option.id) {
                    return option.text;
                }

                let $returnTemplate = `
                <div class="px-3 py-2" style="color: ${$(option.element).data('color')}; background-color: ${$(option.element).data('background')}">
                    ${option.text}
                </div>
                `

                return $returnTemplate;
            }

            function renderCustomSelectionTemplat(option) {
                if (option.id === '') {
                    let $returnTemplate = `<div class="px-3 h-100">${option.text}</div>`
                    return $returnTemplate;
                }

                if (!option.id) {
                    return option.text;
                }

                let $returnTemplate = `
                <div class="px-3 h-100" style="color: ${$(option.element).data('color')}; background-color: ${$(option.element).data('background')}">
                    ${option.text}
                </div>
                `

                return $returnTemplate;
            }

            select2_with_color.each(function(){
                $(this).wrap('<div class="position-relative select2_color_option-parent"></div>').select2({
                    width: '100%',
                    dropdownParent: $(this).parent(),
                    templateResult: renderCustomResultTemplat,
                    templateSelection: renderCustomSelectionTemplat,
                    escapeMarkup: function (es) {
                        return es;
                    }
                });

            });
        }

        $('body').on('input', '.only--positive--value', function(){
            if(0 > +$(this).val()){
                $(this).val('0');
                $(this).closest('.form-group').find('.only--positive--value--alert').text('(Seule valeur positive acceptée)');
            }else{
                $(this).closest('.form-group').find('.only--positive--value--alert').text('');
            }
        });
    });
</script>
<script>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    function formatEuroCurrency(number) {
        if(number){
            // Format the number with two decimal places, a comma as the decimal point, and a space as the thousand separator
            const formattedNumber = parseFloat(number).toLocaleString('en-GB', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            }).replace(/,/g, ' ').replace(/\./, ',');

            // Replace the last space character with a non-breaking space
            const lastSpacePosition = formattedNumber.lastIndexOf(' ');
            console.log(lastSpacePosition);
            const formattedNumberWithNbsp = lastSpacePosition !== -1
                ? formattedNumber.substring(0, lastSpacePosition) + '\u00A0' + formattedNumber.substring(lastSpacePosition + 1)
                : formattedNumber;

            // Add the Euro symbol to the formatted number
            return  formattedNumberWithNbsp +' €';
        }else{
            return '';
        }
    }
    function formatNumberValue(number) {
        if(number){
            // Format the number with two decimal places, a comma as the decimal point, and a space as the thousand separator
            const formattedNumber = parseFloat(number).toLocaleString('en-GB', {
                // minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            }).replace(/,/g, ' ').replace(/\./, ' ');

            // Replace the last space character with a non-breaking space
            const lastSpacePosition = formattedNumber.lastIndexOf(' ');
            const formattedNumberWithNbsp = lastSpacePosition !== -1
                ? formattedNumber.substring(0, lastSpacePosition) + '\u00A0' + formattedNumber.substring(lastSpacePosition + 1)
                : formattedNumber;

            // Add the Euro symbol to the formatted number
            return  formattedNumberWithNbsp;
        }else{
            return '';
        }
    }

    /* Select All Checkbox function */
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Montant Euro Format

        $('body').on('blur', '.montant_format', function(){
            let value = $(this).val();
            let formated_value = formatEuroCurrency(value);
            $(this).prop('type', 'text');
            $(this).val(formated_value);
            $(this).closest('.form-group').find('.montant_value').val(value);
        });
        $('body').on('focus', '.montant_format', function(){
            let value = $(this).closest('.form-group').find('.montant_value').val();
            $(this).prop('type', 'number');
            $(this).val(value);
        });
        $('body').on('blur', '.number__format', function(){
            let value = $(this).val();
            let formated_value = formatNumberValue(value);
            $(this).prop('type', 'text');
            $(this).val(formated_value);
            $(this).closest('.form-group').find('.number__value').val(value);
        });
        $('body').on('focus', '.number__format', function(){
            let value = $(this).closest('.form-group').find('.number__value').val();
            $(this).prop('type', 'number');
            $(this).val(value);
        });

        // Custom Dropdown Select
		$(document).on("click", ".dropdown_custom-select ~ .dropdown-menu .dropdown-item", function(){
			$(this).closest(".dropdown").find(".dropdown_custom-select").val($(this).attr("data-value"));
			$(this).closest(".dropdown").find(".dropdown-toggle").text($(this).text());
			$(this).closest(".dropdown").find(".dropdown-toggle").removeClass("Classique-option Intermediaire-option Precaire-option Grand_Precaire-option");
			$(this).closest(".dropdown").find(".dropdown-toggle").addClass($(this).attr("data-class"));
		});

        document.querySelectorAll('input[type=date]').forEach(e => {
            flatpickr(e, {
                minDate: e.getAttribute('min'),
                maxDate: e.getAttribute('max'),
                defaultDate: e.getAttribute('value'),
                altFormat: 'j F Y',
                dateFormat: 'Y-m-d',
                allowInput: true,
                altInput: true,
                locale: "fr",
                onReady: (selectedDates, dateStr, instance) => {
                    const mainInputDataId = instance.input.dataset.id;
                    const altInput = instance.input.parentElement?.querySelector(".input");
                    altInput.setAttribute("onkeypress", "return false");
                    altInput.setAttribute("onpaste", "return false");
                    altInput.setAttribute("autocomplete", "off");
                    altInput.setAttribute("id", mainInputDataId);
                },
            });
        });
        document.querySelectorAll('input[type=datetime-local]').forEach(e => {
            flatpickr(e, {
                minDate: e.getAttribute('min'),
                maxDate: e.getAttribute('max'),
                defaultDate: e.getAttribute('value'),
                altFormat: 'j F Y H:i',
			    dateFormat: 'Y-m-d H:i',
                allowInput: true,
                altInput: true,
                enableTime: true,
                locale: "fr",
                onReady: (selectedDates, dateStr, instance) => {
                    const mainInputDataId = instance.input.dataset.id;
                    const altInput = instance.input.parentElement?.querySelector(".input");
                    altInput.setAttribute("onkeypress", "return false");
                    altInput.setAttribute("onpaste", "return false");
                    altInput.setAttribute("autocomplete", "off");
                    altInput.setAttribute("id", mainInputDataId);
                },
            });
        });



        $( '.database-table' ).TableCheckAll({
            checkAllCheckboxClass: '.table-all-select-checkbox',
            checkboxClass: '.table-select-checkbox',
        });


        if($('#footerContact').hasClass('footerContact')){

            $('#footerContent').removeClass('mt-auto');

        }

        $('.select2_select_option').select2();
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
        $(function () {
            $('[data-toggle="popover"]').popover()
        })

    });

</script>
@if(session('success'))
<script>
    $(window).on('load', function(){
        setTimeout(() => {
            $('.toast.toast--success').toast('show');
        }, 1000);
    })
</script>
@endif
@if(session('error'))
<script>
    $(window).on('load', function(){
        setTimeout(() => {
            $('.toast.toast--error').toast('show');
        }, 1000);
    })
</script>
@endif

@stack('mapJS')
@stack('js')
@yield('script-js')
</body>
</html>
