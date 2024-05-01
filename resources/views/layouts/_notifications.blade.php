@if(session()->get('success'))
    <div class="notification-section success">
        <p>{{ session()->get('success') }}</p>
    </div>
@endif

@if(session()->get('error'))
    <div class="notification-section error">
        <p>{{ session()->get('error') }}</p>
    </div>
@endif

@if(session()->get('status'))
    <div class="notification-section success">
        <p>{{ session()->get('status') }}</p>
    </div>
@endif

{{--@if ($errors->any())--}}
{{--    <div class="notification-section error">--}}
{{--        @foreach ($errors->all() as $error)--}}
{{--            <p>{{ $error }}</p>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--@endif--}}
