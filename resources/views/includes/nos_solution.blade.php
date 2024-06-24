 <!-- Our Solutions Section -->
 <section class="solutions position-relative wavy-bg section-gap">
     <div class="wavy-bg__top position-absolute text-white w-100">
         <svg class="wavy-bg__top__shape w-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
             preserveAspectRatio="none">
             <path fill="currentColor" fill-opacity="1"
                 d="M0,224L48,240C96,256,192,288,288,256C384,224,480,128,576,80C672,32,768,32,864,69.3C960,107,1056,181,1152,176C1248,171,1344,85,1392,42.7L1440,0L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
             </path>
         </svg>
     </div>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <div class="section-header">
                     <h1 class="section-header__title section-header__title--md mb-5">Nos services</h1>
                 </div>
             </div>
         </div>
         <div class="blogs__slider row">
             @foreach ($ourSolution as $item)
             <div class="blogs__slide col-lg-4 col-md-6">
                 <div class="blogs__card d-flex flex-column">
                     <div class="blogs__card__head d-flex position-relative">
                         <a href="{{route('ourSolution.details',$item->id)}}" class="blogs__card__link d-block w-100">
                             <img src="{{ asset('uploads/our_solution')}}/{{$item->image}}" alt="blogs image" class="blogs__card__image w-100" loading="lazy">
                         </a>
                         {{-- <span class="blogs__card__date position-absolute text-white font-weight-bold">{{$item->created_at->format('d/m/y')}}</span> --}}
                     </div>
                     <div class="blogs__card__body h-100">
                         <h3 class="blogs__card__title mb-0">
                             <a href="{{route('ourSolution.details',$item->id)}}" class="d-inline-block">{{$item->title}}</a>
                         </h3>
                     </div>
                 </div>
             </div>
             @endforeach
         </div>
     </div>
     <div class="wavy-bg__bottom position-absolute text-white w-100">
         <svg class="wavy-bg__bottom__shape w-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
             preserveAspectRatio="none">
             <path fill="currentColor" fill-opacity="1"
                 d="M0,224L48,240C96,256,192,288,288,256C384,224,480,128,576,80C672,32,768,32,864,69.3C960,107,1056,181,1152,176C1248,171,1344,85,1392,42.7L1440,0L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
             </path>
         </svg>
     </div>
 </section>



