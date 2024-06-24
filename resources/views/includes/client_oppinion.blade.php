<!-- Customers Opinion Section -->
<section class="testimonial section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header mb-0">
                    <p class="mb-0">Ils témoignent</p>
                    <h1 class="section-header__title section-header__title--md mb-0"><b>l'avis de nos clients</b></h1>
                </div>
            </div>
        </div>
        <div class="testimonial__slider row py-5">
            @foreach (opinions()->take(4) as $item)
            <div class="testimonial__slide col-lg-4 col-md-6">
                <div class="testimonial__card text-center">
                    <div class="testimonial__card__head">
                        <svg class="testimonial__card__quote-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                            <path d="M50.6,26.2c-0.1-1.4,0-5.2,3.6-10.4c0.3-0.4,0.2-0.9-0.1-1.3c-1.5-1.5-2.4-2.4-3-3.1c-0.8-0.9-1.2-1.3-1.8-1.8 c-0.4-0.3-0.9-0.3-1.3,0c-6.3,5.5-13.4,16.9-12.3,30.8c0.6,8.2,6.6,14.1,14.2,14.1c7.8,0,14.2-6.4,14.2-14.2 C64,32.8,58.1,26.7,50.6,26.2z M49.8,52.6c-6.5,0-11.7-5.2-12.2-12.3c0,0,0,0,0,0c-1.1-15.7,8.2-25.8,11-28.5c0.3,0.3,0.6,0.6,1,1.1 c0.6,0.6,1.3,1.3,2.5,2.5c-4.4,6.8-3.6,11.6-3.2,12.3c0.2,0.3,0.5,0.6,0.9,0.6c6.7,0,12.2,5.5,12.2,12.2 C62,47.1,56.5,52.6,49.8,52.6z M15.1,26.2c-0.1-1.4,0-5.2,3.6-10.4c0.3-0.4,0.2-0.9-0.1-1.3c-1.5-1.5-2.4-2.4-3-3.1 c-0.8-0.9-1.2-1.3-1.8-1.8c-0.4-0.3-0.9-0.3-1.3,0C6.1,15.2-0.9,26.5,0.1,40.5v0c0.6,8.2,6.6,14.1,14.2,14.1 c7.8,0,14.2-6.4,14.2-14.2C28.5,32.8,22.6,26.7,15.1,26.2z M14.3,52.6c-6.5,0-11.7-5.2-12.2-12.3v0c-1.1-15.7,8.2-25.9,11-28.5 c0.3,0.3,0.6,0.6,1.1,1.1c0.6,0.6,1.3,1.3,2.5,2.5C12.2,22.1,13,27,13.4,27.7c0.2,0.3,0.5,0.6,0.9,0.6c6.7,0,12.2,5.5,12.2,12.2 C26.5,47.1,21,52.6,14.3,52.6z"></path>
                        </svg>
                    </div>
                    @if ($item->opinion && strlen($item->opinion) > 100)
                        <div class="text-collapse__card">
                            <div class="testimonial__card__text my-3">
                                <div class="text-collapse__visible-text">{{ substr($item->opinion, 0, 100) }}</div>
                                <div class="text-collapse__hidden-text" data-collapse-text="hide">{{ substr($item->opinion, 100) }}</div>
                            </div>
                            <button type="button" class="text-collapse__btn">Lire la suite</button>
                        </div>
                    @else
                        <p class="testimonial__card__text my-3">{{ $item->opinion }}</p>
                    @endif
                    <div class="testimonial__card__author">
                        <div class="testimonial__card__author__avatar d-inline-block position-relative rounded-circle overflow-hidden mx-auto my-2">
                            <img @if ($item->image == '') src="{{ $item->image }}" @else data-lazy="{{ $item->image }}" @endif alt="author" width="60" height="60" loading="lazy" class="testimonial__card__author__avatar__image w-100 h-100">
                        </div>
                        <p class="testimonial__card__author__name mb-1">{{ $item->name }}</p>
                        <ul class="testimonial__card__author__list">
                            <li class="testimonial__card__author__list__item">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </li>
                            <li class="testimonial__card__author__list__item">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </li>
                            <li class="testimonial__card__author__list__item">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </li>
                            <li class="testimonial__card__author__list__item">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </li>
                            <li class="testimonial__card__author__list__item">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center mt-3">
                        <img src="{{ asset('frontend_assets/images/testimonial/google-reviews-logo.png') }}" alt="google logo" height="50" loading="lazy" class="testimonial__card__image mx-auto">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('custom-script')
    <script>
        $(document).ready(function () {
            $(".text-collapse__hidden-text").hide();

            $(document).on("click", ".text-collapse__btn", function(){
                let hiddenBlock = $(this).closest(".text-collapse__card").find(".text-collapse__hidden-text");

                if(hiddenBlock.attr("data-collapse-text") == "hide"){
                    hiddenBlock.slideDown();
                    hiddenBlock.attr("data-collapse-text", "show");
                    $(this).text("Cacher")
                }else{
                    hiddenBlock.slideUp();
                    hiddenBlock.attr("data-collapse-text", "hide");
                    $(this).text("Lire la suite")
                }
            });
        });
    </script>
@endpush
