<div class="modal fade" id="sort_items_modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Sort Items</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-7 p-6">
                    <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                        <i class="bi bi-info-circle-fill text-primary fs-3"></i>
                    </span>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-bold">
                            <div class="fs-6 text-gray-700">Drag and drop items to reorder them. Changes are saved automatically.</div>
                        </div>
                    </div>
                </div>
                <div id="sort_items_container"></div>
            </div>
            <div class="modal-footer flex-center">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
