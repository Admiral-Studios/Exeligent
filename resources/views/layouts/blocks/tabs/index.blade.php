@if($block->tabs->isNotEmpty())

    <section class="tabs">
        <div @if($block->page->type == \App\Models\Page::TYPE_FRONT) class="wrapper-container" @endif>
            <div class="dashboard-mobile-start-page">
                @if($block->title || $block->sub_title)
                    <div class="section-dashboard-title flex flex-between">
                        <div class="title-box flex flow-column">
                            @if($block->title)
                                <h2 class="text-center">{{ $block->title }}</h2>
                            @endif
                            @if($block->sub_title)
                                <p class="inter fw-regular fz-012 dark text-center">{{ $block->sub_title }}</p>
                            @endif
                        </div>
                    </div>
                @endif

                <ul class="tabs-mobile-list flex flow-column">
                    @foreach($block->activeTabs as $tab)
                        @continue(!$tab->blocks->first())
                        <li class="flex align-center" data-tab-mobile="tab-{{ $block->id . ':' . $tab->id }}">
                            @if($tab->blocks->first()->template->name === 'form.index')
                                <div class="info flex flow-column">
                                    <div class="title">{{ $tab->title }}</div>
                                    @php($form = $tab->blocks->first()->model)
                                    @if($form)
                                        <div>
                                            <div class="a-progress-bar" data-form="formBlock{{ $form->id }}">
                                                <div class="a-progress-bar-percent inter fw-medium fz-012"><span
                                                        class="count">0</span>%
                                                    <span>done</span>
                                                </div>
                                                <div class="progress">
                                                    <div class="bar" style="width: 0;"></div>
                                                </div>
                                            </div>
                                            <span class="not-started">Not started yet.</span>
                                        </div>
                                    @endif
                                </div>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.1714 12.0007L8.22168 7.05093L9.63589 5.63672L15.9999 12.0007L9.63589 18.3646L8.22168 16.9504L13.1714 12.0007Z"
                                        fill="black"/>
                                </svg>
                            @else
                                <div class="info flex flow-column">
                                    <div class="flex align-center flex-between">
                                        <div class="title">{{ $tab->title }}</div>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.1714 12.0007L8.22168 7.05093L9.63589 5.63672L15.9999 12.0007L9.63589 18.3646L8.22168 16.9504L13.1714 12.0007Z"
                                                fill="black"/>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-menu">
                <ul class="tab-menu-list flex">
                    @foreach($block->activeTabs as $tab)
                        <li @if($tab->is_highlighted) class="story" @endif>
                            <a href="#" class="tab-a @if($loop->first) active-a @endif"
                               data-id="tab-{{ $block->id . ':' . $tab->id }}">
                                @if($tab->is_highlighted)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                        <path d="M14.3844 4.90897L11.5913 2.11647C11.3568 1.88213 11.039 1.75049 10.7075 1.75049C10.376 1.75049 10.0582 1.88213 9.82375 2.11647L2.11625 9.82335C1.99978 9.9391 1.90744 10.0768 1.84457 10.2285C1.7817 10.3802 1.74956 10.5429 1.75 10.7071V13.5002C1.75 13.8317 1.8817 14.1497 2.11612 14.3841C2.35054 14.6185 2.66848 14.7502 3 14.7502H5.79313C5.95735 14.7507 6.12002 14.7186 6.27173 14.6557C6.42343 14.5928 6.56114 14.5005 6.67688 14.384L11.6431 9.41835L11.9031 10.2865L9.72001 12.4696C9.57911 12.6105 9.49995 12.8016 9.49995 13.0008C9.49995 13.2001 9.57911 13.3912 9.72001 13.5321C9.8609 13.673 10.052 13.7521 10.2513 13.7521C10.4505 13.7521 10.6416 13.673 10.7825 13.5321L13.2825 11.0321C13.3782 10.9362 13.4462 10.8162 13.4792 10.6848C13.5123 10.5535 13.5091 10.4156 13.47 10.2858L12.8488 8.21522L14.3856 6.67835C14.5019 6.56216 14.594 6.4242 14.6569 6.27235C14.7197 6.1205 14.752 5.95774 14.7519 5.7934C14.7518 5.62906 14.7193 5.46635 14.6562 5.31459C14.5932 5.16283 14.5008 5.02499 14.3844 4.90897ZM4.0625 10.0002L8.5 5.56272L10.9375 8.00022L6.5 12.4377L4.0625 10.0002ZM3.25 11.3127L5.1875 13.2502H3.25V11.3127ZM12 6.93772L9.5625 4.50022L10.7088 3.35397L13.1463 5.79147L12 6.93772Z" fill="#027FFE"></path>
                                    </svg>
                                @endif
                                {{ $tab->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="wrapper-leadership">
                @foreach($block->activeTabs as $tab)
                    <div class="tab @if($loop->first) active @endif" data-id="tab-{{ $block->id . ':' . $tab->id }}">
                        @foreach($tab->activeBlocks as $sub_block)
                            <div class="btn-back-tabs flex align-center fw-medium fz-016">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.02302 10.0006L13.1478 14.1253L11.9693 15.3038L6.66602 10.0006L11.9693 4.69727L13.1478 5.87577L9.02302 10.0006Z"
                                        fill="black"></path>
                                </svg>
                                Back
                            </div>
                            {!! $pageService->renderBlock($sub_block) !!}
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endif
