<div class="modal fade" tabindex="-1" id="duration_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Plan Duration</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="duration_form" method="POST">
                    @csrf
                    <input name="item_id" value="0" id="duration_id" type="hidden"/>

                    {{-- name --}}
                    <div class="_input_group fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Name</label>
                        <input name="name" type="text" class="form-control form-control-solid mb-3 mb-lg-0"
                               id="duration_name" placeholder="e.g., 3 Months"/>
                        <div class="_laravel_error text-danger mt-1"></div>
                    </div>

                    {{-- days --}}
                    <div class="_input_group fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Duration (Days)</label>
                        <div class="input-group input-group-solid">
                            <input name="days" type="text" class="form-control form-control-solid integer_mask"
                                   id="duration_days"/>
                            <span class="input-group-text">days</span>
                        </div>
                        <div class="_laravel_error text-danger mt-1"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer flex-center">
                <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                <button form="duration_form" id="save_duration_btn" type="submit" class="btn btn-primary">
                    <span class="indicator-label">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>
