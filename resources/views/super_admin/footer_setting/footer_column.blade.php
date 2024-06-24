@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Footer Column') }}
@endsection

{{-- Menu Active --}}
@section('footerColumnIndex')
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
                    <li class="breadcrumb-item">{{ __('Footer Column Setting') }}</li>
                    <br>
                    <br>
                    <br>
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
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        {{-- First Column --}}
        {{-- <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Footer First Column ({{ $footerColumn_name->first_column }})</h4>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#first_column">
                        Add a title
                    </button>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cloumnSettingFirst as $item)
                            <tr>
                                <td>
                                    <span>{{ $loop->index + 1 }}</span>
                                </td>

                                <td>
                                    <span>{{ $item->title }}</span>
                                </td>
                                <td>
                                    <span>{{ $item->link }}</span>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#first_column_edit{{ $item->id }}">
                                        Edit
                                    </button>
                                </td>

                                <td>
                                    <form action="{{ route('columnSettings.destroy',$item->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}

                                        <a href="{{ route('columnSettings.destroy',$item->id) }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            type="submit" class="btn btn-danger btn-sm">Delete
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            <!--First Column edit Modal -->
                            <div class="modal fade" id="first_column_edit{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Add title for 1st
                                                column</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('columnSettings.update',$item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <input hidden name="column_no" type="text" value="1st">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" class="form-control" id="title"
                                                        value="{{ $item->title }}">
                                                    @error('title')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="link">Link</label>
                                                    <select name="link" class="form-control" id="link">
                                                        @php
                                                            $page_name = App\Models\Pages::where('link',$item->link)->first();
                                                        @endphp
                                                        <option value="{{$item->link}}">{{ $page_name->title }}</option>
                                                        @foreach ($pages as $page)
                                                            @if ($page->link != $item->link)
                                                                 <option value="{{$page->link}}">{{ $page->title }}</option>
                                                            @endif 
                                                        @endforeach
                                                    </select>
                                                    @error('link')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        {{-- Second Column --}}
        {{-- <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Footer Second Column ({{ $footerColumn_name->second_column}})</h4>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#second_column">
                        Add a title
                    </button>

                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($cloumnSettingSecond as $item)
                            <tr>
                                <td>
                                    <span>{{ $loop->index + 1 }}</span>
                                </td>

                                <td>
                                    <span>{{ $item->title }}</span>
                                </td>

                                <td>
                                    <span>{{ $item->link }}</span>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#second_column_edit{{ $item->id }}">
                                        Edit
                                    </button>
                                </td>

                                <td>
                                    <form action="{{ route('columnSettings.destroy',$item->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}

                                        <a href="{{ route('columnSettings.destroy',$item->id) }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            type="submit" class="btn btn-danger btn-sm">Delete
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            <!--Second Column edit Modal -->
                            <div class="modal fade" id="second_column_edit{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Add title for 1st
                                                column</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('columnSettings.update',$item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <input hidden name="column_no" type="text" value="2nd">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" class="form-control" id="title"
                                                        value="{{ $item->title }}">
                                                    @error('title')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="link">Link</label>
                                                    <select name="link" class="form-control" id="link">
                                                        @php
                                                            $page_name = App\Models\Pages::where('link',$item->link)->first();
                                                        @endphp
                                                        <option value="{{$item->link}}">{{ $page_name->title }}</option>
                                                        @foreach ($pages as $page)
                                                            @if ($page->link != $item->link)
                                                                 <option value="{{$page->link}}">{{ $page->title }}</option>
                                                            @endif 
                                                        @endforeach
                                                    </select>
                                                    @error('link')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        {{-- Third Column --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Footer Custom Pages') }}</h4>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#third_column">
                        +{{ __('Add') }}
                    </button>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped" id="data_table">
                            <thead>
                                <tr>
                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Link') }}</th>
                                    <th>{{ __('Edit') }}</th>
                                    <th>{{ __('Delete') }}</th>
                                </tr>
                            </thead>
                            <tbody>
    
                                @foreach ($cloumnSettingThird as $item)
                                <tr>
                                    <td>
                                        <span>{{ $loop->index + 1 }}</span>
                                    </td>
    
                                    <td>
                                        <span>{{ $item->title }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $item->link }}</span>
                                    </td>
    
    
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#third_column_edit{{ $item->id }}">
                                            {{ __('Edit') }}
                                        </button>
                                    </td>
    
                                    <td>
                                        <form action="{{ route('columnSettings.destroy',$item->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
    
                                            <a href="{{ route('columnSettings.destroy',$item->id) }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                                type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}
                                            </a>
                                        </form>
                                    </td>
                                </tr>
    
                                <!--Third Column Edit Modal -->
                                <div class="modal fade" id="third_column_edit{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Add title for 1st column') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('columnSettings.update',$item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <input hidden name="column_no" type="text" value="3rd">
                                                    <div class="form-group">
                                                        <label for="title">{{ __('Title') }}</label>
                                                        <input type="text" name="title" class="form-control" id="title"
                                                            value="{{ $item->title }}">
                                                        @error('title')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="link">{{ __('Link') }}</label>
                                                        <select name="link" class="form-control" id="link">
                                                            @php
                                                                $page_name = App\Models\Pages::where('link',$item->link)->first();
                                                            @endphp
                                                            <option value="{{$item->link}}">{{ $page_name->title }}</option>
                                                            @foreach ($pages as $page)
                                                                @if ($page->link != $item->link)
                                                                     <option value="{{$page->link}}">{{ $page->title }}</option>
                                                                @endif 
                                                            @endforeach
                                                        </select>
                                                        @error('link')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




{{-- 
<!--First Column Modal -->
<div class="modal fade" id="first_column" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add title for 1st column</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('columnSettings.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input hidden name="column_no" type="text" value="1st">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>

                        <select name="link" class="form-control" id="link">
                            <option>--Select--</option>
                            @foreach ($pages as $page)
                                <option value="{{$page->link}}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                        @error('link')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--Second Column Modal -->
<div class="modal fade" id="second_column" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add title for 2nd column</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('columnSettings.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input hidden name="column_no" type="text" value="2nd">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <select name="link" class="form-control" id="link">
                            <option>--Select--</option>
                            @foreach ($pages as $page)
                                <option value="{{$page->link}}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                        @error('link')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}


<!--ThirdColumn Modal -->
<div class="modal fade" id="third_column" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Add title for 3rd column') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('columnSettings.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input hidden name="column_no" type="text" value="3rd">
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link">{{ __('Link') }}</label>
                        <select name="link" class="form-control" id="link">
                            <option>--{{ __('Select') }}--</option>
                            @foreach ($pages as $page)
                                <option value="{{$page->link}}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                        @error('link')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection