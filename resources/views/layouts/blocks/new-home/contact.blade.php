<div class="section contact-form-section">
    <div class="wrapper-container">
        <div class="contact-form">
            @if($block->title)
                <h2 class="section-title">{{ $block->title }}</h2>
            @endif
            @if($block->sub_title)
                <p class="section-subtitle">{{ $block->sub_title }}</p>
            @endif

            <div class="contact-form__wrapper flex align-center">
                <form class="form" action="{{ route('contact-request.store') }}" method="post">
                    @csrf
                    <h3 class="form-title">Contact form</h3>
                    <div class="input-box flex flow-column">
                        <label for="contactRequestName">Your Name</label>
                        <input id="contactRequestName" name="name" type="text" placeholder="Input Your Name" required>
                    </div>
                    <div class="input-box flex flow-column">
                        <label for="contactRequestEmail">Your Emails</label>
                        <input id="contactRequestEmail" name="email" type="email" placeholder="Input Your Email" required>
                    </div>
                    <div class="input-box flex flow-column">
                        <label for="contactRequestMessage">Your Message</label>
                        <textarea name="message" id="contactRequestMessage" placeholder="How We Can Help You?" required></textarea>
                    </div>
                    <div class="input-box flex flow-column">
                        <button type="submit" class="btn btn-black" style="margin: auto">Submit</button>
                    </div>
                </form>

                @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
                    <div class="logo">
                        <img width="679" height="253" src="{{ page_img_url($block->additional_content['img']) }}" alt="logo">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
