@push('style_css')
<style>
.text-collapse__btn {
    background-color: transparent;
    border: 0;
    font-weight: 400;
    color: #000;
    opacity: .5;
}
</style>
@endpush
<!-- Testimonial Section -->
<section class="testimonial section-gap">
    <div class="container">
        <div class="section-header">
            <h1 class="section-header__title">Vous en parlez mieux que nous !</h1>
        </div>
        <div class="testimonial__wrapper bg-white">
            <div class="testimonial__slider row justify-content-center match-height">
                @foreach (opinions() as $item)
                    <div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
                        <div class="testimonial__card">
                            <div class="testimonial__card__head">
                                <ul class="nav testimonial__card__list list-unstyled mb-0">
                                    @for ($x = 1; $x <=5; $x++)
                                        <li style="{{ $x<= $item->rating ? 'color:#fc941d':'' }}">
                                            <i class="fa-solid fa-star"></i>
                                        </li>
                                    @endfor
                                </ul>
                                <span class="testimonial__card__head__text">
                                    <small>publié le {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</small>
                                </span>
                            </div>
                            <div class="testimonial__card__body">
                                <blockquote class="testimonial__card__blockquote">
                                    {{-- <span class="testimonial__card__text">{{ $item->opinion }}</span> --}}
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
                                </blockquote>
                                <cite class="testimonial__card__text mt-auto">
                                    <small>{{ $item->name }}, suite à une expérience du {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</small>
                                </cite>
                            </div>
                        </div>
                    </div> 
                    @endforeach 
                {{-- <div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
                    <div class="testimonial__card">
                        <div class="testimonial__card__head">
                            <ul class="nav testimonial__card__list list-unstyled mb-0">
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                            </ul>
                            <span class="testimonial__card__head__text">
                                <small>publié le 05/08/2023</small>
                            </span>
                        </div>
                        <div class="testimonial__card__body">
                            <blockquote class="testimonial__card__blockquote">
                                <span class="testimonial__card__text">Installation d'une pompe à chaleur au top ! Merci à toute l'équipe qui a été très professionnelle. J...</span>
                            </blockquote>
                            <cite class="testimonial__card__text mt-auto">
                                <small>Sylvie M., suite à une expérience du 04/08/2022</small>
                            </cite>
                        </div>
                    </div>
                </div>
                <div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
                    <div class="testimonial__card">
                        <div class="testimonial__card__head">
                            <ul class="nav testimonial__card__list list-unstyled mb-0">
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                            </ul>
                            <span class="testimonial__card__head__text">
                                <small>publié le 05/08/2023</small>
                            </span>
                        </div>
                        <div class="testimonial__card__body">
                            <blockquote class="testimonial__card__blockquote">
                                <span class="testimonial__card__text">Le travail a bien été effectué très rapide et dans les délais.A recommandé.Merci</span>
                            </blockquote>
                            <cite class="testimonial__card__text mt-auto">
                                <small>Sylvie M.  , suite à une expérience du 04/08/2022</small>
                            </cite>
                        </div>
                    </div>
                </div>
                <div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
                    <div class="testimonial__card">
                        <div class="testimonial__card__head">
                            <ul class="nav testimonial__card__list list-unstyled mb-0">
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                            </ul>
                            <span class="testimonial__card__head__text">
                                <small>publié le 05/08/2023</small>
                            </span>
                        </div>
                        <div class="testimonial__card__body">
                            <blockquote class="testimonial__card__blockquote">
                                <span class="testimonial__card__text">Je recommande pour un travail de qualité, j'en suis très satisfait une équipe agréable et conscienci...</span>
                            </blockquote>
                            <cite class="testimonial__card__text mt-auto">
                                <small>Sylvie M. ,suite à une expérience du 04/08/2022</small>
                            </cite>
                        </div>
                    </div>
                </div>
                <div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
                    <div class="testimonial__card">
                        <div class="testimonial__card__head">
                            <ul class="nav testimonial__card__list list-unstyled mb-0">
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                            </ul>
                            <span class="testimonial__card__head__text">
                                <small>publié le 05/08/2023</small>
                            </span>
                        </div>
                        <div class="testimonial__card__body">
                            <blockquote class="testimonial__card__blockquote">
                                <span class="testimonial__card__text">Très bonne équipe et du très bon travail, des professionnels.....</span>
                            </blockquote>
                            <cite class="testimonial__card__text mt-auto">
                                <small>Sylvie M. , suite à une expérience du 04/08/2022</small>
                            </cite>
                        </div>
                    </div>
                </div>
                <div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
                    <div class="testimonial__card">
                        <div class="testimonial__card__head">
                            <ul class="nav testimonial__card__list list-unstyled mb-0">
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                            </ul>
                            <span class="testimonial__card__head__text">
                                <small>publié le 05/08/2023</small>
                            </span>
                        </div>
                        <div class="testimonial__card__body">
                            <blockquote class="testimonial__card__blockquote">
                                <span class="testimonial__card__text">Installation d'une pompe à chaleur au top ! Merci à toute l'équipe qui a été très professionnelle. J...</span>
                            </blockquote>
                            <cite class="testimonial__card__text mt-auto">
                                <small>Sylvie M., suite à une expérience du 04/08/2022</small>
                            </cite>
                        </div>
                    </div>
                </div>
                <div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
                    <div class="testimonial__card">
                        <div class="testimonial__card__head">
                            <ul class="nav testimonial__card__list list-unstyled mb-0">
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                            </ul>
                            <span class="testimonial__card__head__text">
                                <small>publié le 05/08/2023</small>
                            </span>
                        </div>
                        <div class="testimonial__card__body">
                            <blockquote class="testimonial__card__blockquote">
                                <span class="testimonial__card__text">Le travail a bien été effectué très rapide et dans les délais.A recommandé.Merci</span>
                            </blockquote>
                            <cite class="testimonial__card__text mt-auto">
                                <small>Sylvie M.  , suite à une expérience du 04/08/2022</small>
                            </cite>
                        </div>
                    </div>
                </div>
                <div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
                    <div class="testimonial__card">
                        <div class="testimonial__card__head">
                            <ul class="nav testimonial__card__list list-unstyled mb-0">
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                            </ul>
                            <span class="testimonial__card__head__text">
                                <small>publié le 05/08/2023</small>
                            </span>
                        </div>
                        <div class="testimonial__card__body">
                            <blockquote class="testimonial__card__blockquote">
                                <span class="testimonial__card__text">Je recommande pour un travail de qualité, j'en suis très satisfait une équipe agréable et conscienci...</span>
                            </blockquote>
                            <cite class="testimonial__card__text mt-auto">
                                <small>Sylvie M. ,suite à une expérience du 04/08/2022</small>
                            </cite>
                        </div>
                    </div>
                </div>
                <div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
                    <div class="testimonial__card">
                        <div class="testimonial__card__head">
                            <ul class="nav testimonial__card__list list-unstyled mb-0">
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                                <li class="testimonial__card__list__item">
                                    <i class="fa-solid fa-star"></i>
                                </li>
                            </ul>
                            <span class="testimonial__card__head__text">
                                <small>publié le 05/08/2023</small>
                            </span>
                        </div>
                        <div class="testimonial__card__body">
                            <blockquote class="testimonial__card__blockquote">
                                <span class="testimonial__card__text">Très bonne équipe et du très bon travail, des professionnels.....</span>
                            </blockquote>
                            <cite class="testimonial__card__text mt-auto">
                                <small>Sylvie M. , suite à une expérience du 04/08/2022</small>
                            </cite>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>


@push('script_js')
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