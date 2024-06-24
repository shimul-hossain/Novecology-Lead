{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title', __('Notion'))

{{-- active menu  --}}
@section('notionActive', 'active')


{{-- main content  --}}
@section('content')
<div class="notion">
	<div class="notion__header">
		@if ($notion->cover)
			<img src="{{ asset('uploads/notion') }}/{{ $notion->cover }}" alt="cover image" class="notion__header__image notion-cover-image">
		@else
			<img src="{{ asset('crm_assets/assets/images/default_cover.jpg') }}" alt="cover image" class="notion__header__image notion-cover-image">
		@endif
		<div class="container notion__header__container">
			<form id="coverForm">
				<label class="notion__header__label">
					<input type="file" name="cover" class="notion__header__label__input notion-cover-image-toggler" accept="image/*">
					<input type="hidden" name="id" value="{{ $notion->id }}">
					<span class="notion__header__label__button">{{ __('Change Cover') }}</span>
				</label>
			</form>
		</div>
	</div>
	<div class="notion__body">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 d-flex justify-content-between">
					<form id="profileForm">
						<label class="notion__body__profile">
							<input type="file" name="profile" class="notion__body__profile__input notion-profile-image-toggler" accept="image/*">
							<input type="hidden" name="id" value="{{ $notion->id }}">
							@if($notion->profile)
							<img src="{{ asset('uploads/notion') }}/{{ $notion->profile }}" alt="profile image" class="notion__body__profile__image notion-profile-image">
							@else
							<img src="{{ asset('crm_assets/assets/images/default_avatar.png') }}" alt="profile image" class="notion__body__profile__image notion-profile-image">
							@endif
						</label>
					</form>
					<div class="mt-4">
						<button type="button"  class="secondary-btn border-0" data-toggle="modal" data-target="#assignModal">Partager</button>
						@if ($notion->getCategory)
							<button  type="button" class="secondary-btn border-0 ml-3">{{ $notion->getCategory->name ?? '' }}</button>
						@endif
					</div>
				</div>
				<div class="col-md-8">
					<input type="text" value="{{ $notion->title }}" data-id="{{ $notion->id }}" class="notion__title" @if (!checkAction(Auth::id(), 'notion', 'edit') && role() != 's_admin') readonly @endif>
					<div id="editorjs"></div>
				</div>
			</div>
		</div>
	</div>

</div>

@push('all_modals')
	<!-- Modal -->
	<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Partager </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{ route('notion.assign.update') }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="modal-body">
						<input type="hidden" name="id" value="{{ $notion->id }}">
						<div class="form-group">
							<label for="">{{ __('Assignee') }}</label>
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
					</div>
					<div class="modal-footer">
						<button type="submit" class="secondary-btn border-0">{{ __('Submit') }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endpush

@endsection

@push('plugins-script')
{{-- <script src="{{ asset('crm_assets/assets/plugins/editorjs/js/editor.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="{{ asset('crm_assets/assets/plugins/editorjs/js/editor.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/link-autocomplete" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/attaches@latest" defer></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-text-color-plugin@2.0.4/dist/bundle.js" defer></script>
@endpush

@push('js')
	@php
		$editorGetDataFromDatabase = json_decode($notion->data, true);
		function parseData(&$value) {
			if(is_array($value)) {
				foreach($value as &$v) {
					parseData($v);
				}
			} else {
				if($value === "true") {
					$value = true;
				} else if($value === "false") {
					$value = false;
				}
			}
		};
		parseData($editorGetDataFromDatabase);
	@endphp

<script>
	$(document).ready(function () {

		var editor = new EditorJS({
			@if (checkAction(Auth::id(), 'notion', 'edit') || role() == 's_admin')
				readOnly: false,
			@else
				readOnly: true,
			@endif
			

			holder: 'editorjs',
			data: {
				blocks: @json($editorGetDataFromDatabase),
			},


			tools: {
				header: {
					class: Header,
					inlineToolbar: true,
					config: {
						placeholder: 'Heading',
						levels: [1,2,3],
						defaultLevel: 1
					}
				},
				// image: {
				// 	class: SimpleImage,
				// 	inlineToolbar: ['link'],
				// },
				image: {
					class: ImageTool,
					config: {
						endpoints: {
							byFile: '{{ route("notion.uploadFile") }}',
						}
					}
				},
				attaches: {
					class: AttachesTool,
					config: {
						endpoint: '{{ route("notion.uploadFile") }}'
					}
				},
				list: {
					class: List,
					inlineToolbar: true,
				},
				checklist: {
					class: Checklist,
					inlineToolbar: true,
				},
				table: {
					class: Table,
					inlineToolbar: true,
				},
				quote: {
					class: Quote,
					inlineToolbar: true,
					config: {
						quotePlaceholder: 'Enter a quote',
						captionPlaceholder: 'Quote\'s author',
					},
				},
				embed: {
					class: Embed,
					inlineToolbar: true,
				},
				link: {
					class: LinkAutocomplete,
				},
				code: CodeTool,
				warning: Warning,
				// marker: Marker,
				inlineCode: InlineCode,
				delimiter: Delimiter,
				Color: {
					class: window.ColorPlugin,
					config: {
						colorCollections: ['#EC7878','#9C27B0','#673AB7','#3F51B5','#0070FF','#03A9F4','#00BCD4','#4CAF50','#8BC34A','#CDDC39', '#FFF'],
						defaultColor: '#FF1300',
						type: 'text', 
						customPicker: true 
					}     
				},
				Marker: {
					class: window.ColorPlugin,
					config: {
						defaultColor: '#FFBF00',
						type: 'marker',
						customPicker: true,
						icon: `<svg fill="#000000" height="200px" width="200px" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M17.6,6L6.9,16.7c-0.2,0.2-0.3,0.4-0.3,0.6L6,23.9c0,0.3,0.1,0.6,0.3,0.8C6.5,24.9,6.7,25,7,25c0,0,0.1,0,0.1,0l6.6-0.6 c0.2,0,0.5-0.1,0.6-0.3L25,13.4L17.6,6z"></path> <path d="M26.4,12l1.4-1.4c1.2-1.2,1.1-3.1-0.1-4.3l-3-3c-0.6-0.6-1.3-0.9-2.2-0.9c-0.8,0-1.6,0.3-2.2,0.9L19,4.6L26.4,12z"></path> </g> <g> <path d="M28,29H4c-0.6,0-1-0.4-1-1s0.4-1,1-1h24c0.6,0,1,0.4,1,1S28.6,29,28,29z"></path> </g> </g></svg>`
					}       
				},
			},

			onChange: function(api, event) {
				editor.save().then((savedData) => {
					// console.log('change date',savedData.blocks);
					$.ajax({
						type: "POST",
						url : "{{ route('notion.data.store') }}",
						data : {
							id : {{ $notion->id }},
							data : savedData.blocks,
						},
						success : (response)=> {},
						error: (error) => {
							console.log(error);
						}
					});
				});
			}
		});

		/* Change Image Preview Function */
		$(".notion-cover-image-toggler").on("change", function(){
			let [currentGetFile] = this.files;
			if (currentGetFile) {
				$(".notion-cover-image").attr("src", URL.createObjectURL(currentGetFile));
				$.ajax({
					type: "POST",
					url : "{{ route('notion.cover.update') }}",
					processData: false,
					contentType: false,
					data : new FormData($('#coverForm')[0]),
					success : (response)=> {
						console.log(response);
					},
					error: (error) => {
						console.log(error);
					}
				});
			}
		});

		$(".notion-profile-image-toggler").on("change", function(){
			let [currentGetFile] = this.files;
			if (currentGetFile) {
				$(".notion-profile-image").attr("src", URL.createObjectURL(currentGetFile));
				$.ajax({
					type: "POST",
					url : "{{ route('notion.profile.update') }}",
					processData: false,
					contentType: false,
					data : new FormData($('#profileForm')[0]),
					success : (response)=> {
						console.log(response);
					},
					error: (error) => {
						console.log(error);
					}
				});
			}
		});

		$('body').on('input','.notion__title' ,function(){
			let id    = $(this).data('id');
			let title = $(this).val();
			console.log(title);
			$.ajax({
				type: "POST",
				url : "{{ route('notion.title.update') }}",
				data : { id, title},
				success : (response)=> {
					console.log(response);
				},
				error: (error) => {
					console.log(error);
				}
			});
		});
	});
</script>
@endpush
