<div class="section-dashboard section-dashboard-leadership tab-page">
    <div class="section-dashboard-title flex flow-column">
        @if($block->title)
            <h2>{{ $block->title }}</h2>
        @endif
        @if($block->sub_title)
            <p class="inter fw-regular fz-012 dark">{{ $block->sub_title }}</p>
        @endif
    </div>

    <div class="section-dashboard-content flex flow-column">
        <div class="content-item">
            @if($block->additional_content instanceof \Illuminate\Support\Collection)

                <div class="leadership-list flex flow-column">

                    @if(isset($block->additional_content['label']))

{{--                        <div class="leadership-title-box flex align-center flex-between">--}}
{{--                            <div--}}
{{--                                class="title neue-bold fz-016 dark">{{ $block->additional_content['label'] ?? '' }}</div>--}}
{{--                            <div--}}
{{--                                class="title neue-bold fz-016 dark">{{ $block->additional_content['label'] ?? '' }}</div>--}}
{{--                        </div>--}}

                    @endif

                    @if(isset($block->additional_content['content']))

                        @if($block->additional_content['content'] == \App\Models\LeadershipTool::TYPE_BOOK)
                            <div class="leadership-list-section-box" style="display: grid;
    grid-template-columns: repeat( auto-fit, minmax(160px, 1fr) );
    gap: 30px;">
                                @forelse(\App\Services\LeadershipToolsService::getToolsByType($block->additional_content['content']) as $leadershipTool)
                                    <div style="text-align: center">
                                        {!! $leadershipTool->description !!}
                                        <span
                                            style="overflow: hidden; display: block; margin-top: 6px">{{ $leadershipTool->title }}</span>
                                    </div>
                                @empty
                                    <p style="text-align: center">There is no tools available</p>
                                @endforelse
                            </div>
                        @else
                            <div class="leadership-list-section-box">
                                    @forelse(\App\Services\LeadershipToolsService::getToolsByType($block->additional_content['content']) as $leadershipTool)
                                        <div class="section-dashboard-content flex flow-column">
                                            <div class="content-item">

                                                <div class="leadership-show">
                                                    <div class="leadership-info flex align-center">
                                                        @if($leadershipTool->type == \App\Models\LeadershipTool::TYPE_CONTENT)
                                                            <div class="content-recommendation-section">
                                                                <h4 class="title neue-bold dark fz-018">{{ $leadershipTool->title }}</h4>
                                                                <p class="description inter fw-regular fz-012 dark">{!! $leadershipTool->description !!}</p>
                                                                <h4 class="title neue-bold dark fz-016">Website Link:</h4>
                                                                <a class="link-site dark inter fz-016 fw-regular tool-link" target="_blank"
                                                                   href="{{ $leadershipTool->link }}">{{ $leadershipTool->link }}</a>
                                                            </div>
                                                        @else
                                                            <div class="info">
                                                                <div class="title-section flex align-center flex-between">
                                                                    <h3 class="title neue-bold fz-018 dark">{{ $leadershipTool->title }}</h3>
                                                                    <span class="author dark neue-medium fz-018"></span>
                                                                </div>
                                                                <img class="image-book-mob" src="{{ leadership_tool_img_url($leadershipTool->img) }}" alt="book img">
                                                                <div
                                                                    class="description inter fw-regular fz-012 dark">{!! $leadershipTool->description !!}</div>
                                                                <a class="btn btn-black tool-link" target="_blank"
                                                                   href="{{ $leadershipTool->link }}">Visit official website</a>
                                                            </div>
                                                            <div class="image-book">
                                                                <img src="{{ leadership_tool_img_url($leadershipTool->img) }}" alt="book img">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        @if(!$loop->last)
                                        <hr style="margin: 15px">
                                        @endif
                                    @empty
                                        <p style="text-align: center">There is no tools available</p>
                                    @endforelse
                            </div>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
