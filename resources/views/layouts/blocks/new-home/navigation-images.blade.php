@php($left_align = isset($block->additional_content['img_align']) && $block->additional_content['img_align'] == 'left')
<div class="section info-img-section @if($left_align) left-img @endif">
    <div class="wrapper-container">
        <div class="info-img-wrapper flex align-center">
            @if($left_align)
                @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
                    <div class="image">
                        <img width="470" height="430" src="{{ page_img_url($block->additional_content['img']) }}"
                             alt="image">
                    </div>
                @endif
            @endif
            <div class="info">
                @if($block->title)
                    <div class="title">{!! $block->title_html !!}</div>
                @endif
                @if($block->content)
                    <div class="description">{!! $block->content !!}</div>
                @endif

                @if($block->additional_content instanceof \Illuminate\Support\Collection)
                    <ul class="list">
                        @foreach($block->additional_content as $i => $item)
                            @continue(in_array($i, ['img', 'img_align']))
                            <li class="list-item flex align-center">
                                @if($loop->first && $left_align)
                                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.75 25.5L25.75 16.5L16.75 7.5M24.5 16.5H6.25" stroke="#5C5E5F"
                                              stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @endif
                                <span>{{ $item }}</span>
                                @if($loop->first && !$left_align)
                                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.75 25.5L25.75 16.5L16.75 7.5M24.5 16.5H6.25" stroke="#5C5E5F"
                                              stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
                @if(!$left_align)
                    @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
                        <div class="image">
                            <img width="470" height="430" src="{{ page_img_url($block->additional_content['img']) }}"
                                 alt="image">
                        </div>
                    @endif
                @endif
        </div>
    </div>
</div>
