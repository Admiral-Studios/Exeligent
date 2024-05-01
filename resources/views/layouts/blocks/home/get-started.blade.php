<section class="section get-started-section">
    <div class="wrapper-container">
        <div class="get-started-section-wrapper flex align-center">
            <div class="get-started-section-info">
                @if($block->title)
                <h2 class="title-section">{{ $block->title }}</h2>
                @endif
                @if($block->content)
                <div class="description-section">{!! $block->content !!}</div>
                    @endif

                <form action="{{ route('register') }}" method="GET">
                    <div class="a-inputs-container flex">
                        <input class="a-input" type="text" name="first_name" placeholder="First Name *" required>
                        <input class="a-input" type="text" name="last_name" placeholder="Last Name *" required>
                    </div>
                    <input class="a-input" type="email" name="email" placeholder="Email *" required>
                    <input class="a-input" type="text" name="position" placeholder="Job Title *" required>
                    <button class="btn btn-black fz-024" type="submit">Get Started</button>
                </form>
            </div>

            @if($block->additional_content instanceof \Illuminate\Support\Collection)
            <div class="get-started-section-image">
                <img src="{{ isset($block->additional_content['img']) ? page_img_url($block->additional_content['img']) : '' }}" alt="img" loading="lazy">
            </div>
            @endif
        </div>
    </div>
</section>
