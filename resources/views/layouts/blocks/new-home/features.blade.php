<div class="section info-list-section">
    <div class="wrapper-container">
        @if($block->additional_content instanceof \Illuminate\Support\Collection)
            <ul class="info-list">
                @foreach($block->additional_content as $item)
                <li class="info-list-item">
                    @if(isset($item['img']))
                        <img src="{{ page_img_url($item['img']) }}">
                    @endif
                    {{ $item['subject'] }}
                </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
