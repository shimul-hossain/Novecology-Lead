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
<script src="{{ asset('crm_assets/assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
@stack('plugins-script')
<script src="{{ asset('crm_assets/assets/js/script.js') }}"></script>
@stack('js')
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
</body>
</html>
