{{-- Simple CRUD Save Modal (Metronic 8) --}}
<div class="modal fade" id="save_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="modal_title">Create New Item</h5>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"/>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-10 my-5">
                <form id="item_form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="item_id" value="0" type="hidden"/>

                    {{-- Image Upload --}}
                    <div class="fv-row mb-7 text-center">
                        <label class="d-block fw-bold fs-6 mb-5">Image</label>
                        <div class="image-input image-input-outline" data-kt-image-input="true"
                             style="background-image: url('{{ asset('cpanel/media/svg/avatars/blank.svg') }}')">
                            <div class="image-input-wrapper w-125px h-125px" id="image_preview"
                                 style="background-image: url('{{ asset('cpanel/media/svg/avatars/blank.svg') }}')"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                   data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="img" accept=".png, .jpg, .jpeg, .webp"/>
                                <input type="hidden" name="img_remove"/>
                            </label>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                  data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                        </div>
                        <div class="_laravel_error text-danger mt-1" data-error="img"></div>
                    </div>

                    {{-- Name --}}
                    <div class="_input_group fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Name</label>
                        <input value="" name="name" type="text"
                               class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Enter item name"/>
                        <div class="_laravel_error text-danger mt-1" data-error="name"></div>
                    </div>

                    {{-- Details --}}
                    <div class="_input_group fv-row mb-7">
                        <label class="fw-bold fs-6 mb-2">Details</label>
                        <textarea name="details" class="form-control form-control-solid mb-3 mb-lg-0" rows="3"
                                  placeholder="Enter details"></textarea>
                        <div class="_laravel_error text-danger mt-1" data-error="details"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                <button form="item_form" id="save_item_btn" type="submit" class="btn btn-primary">
                    <span class="indicator-label">Save Changes</span>
                </button>
            </div>
        </div>
    </div>
</div>
