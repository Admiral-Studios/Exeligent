@extends('layouts.front')

@section('title', $leadershipTool->title . ' | Leadership Tools | ' . config('app.name'))

@section('content')

    <section class="section section-leadership-tools" style="padding-top: 100px">
        <div class="wrapper-container">

            <a class="btn-back-tabs show flex align-center fw-medium fz-016"
               href="{{ url()->previous() }}">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.02302 10.0006L13.1478 14.1253L11.9693 15.3038L6.66602 10.0006L11.9693 4.69727L13.1478 5.87577L9.02302 10.0006Z"
                        fill="black"></path>
                </svg>
                Back
            </a>

            <div class="section-dashboard section-dashboard-leadership tab-page mobile-show">

{{--                <div class="section-dashboard-title flex flow-column">--}}
{{--                    @if($block->title)--}}
{{--                        <h2>{{ $block->title }}</h2>--}}
{{--                    @endif--}}
{{--                    @if($block->sub_title)--}}
{{--                        <p class="inter fw-regular fz-012 dark">{{ $block->sub_title }}</p>--}}
{{--                    @endif--}}
{{--                </div>--}}

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/leadership-tools.js') }}"></script>
@endpush
