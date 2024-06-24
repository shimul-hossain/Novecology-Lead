{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title', __('Notion'))

{{-- active menu  --}}
@section('notionActive', 'active')

@section('bodyBg', 'secondary-bg')

@push('css')
<style>
    .nav-pills .nav-link{
        background-color: #ffffff;
        border: 1px solid #ececec;
    }
    .nav-pills .nav-link.active{
        background-color: #13438c;
        border-color: #13438c;
    }
    .notion-preview-card__body__badge{
        margin-top: -3rem;
        padding-bottom: 2rem;
    }
</style>
@endpush


{{-- main content  --}}
@section('content')
<div class="notion">
	<div class="notion__header">
		<img src="{{ asset('crm_assets/assets/images/banner/banner.png') }}" alt="cover image" class="notion__header__image notion-cover-image">
		{{-- <div class="container notion__header__container">
			<form id="coverForm">
				<label class="notion__header__label">
					<input type="file" name="cover" class="notion__header__label__input notion-cover-image-toggler" accept="image/*">
					<span class="notion__header__label__button">Chnage Cover</span>
				</label>
			</form>
		</div> --}}
	</div>
</div>

<section class="py-5">
	<div class="container">
		<div class="text-right pb-3">
			@if (checkAction(Auth::id(), 'notion', 'create') || role() == 's_admin')
				<button type="button" class="secondary-btn border-0" data-toggle="modal" data-target="#addMoreNotion">
                    <i class="bi bi-plus "></i>
					Nouvelle Notion
				</button>
			@else
				<button type="button" class="secondary-btn border-0">
					<span class="novecologie-icon-lock py-1"></span>  Nouvelle Notion
				</button>
			@endif
		</div>
		<ul class="nav nav-pills justify-content-center mb-4" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
			  <a href="{{ route('notion.index') }}" class="nav-link active" id="pills-home-tab" aria-selected="true">Tous</a>
			</li>
			@foreach ($categories as $category)
				<li class="nav-item pl-2" role="presentation">
				  <button type="button" class="nav-link categoryBtn" data-id="{{ $category->id }}" id="pills-profile-tab" data-toggle="pill" role="tab"  aria-selected="false">{{ $category->name }}</button>
				</li>
			@endforeach
		</ul>
		<div id="categoryWrap">
			<div class="row notionWrap">
				@foreach ($notions as $notion)
					<div class="col-lg-4 col-md-6">
						<div class="notion-preview-card">
							<a href="{{ route('notion.details', $notion->id) }}" class="notion-preview-card__header">
								@if ($notion->cover)
									<img src="{{ asset('uploads/notion') }}/{{ $notion->cover }}" alt="cover image" loading="lazy" class="notion-preview-card__header__image">
								@else
									<img src="{{ asset('crm_assets/assets/images/default_cover.jpg') }}" alt="cover image" loading="lazy" class="notion-preview-card__header__image">
								@endif
							</a>
							<div class="notion-preview-card__body">
                                <div class="notion-preview-card__body__avatar">
                                    @if ($notion->profile)
                                        <img src="{{ asset('uploads/notion') }}/{{ $notion->profile }}" alt="avatar" class="notion-preview-card__body__avatar__image">
                                    @else
                                        <img src="{{ asset('crm_assets/assets/images/default_avatar.png') }}" alt="avatar" class="notion-preview-card__body__avatar__image">
                                    @endif
                                </div>
                                @if ($notion->category_id)
                                <div class="notion-preview-card__body__badge text-right pt-2">
                                    <span class="btn text-white badge badge-primary rounded-pill">{{ $notion->getCategory->name ?? '' }}</span>
                                </div>
                                @endif
								@if (checkAction(Auth::id(), 'notion', 'edit') || role() == 's_admin')
									<button type="button" class="secondary-btn border-0 mt-1" data-toggle="modal" data-target="#editModal{{ $notion->id }}">{{ __('Edit') }}</button>
								@else
									<button type="button" class="secondary-btn border-0 mt-1"><span class="novecologie-icon-lock py-1"></span> {{ __('Edit') }}</button>
								@endif 
								<h3 class="notion-preview-card__body__title d-flex justify-content-between">
									<a href="{{ route('notion.details', $notion->id) }}">{{ $notion->title }}</a>
									<div class="avatar-group d-flex">
										@if ($notion->assignee->count() > 3)
											@foreach($notion->assignee as $assigne)
											<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $assigne->name }}">
												@if ($assigne->profile_photo)
												<img src="{{ asset('uploads/crm/profiles') }}/{{ $assigne->profile_photo }}" alt="{{ $assigne->name }}" class="avatar-group__image w-100 h-100">
												@else
												<img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
												@endif
											</a>
											@if ($loop->iteration > 3)
												@if ($notion->assignee->count() > 4)
												<a href="#!" class="avatar-group__more">+{{ $notion->assignee->count() - 4 }} {{ __('more') }}</a>
												@endif
												@break
											@endif
											@endforeach
										@else
											@forelse ($notion->assignee as $assigne)
											<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $assigne->name }}">
												@if ($assigne->profile_photo)
												<img src="{{ asset('uploads/crm/profiles') }}/{{ $assigne->profile_photo }}" alt="{{ $assigne->name }}" class="avatar-group__image w-100 h-100">
												@else
												<img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
												@endif
											</a>
											@empty
											{{ __('No assignee') }}
											@endforelse
										@endif
									</div>
								</h3>
							</div>
							<div class="notion-preview-card__footer">
								<div class="row justify-content-between">
									<div class="col-auto">
										<div class="notion-preview-card__inner__card">
											<div class="notion-preview-card__inner__card__header">
												<span class="notion-preview-card__inner__card__header__icon">
													<i class="bi bi-person-plus"></i>
												</span>
												<span class="notion-preview-card__inner__card__header__text">Created By</span>
											</div>
											<h4 class="notion-preview-card__inner__card__title">{{ $notion->createdBy->name }}</h4>
										</div>
									</div>
									<div class="col-auto">
										<div class="notion-preview-card__inner__card">
											<div class="notion-preview-card__inner__card__header">
												<span class="notion-preview-card__inner__card__header__icon">
													<i class="bi bi-clock"></i>
												</span>
												<span class="notion-preview-card__inner__card__header__text">Created At</span>
											</div>
											<h4 class="notion-preview-card__inner__card__title">{{ \Carbon\Carbon::parse($notion->created_at)->diffForHumans() }}</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					@push('all_modals')
						<!-- Modal -->
						<div class="modal fade" id="editModal{{ $notion->id }}" tabindex="-1" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title">Edit Notion</h1>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="{{ route('notion.update') }}" method="post" enctype="multipart/form-data">
										@csrf
										<div class="modal-body">
											<div class="form-group">
												<label class="form-label">{{ __('Title') }} *</label>
												<input type="text" name="title" value="{{ $notion->title }}" class="form-control" required>
												<input type="hidden" name="id" value="{{ $notion->id }}">
											</div>
											<div class="form-group">
												<label class="form-label">{{ __('Assignee') }}</label>
												<select name="user_id[]" class="select2_select_option form-control" multiple>
													@foreach ($installers as $installer)
														<option
														@if (\App\Models\CRM\NotionAssign::where('user_id', $installer->id)->where('notion_id', $notion->id)->exists())
															selected
														@endif
														value="{{ $installer->id }}">{{ $installer->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Catégorie *</label>
												<select name="category_id" class="select2_select_option form-control notionCategory" data-id="{{ $notion->id }}" required>
													<option value="" selected>{{ __('Select') }}</option>
													@foreach ($categories as $category)
														<option {{ $notion->category_id == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Sous Catégorie</label>
												<select name="sub_category_id" class="select2_select_option form-control notionSubCategory{{ $notion->id }}">
													<option value="" selected>{{ __('Select') }}</option>
													@if ($notion->getCategory)
														@foreach ($notion->getCategory->subCategories as $sub_category)
															<option {{ $notion->sub_category_id == $sub_category->id ? "selected":'' }} value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
														@endforeach
													@endif
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">{{ __('Notion Profile Image') }}</label>
												<div class="input-group mb-3">
													<div class="custom-file">
														<input type="file" accept="image/*" name="profile" class="custom-file-input" id="profileImage{{ $notion->id }}">
														<label class="custom-file-label" for="profileImage{{ $notion->id }}">Choose file</label>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="form-label">{{ __('Notion Cover Image') }}</label>
												<div class="input-group mb-3">
													<div class="custom-file">
														<input type="file" accept="image/*" name="cover" class="custom-file-input" id="coverImage{{ $notion->id }}">
														<label class="custom-file-label" for="coverImage{{ $notion->id }}">Choose file</label>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" data-dismiss="modal" data-toggle="modal" data-target="#deleteModal{{ $notion->id }}" class="btn btn-danger border-0 mr-auto">Supprimer</button>
											<button type="submit" class="secondary-btn border-0">{{ __('Submit') }}</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="modal modal--aside fade" id="deleteModal{{ $notion->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content border-0">
									<div class="modal-header border-0 pb-0">
										<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
											<span class="novecologie-icon-close"></span>
										</button>
									</div>
									<div class="modal-body text-center pt-0">
										<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
										<span>{{ __('Are You Sure To Delete this') }} ?</span>
										<form action="{{ route('notion.delete') }}" method="POST">
											@csrf
											<input type="hidden" name="id" value="{{ $notion->id }}">
											<div class="d-flex justify-content-center">
												<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
													Annuler
												</button>
												<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
													Confirmer
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					@endpush
				@endforeach
			</div>
		</div>
		<div class="text-center {{ $notions->count() == 30 ? '':'d-none' }}" id="loadMoreWrap">
			<div class="lead__card__loader-wrapper d-none">
				<div class="lead__card__loader">
					<svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
						<path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
						<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
						</path>
					</svg>
				</div>
			</div>
			<input type="hidden" id="loadMoreCount" value="30">
			<input type="hidden" id="loadMoreType" value="all">
			<input type="hidden" id="loadMoreCategory" value="0">
			<input type="hidden" id="loadMoreSubcategory" value="0">
			<button type="button" class="secondary-btn border-0" id="loadMoreBtn">Charger plus</button>
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="addMoreNotion" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title">Create Notion</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('notion.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label class="form-label">{{ __('Title') }} *</label>
						<input type="text" name="title" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="form-label">{{ __('Assignee') }}</label>
						<select name="user_id[]" class="select2_select_option form-control" multiple>
							@foreach ($installers as $installer)
								<option value="{{ $installer->id }}">{{ $installer->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">Catégorie *</label>
						<select name="category_id" class="select2_select_option form-control notionCategory" data-id="0" required>
							<option value="" selected>{{ __('Select') }}</option>
							@foreach ($categories as $category)
								<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">Sous Catégorie</label>
						<select name="sub_category_id" class="select2_select_option form-control notionSubCategory0">
							<option value="" selected>{{ __('Select') }}</option>
						</select>
					</div>
					<div class="form-group">
						<label class="form-label">{{ __('Notion Profile Image') }}</label>
						<div class="input-group mb-3">
							<div class="custom-file">
								<input type="file" accept="image/*" name="profile" class="custom-file-input" id="profileImage">
								<label class="custom-file-label" for="profileImage">Choose file</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="form-label">{{ __('Notion Cover Image') }}</label>
						<div class="input-group mb-3">
							<div class="custom-file">
								<input type="file" accept="image/*" name="cover" class="custom-file-input" id="coverImage">
								<label class="custom-file-label" for="coverImage">Choose file</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="secondary-btn border-0">{{ __('Submit') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@push('plugins-script')
<script src="{{ asset('crm_assets/assets/plugins/editorjs/js/editor.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/editorjs/js/editor.bundle.js') }}"></script>
@endpush

@push('js')

<script>
	$(document).ready(function () {

		$("body").on("click", '#loadMoreBtn', function(){ 
			$('.lead__card__loader-wrapper').removeClass('d-none');
			$(this).addClass('d-none');
			
			let count = $('#loadMoreCount').val();
			let type = $('#loadMoreType').val();
			let category = $('#loadMoreCategory').val();
			let subcategory = $('#loadMoreSubcategory').val();

			$.ajax({
				type : "POST",
				url  : "{{ route('notion.load.more') }}",
				data : {count, type, category, subcategory},

				success : (response) =>{
					$(this).removeClass('d-none');
					$('.lead__card__loader-wrapper').addClass('d-none');
					$('.notionWrap').append(response.data);
					$('#loadMoreCount').val(response.total_count);
					if(!response.load_status){ 
						$('#loadMoreWrap').addClass('d-none');
					}

					$('.select2_select_option').select2();
				},
				error : (errors) => {
					$(this).removeClass('d-none');
					$('.lead__card__loader-wrapper').addClass('d-none');
				}
			});

		});
		$(".categoryBtn").on("click", function(){
			
			$('#loadMoreCount').val(30);
			$('#loadMoreType').val('category');
			$('#loadMoreCategory').val($(this).data('id'));
			$('#loadMoreSubcategory').val('');

			$.ajax({
				type: "POST",
				url : "{{ route('notion.category.filter') }}",
				data : {
					category_id : $(this).data('id'),
				},
				success : (response)=> {
					$('#categoryWrap').html(response.data)
					if(response.load_status){ 
						$('#loadMoreWrap').removeClass('d-none');
					}else{
						$('#loadMoreWrap').addClass('d-none');
					}

					$('.select2_select_option').select2();
				},
				error: (error) => {
					console.log(error);
				}
			});
		});
		$("body").on("click", '.subCategoryFitler', function(){
			
			$('#loadMoreCount').val(30);
			$('#loadMoreType').val('subcategory');
			$('#loadMoreCategory').val('');
			$('#loadMoreSubcategory').val($(this).data('id'));
			
			$.ajax({
				type: "POST",
				url : "{{ route('notion.subcategory.filter') }}",
				data : {
					sub_category_id : $(this).data('id'),
				},
				success : (response)=> {
					$('#subCategoryWrap').html(response.data)
					if(response.load_status){ 
						$('#loadMoreWrap').removeClass('d-none');
					}else{
						$('#loadMoreWrap').addClass('d-none');
					}

					$('.select2_select_option').select2();
				},
				error: (error) => {
					console.log(error);
				}
			});
		});
		$(".notionCategory").on("change", function(){
			$.ajax({
				type: "POST",
				url : "{{ route('notion.category.change') }}",
				data : {
					category_id : $(this).val(),
				},
				success : (response)=> {
					$('.notionSubCategory'+$(this).data('id')).html(response)
				},
				error: (error) => {
					console.log(error);
				}
			});
		}); 
	});
</script>
@endpush
