@extends("layouts.{$page->type}")

@section('title', $page->title)

@section('content')

    @if($page->type == \App\Models\Page::TYPE_FRONT && $page->img)
        <section class="section our-process-banner-section">
            <img src="{{ page_img_url($page->img) }}" alt="banner img">
        </section>
    @endif

    @if($page->show_subject && !empty($page->subject))
        <section class="section section-leadership-tools mobile-hide" style="padding-bottom: 0">
            <div class="wrapper-container">

                <h1 class="title-section" style="margin-bottom: 0">{{ $page->subject }}</h1>

            </div>
        </section>
	@endif

    @forelse($page->activeBlocks as $block)
        {!! $pageService->renderBlock($block) !!}
    @empty
        <p style="margin: 250px 0; text-align: center; font-size: 2.5rem">There is no content on page yet</p>
    @endforelse

@endsection
