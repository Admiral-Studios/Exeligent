<section class="section section-key-features">
    <div class="wrapper-container" style="padding-bottom: ">

        @if($block->title)
            <h3 class="title-blocks neue-bold fz-040 dark">{{ $block->title }}</h3>
        @endif

        @if($block->additional_content instanceof \Illuminate\Support\Collection)
            <ul class="section-key-features-list flex">
                @foreach($block->additional_content as $item)
                    @if(!empty($item))
                        <li class="section-key-features-item flex flow-column align-center justify-center">
                            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_206_6431)">
                                    <path
                                        d="M26.667 40.4585L51.179 15.9438L54.9523 19.7145L26.667 47.9998L9.69629 31.0292L13.467 27.2585L26.667 40.4585Z"
                                        fill="#B3C2FF"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_206_6431">
                                        <rect width="64" height="64" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <div class="description inter fw-medium fz-024 black">{{ $item }}</div>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif

    </div>
</section>
