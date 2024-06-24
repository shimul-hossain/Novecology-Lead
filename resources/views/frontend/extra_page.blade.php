@extends('layouts.frontend')

@section('content')

@include('includes.inner_page_menu')


<section class="sub-banner">
    <article class="container">
        <article class="row">
            <div class="col-12">
                <h1 class="sub-banner__title text-center mb-4">{{ $page->title }}</h1>
                {{-- <h2 class="sub-banner__sub-title text-center mb-5">{{ $page->subtitle }}</h2> --}}
                {{-- <img src="{{ asset('uploads/extra_page') }}/{{ $page->thumbnail }}" alt="banner image" class="w-100"> --}}
                {{-- <blockquote class="blockquote text-center position-relative py-4">
                    <span class="blockquote__icon blockquote__icon--left position-absolute"><i class="fas fa-quote-left"></i></span>
                    <span class="blockquote__icon blockquote__icon--right position-absolute"><i class="fas fa-quote-right"></i></span>
                    <p class="blockquote__title text-white mb-0">{{ $page->short_description}}</p>
                </blockquote> --}}
                <p>
                    {!! $page->long_description !!}
                </p>
                {{-- <div class="row my-4">
                    <div class="col-lg-6">
                        <img src="{{ asset('uploads/extra_page')}}/{{ $page->image }}" alt="" class="w-100">
                    </div>
                    <div class="col-lg-6">
                       {!! $page->list !!}
                    </div>
                </div> --}}
            </div>
        </article>
    </div>
</section>




@include('includes.footer_contact')

@include('includes.simulate_project_modal')

@include('includes.contact_modal')

@endsection

@section('js')

<script>
    window.onscroll = function () {
        headerStickyfunction()
    };

    let stickyHeader = document.querySelector(".header--sticky");
    let headerElementOffsetTop = stickyHeader.offsetTop;

    function headerStickyfunction() {
        if (window.pageYOffset > headerElementOffsetTop) {
            stickyHeader.classList.add("sticky");
        } else {
            stickyHeader.classList.remove("sticky");
        }
    }
</script>

@endsection