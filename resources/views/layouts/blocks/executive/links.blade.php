<div class="search-filters">
    @if($block->title)
    <div class="title big">{{ $block->title }}</div>
    @endif
        @if($block->additional_content instanceof \Illuminate\Support\Collection)
    <ul class="filters">
        @foreach($block->additional_content as $button)
        <li class="filter choose" onclick="location.href = '{{ $button['url'] }}'">{{ $button['title'] }}</li>
        @endforeach
    </ul>
        @endif
</div>
