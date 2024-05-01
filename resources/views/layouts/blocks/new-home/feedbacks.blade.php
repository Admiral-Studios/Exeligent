<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<div class="section review-section">
    <div class="wrapper-container">
        @if($block->title)
            <h2 class="section-title">{!! $block->title_html !!}</h2>
        @endif
            @if($block->additional_content instanceof \Illuminate\Support\Collection)
                <div class="review">
                    <ul class="review__list flex">
                        @foreach($block->additional_content as $item)
                        <li class="review__list-item">
                            <div class="profile flex align-center">
                                <div class="profile-info flex align-center">
                                    <img width="56" height="56" src="{{ isset($item['img']) ? page_img_url($item['img']) : '' }}" alt="avatar">
                                    <div class="info">
                                        <div class="name">{{ $item['subject'] ?? '' }}</div>
                                        <div class="position">{{ $item['sub_title'] ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment">{!! $item['content'] ?? '' !!}</div>
                            <div class="stars flex align-center">
                                <ul class="stars__list flex align-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <li class="stars__list-item">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.76699 29.3333L9.93366 19.9667L2.66699 13.6667L12.267 12.8333L16.0003 4L19.7337 12.8333L29.3337 13.6667L22.067 19.9667L24.2337 29.3333L16.0003 24.3667L7.76699 29.3333Z"
                                                    fill="{{ ($item['rating'] ?? 0) >= $i ? 'orange' : '#969696' }}"/>
                                            </svg>
                                        </li>
                                    @endfor
                                </ul>
                                <div class="stars__text"><span>{{ $item['rating'] ?? 0 }}</span>.0</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="swiper swiper-review">
                    <div class="swiper-wrapper">
                        @foreach($block->additional_content as $item)
                        <div class="swiper-slide">
                            <div class="profile flex align-center">
                                <div class="profile-info flex align-center">
                                    <img width="56" height="56" src="{{ isset($item['img']) ? page_img_url($item['img']) : '' }}" alt="avatar">
                                    <div class="info">
                                        <div class="name">{{ $item['subject'] ?? '' }}</div>
                                        <div class="position">{{ $item['sub_title'] ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment">{!! $item['content'] ?? '' !!}</div>
                            <div class="stars flex align-center">
                                <ul class="stars__list flex align-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <li class="stars__list-item">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.76699 29.3333L9.93366 19.9667L2.66699 13.6667L12.267 12.8333L16.0003 4L19.7337 12.8333L29.3337 13.6667L22.067 19.9667L24.2337 29.3333L16.0003 24.3667L7.76699 29.3333Z"
                                                    fill="{{ ($item['rating'] ?? 0) >= $i ? 'orange' : '#969696' }}"/>
                                            </svg>
                                        </li>
                                    @endfor
                                </ul>
                                <div class="stars__text"><span>{{ $item['rating'] ?? 0 }}</span>.0</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-review-buttons">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            @endif
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiperReview = new Swiper('.swiper-review', {
        direction: 'horizontal',
        loop: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        spaceBetween: 20,

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

