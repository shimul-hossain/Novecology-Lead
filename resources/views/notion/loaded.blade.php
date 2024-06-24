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
                        <img  loading="lazy"  src="{{ asset('uploads/notion') }}/{{ $notion->profile }}" alt="avatar" class="notion-preview-card__body__avatar__image">
                    @else
                        <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/default_avatar.png') }}" alt="avatar" class="notion-preview-card__body__avatar__image">
                    @endif
                </div>
                <button class="secondary-btn border-0 mt-1" data-toggle="modal" data-target="#editModal{{ $notion->id }}">{{ __('Edit') }}</button>
                <h3 class="notion-preview-card__body__title d-flex justify-content-between">
                    <a href="{{ route('notion.details', $notion->id) }}">{{ $notion->title }} @if ($notion->category_id)
                        <span class="badge badge-secondary"> {{ $notion->getCategory->name ?? '' }}</span>
                        @endif </a>
                    <div class="avatar-group d-flex"> 
                        @if ($notion->assignee->count() > 3)                       
                            @foreach($notion->assignee as $assigne) 
                            <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $assigne->name }}">
                                @if ($assigne->profile_photo)
                                <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $assigne->profile_photo }}" alt="{{ $assigne->name }}" class="avatar-group__image w-100 h-100">
                                @else
                                <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
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
                                <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $assigne->profile_photo }}" alt="{{ $assigne->name }}" class="avatar-group__image w-100 h-100">
                                @else
                                <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
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

    <!-- Modal -->
    <div class="modal fade" id="editModal{{ $notion->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Notion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('notion.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">{{ __('Title') }} *</label>
                            <input type="text" name="title" value="{{ $notion->title }}" class="form-control" required> 
                            <input type="hidden" name="id" value="{{ $notion->id }}">
                        </div>
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
                        <div class="form-group">
                            <label for="">Catégorie *</label>
                            <select name="category_id" class="select2_select_option form-control notionCategory" data-id="{{ $notion->id }}" required>
                                <option value="" selected>{{ __('Select') }}</option>
                                @foreach ($categories as $category)
                                    <option {{ $notion->category_id == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select> 
                        </div>
                        <div class="form-group">
                            <label for="">Sous Catégorie</label>
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
                            <label for="">{{ __('Notion Profile Image') }}</label> 
                            <div class="input-group mb-3"> 
                                <div class="custom-file">
                                    <input type="file" accept="image/*" name="profile" class="custom-file-input" id="profileImage{{ $notion->id }}">
                                    <label class="custom-file-label" for="profileImage{{ $notion->id }}">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Notion Cover Image') }}</label> 
                            <div class="input-group mb-3"> 
                                <div class="custom-file">
                                    <input type="file" accept="image/*" name="cover" class="custom-file-input" id="coverImage{{ $notion->id }}">
                                    <label class="custom-file-label" for="coverImage{{ $notion->id }}">Choose file</label>
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
@endforeach