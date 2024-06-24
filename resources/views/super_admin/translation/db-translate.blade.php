@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Translation') }}
@endsection

{{-- Menu Active --}}
@section('dbTranslation')
active
@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
<div class="content-header-left col-md-12 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ route('superadmin.dashboard') }}">
                <h2 class="content-header-title float-left mb-0">{{ __('Super Admin Dashboard') }}</h2>
            </a>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Translation') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Translate') }}</h4>

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('update'))
                    <div class="alert alert-warning">{{ session('update') }}</div>
                    @endif
                    @if (session('delete'))
                    <div class="alert alert-danger">{{ session('delete') }}</div>
                    @endif
                    @if (session('deny'))
                    <div class="alert alert-danger">{{ session('deny') }}</div>
                    @endif
                </div>
                <div class="card-body">
                    
                </div>
            </div>
            <div class="accordion" id="accordionExample">

                {{-- Company Title  --}}
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0 w-100">
                      <button class="btn btn-link btn-block text-left w-100" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        {{ __('Company Title Translation') }}
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="table table-responsive"> 
                            <table class="table table-bordered">
                                 <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>{{ __('English') }} </th>
                                        <th>{{ __('French') }} </th>
                                        <th>{{ __('Action') }}</th>
                                      </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($companies as $company)
                                     <tr>
                                        <form action="{{ route('modifyDatabase') }}" method="POST">
                                            @csrf
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>
                                                {{ app()->setLocale('en') }}
                                                <input class="form-control" type="text" name="company_title_en" value="{{ $company->company_title }}">
                                            </td>
                                            <td>
                                           
                                                    {{ app()->setLocale('fr') }}
                                                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                                                    <input type="hidden" name="table" value="company">  
                                                 <input class="form-control" type="text" name="company_title" value="{{ $company->company_title }}">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
                                            </td>
                                        </form>

                                     </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                </div>


                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h2 class="mb-0 w-100">
                      <button class="btn btn-link w-100 btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        {{ __('Event Category Name Translation') }}
                      </button>
                    </h2>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="table table-responsive"> 
                            <table class="table table-bordered">
                                 <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>{{ __('English') }} </th>
                                        <th>{{ __('French') }} </th>
                                        <th>{{ __('Action') }}</th>
                                      </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($eventCategories as $category)
                                     <tr>
                                        <form action="{{ route('modifyDatabase') }}" method="POST">
                                            @csrf
                                            <td>
                                                {{ $loop->iteration }}
                                            </td> 
                                            <td>
                                                {{ app()->setLocale('en') }}
                                                <input class="form-control" type="text" name="category_name_en" value="{{ $category->name }}">
                                            </td>
                                            <td> 
                                                    {{ app()->setLocale('fr') }}
                                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                                    <input type="hidden" name="table" value="event_category">
                                                 <input class="form-control" type="text" name="category_name" value="{{ $category->name }}">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
                                            </td>
                                        </form>

                                     </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div> 
                    </div>
                  </div>
                </div>  


                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h2 class="mb-0 w-100">
                      <button class="btn w-100 btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        {{ __('Event Title Translation') }}
                      </button>
                    </h2>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="table table-responsive"> 
                            <table class="table table-bordered">
                                 <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>{{ __('English') }} </th>
                                        <th>{{ __('French') }} </th>
                                        <th>{{ __('Action') }}</th>
                                      </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($events as $event)
                                     <tr>
                                        <form action="{{ route('modifyDatabase') }}" method="POST">
                                            @csrf
                                            <td>
                                                {{ $loop->iteration }}
                                            </td> 
                                            <td>
                                                {{ app()->setLocale('en') }}
                                                <input class="form-control" type="text" name="event_title_en" value="{{ $event->title }}">
                                            </td>
                                            <td> 
                                                {{ app()->setLocale('fr') }}
                                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                                <input type="hidden" name="table" value="event_title">
                                                 <input class="form-control" type="text" name="event_title" value="{{ $event->title }}">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
                                            </td>
                                        </form>

                                     </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div> 
                       
                    </div>
                  </div>
                </div>


                <div class="card">
                  <div class="card-header" id="heading4">
                    <h2 class="mb-0 w-100">
                      <button class="btn w-100 btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                        {{ __('Event Description Translation') }}
                      </button>
                    </h2>
                  </div>
                  <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="table table-responsive"> 
                            <table class="table table-bordered">
                                 <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>{{ __('English') }} </th>
                                        <th>{{ __('French') }} </th>
                                        <th>{{ __('Action') }}</th>
                                      </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($events as $event)
                                     <tr>
                                        <form action="{{ route('modifyDatabase') }}" method="POST">
                                            @csrf
                                            <td>
                                                {{ $loop->iteration }}
                                            </td> 
                                            <td>
                                                {{ app()->setLocale('en') }}
                                                <textarea name="event_description_en" class="form-control">{{ $event->description }}</textarea>
                                                {{-- <input class="form-control" type="text" name="event_description_en" value="{{ $event->description }}"> --}}
                                            </td>
                                            <td> 
                                                {{ app()->setLocale('fr') }}
                                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                                <input type="hidden" name="table" value="event_description">
                                                <textarea name="event_description" class="form-control">{{ $event->description }}</textarea>
                                                 {{-- <input class="form-control" type="text" name="event_description" value="{{ $event->description }}"> --}}
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
                                            </td>
                                        </form>

                                     </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div> 
                       
                    </div>
                  </div>
                </div>
                
                
                <div class="card">
                  <div class="card-header" id="heading5">
                    <h2 class="mb-0 w-100">
                      <button class="btn w-100 btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                        {{ __('Navigation Menu Name Translation') }}
                      </button>
                    </h2>
                  </div>
                  <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="table table-responsive"> 
                            <table class="table table-bordered">
                                 <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>{{ __('English') }} </th>
                                        <th>{{ __('French') }} </th>
                                        <th>{{ __('Action') }}</th>
                                      </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($navigations as $navigation)
                                     <tr>
                                        <form action="{{ route('modifyDatabase') }}" method="POST">
                                            @csrf
                                            <td>
                                                {{ $loop->iteration }}
                                            </td> 
                                            <td>
                                                {{ app()->setLocale('en') }} 
                                                <input class="form-control" type="text" name="navigation_name_en" value="{{ $navigation->name }}">
                                            </td>
                                            <td> 
                                                {{ app()->setLocale('fr') }}
                                                <input type="hidden" name="navigation_id" value="{{ $navigation->id }}">
                                                <input type="hidden" name="table" value="navigation"> 
                                                 <input class="form-control" type="text" name="navigation_name" value="{{ $navigation->name }}">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
                                            </td>
                                        </form>

                                     </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div> 
                       
                    </div>
                  </div>
                </div>


                <div class="card">
                  <div class="card-header" id="heading6">
                    <h2 class="mb-0 w-100">
                      <button class="btn w-100 btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                        {{ __('Non-Navigation Name Translation') }}
                      </button>
                    </h2>
                  </div>
                  <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="table table-responsive"> 
                            <table class="table table-bordered">
                                 <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>{{ __('English') }} </th>
                                        <th>{{ __('French') }} </th>
                                        <th>{{ __('Action') }}</th>
                                      </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($non_navigations as $navigation)
                                     <tr>
                                        <form action="{{ route('modifyDatabase') }}" method="POST">
                                            @csrf
                                            <td>
                                                {{ $loop->iteration }}
                                            </td> 
                                            <td>
                                                {{ app()->setLocale('en') }} 
                                                <input class="form-control" type="text" name="navigation_name_en" value="{{ $navigation->name }}">
                                            </td>
                                            <td> 
                                                {{ app()->setLocale('fr') }}
                                                <input type="hidden" name="navigation_id" value="{{ $navigation->id }}">
                                                <input type="hidden" name="table" value="non_navigation"> 
                                                 <input class="form-control" type="text" name="navigation_name" value="{{ $navigation->name }}">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
                                            </td>
                                        </form>

                                     </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div> 
                       
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="heading7">
                    <h2 class="mb-0 w-100">
                      <button class="btn w-100 btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                        {{ __('Role Name Translation') }}
                      </button>
                    </h2>
                  </div>
                  <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="table table-responsive">
                            <table class="table table-bordered">
                                 <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>{{ __('English') }} </th>
                                        <th>{{ __('French') }} </th>
                                        <th>{{ __('Action') }}</th>
                                      </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($roles as $role)
                                     <tr>
                                        <form action="{{ route('modifyDatabase') }}" method="POST">
                                            @csrf
                                            <td>
                                                {{ $loop->iteration }}
                                            </td> 
                                            <td>
                                                {{ app()->setLocale('en') }} 
                                                <input class="form-control" type="text" name="role_name_en" value="{{ $role->name }}">
                                            </td>
                                            <td> 
                                                {{ app()->setLocale('fr') }}
                                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                <input type="hidden" name="table" value="role"> 
                                                 <input class="form-control" type="text" name="role_name" value="{{ $role->name }}">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
                                            </td>
                                        </form>

                                     </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div> 
                       
                    </div>
                  </div>
                </div>


                
                {{-- <div class="card">
                  <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                      <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Collapsible Group Item #3
                      </button>
                    </h2>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                      And lastly, the placeholder content for the third and final accordion panel. This panel is hidden by default.
                    </div>
                  </div>
                </div> --}}
              </div> 
        </div>
    </div>
</section>
    
@endsection