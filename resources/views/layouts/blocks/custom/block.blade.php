<div class="section-dashboard section-dashboard-interviews">
    <div class="section-dashboard-title flex flow-column">
        <h2>{{ $block->title }}</h2>
        <div class="inter fw-regular fz-012 dark">{{ $block->sub_title }}</div>
    </div>

    <div class="section-dashboard-content flex flow-column">
        {!! $block->content !!}
    </div>
</div>
