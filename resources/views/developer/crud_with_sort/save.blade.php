<div class="modal fade" tabindex="-1" id="duration_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Plan Duration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="duration_form" method="POST">
                    @csrf
                    <input name="item_id" value="0" id="duration_id" type="hidden"/>

                    {{-- name --}}
                    <div class="_input_group mb-3">
                        <label class="form-label fw-bold required">Name</label>
                        <input name="name" type="text" class="form-control" id="duration_name"
                               placeholder="e.g., 3 Months"/>
                        <div class="_laravel_error text-danger mt-1"></div>
                    </div>

                    {{-- days --}}
                    <div class="_input_group mb-3">
                        <label class="form-label fw-bold required">Duration (Days)</label>
                        <div class="input-group">
                            <input name="days" type="text" class="form-control integer_mask" id="duration_days"/>
                            <span class="input-group-text">days</span>
                        </div>
                        <div class="_laravel_error text-danger mt-1"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button form="duration_form" id="save_duration_btn" type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
