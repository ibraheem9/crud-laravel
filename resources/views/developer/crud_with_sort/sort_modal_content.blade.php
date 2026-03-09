@if(count($items))
    @foreach($items as $item)
        <div class="ui-state-default" id="item_id_{{ $item->id }}" style="cursor: move;">
            <span class="btn btn-outline btn-outline-dashed btn-outline-dark w-100 my-2 d-flex align-items-center justify-content-between">
                <span><i class="bi bi-grip-vertical me-2"></i> {{ $item->name }}</span>
                <span class="badge bg-secondary">{{ $item->days }} days</span>
            </span>
        </div>
    @endforeach
@else
    <div class="alert alert-info text-center">
        <i class="bi bi-info-circle me-1"></i> No items to sort.
    </div>
@endif
