<section class="section steps-section">
    <div class="wrapper-container">

        @if($block->title)
            <h1 class="steps-section-title fw-bold fz-064 neue-bold">{{ $block->title }}</h1>
        @endif

        @if($block->content)
            <div class="description-section">{!! $block->content !!}</div>
        @endif

    </div>

    @if($block->additional_content instanceof \Illuminate\Support\Collection)
        <div class="wrapper-container">
            <div class="steps-section-wrapper">
                <div class="decoration-section-first"></div>
                <div class="decoration-section-second"></div>
                <ul class="steps-section-list">
                    @foreach($block->additional_content as $item)
                        <li class="steps-section-item flex flow-column">
                            <div
                                class="decoration sf-bold fz-178">{{ str_pad($loop->iteration, 2, 0, STR_PAD_LEFT) }}</div>
                            <h4 class="title inter fw-semibold fz-032 dark">{{ $item['subject'] ?? '' }}</h4>
                            <div class="description inter fw-medium fz-024 black">{!! $item['content'] ?? '' !!}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

</section>
