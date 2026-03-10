@if(count($items))
    @foreach($items as $item)
        <div class="ui-state-default" id="item_id_{{ $item->id }}" style="cursor: move;">
            <div class="d-flex align-items-center bg-hover-light-primary rounded p-3 mb-2 border border-gray-200 border-dashed">
                <span class="svg-icon svg-icon-3 me-3 text-gray-500">
                    <i class="bi bi-grip-vertical fs-4"></i>
                </span>
                <div class="flex-grow-1">
                    <span class="fw-bold text-gray-800 fs-6">{{ $item->name }}</span>
                </div>
                <span class="badge badge-light-primary fs-7">{{ $item->days }} days</span>
            </div>
        </div>
    @endforeach
@else
    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
            <i class="bi bi-exclamation-triangle-fill text-warning fs-3"></i>
        </span>
        <div class="d-flex flex-stack flex-grow-1">
            <div class="fw-bold">
                <div class="fs-6 text-gray-700">No items to sort.</div>
            </div>
        </div>
    </div>
@endif
