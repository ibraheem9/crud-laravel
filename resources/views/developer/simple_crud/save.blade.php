<div class="modal-header">
    <h5 class="modal-title">{{ $item ? 'Edit ' . $item->name : 'Create New Item' }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <form id="item_form" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="item_id" value="{{ $item ? $item->id : 0 }}" type="hidden"/>

        {{-- name --}}
        <div class="_input_group mb-3">
            <label class="form-label fw-bold required">Name</label>
            <input value="{{ $item ? $item->name : '' }}" name="name" type="text"
                   class="form-control" placeholder="Enter item name"/>
            <div class="_laravel_error text-danger mt-1"></div>
        </div>

        {{-- details --}}
        <div class="_input_group mb-3">
            <label class="form-label fw-bold">Details</label>
            <textarea name="details" class="form-control" rows="3"
                      placeholder="Enter details">{{ $item ? $item->details : '' }}</textarea>
            <div class="_laravel_error text-danger mt-1"></div>
        </div>

        {{-- img --}}
        <div class="_input_group mb-3">
            <label class="form-label fw-bold">Image</label>
            @if($item && $item->img)
                <div class="mb-2">
                    <img src="{{ $item->img_url }}" class="rounded" style="max-width: 100px; max-height: 100px;"/>
                </div>
            @endif
            <input name="img" type="file" class="form-control" accept="image/*"/>
            <div class="_laravel_error text-danger mt-1"></div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    <button form="item_form" id="save_item_btn" type="submit" class="btn btn-primary">Save</button>
</div>
