@extends('layouts.user')

@section('title', 'Dashboard | ' . config('app.name'))

@section('content')

    <div class="tab-menu">
        <ul class="tab-menu-list flex">
            <li><a href="#" class="tab-a active-a" data-id="tab1">Overview</a></li>
        </ul>

        <h1 class="tab-menu-mobile-title fz-024 neue-bold">Overview</h1>
    </div>

    <div class="tab tab-active tab-dashboard" data-id="tab1">

        @foreach($form_pages as $form_page)
            <div class="section-dashboard">
                <div class="section-dashboard-title js-accordion">
                    <h2>{{ $form_page->subject }}</h2>
                </div>

                <div class="section-dashboard-content flex flow-column js-content">
                    @if($form_page->activeForms->isNotEmpty() && \App\Services\FormService::userHasSomeForms($form_page->activeForms->pluck('id')))

                        @foreach($form_page->activeForms as $form)
                            @php($formService = \App\Services\FormService::create($form))
                            @if($formService->isNotEmpty())
                                <div class="content-item" style="padding-bottom: 30px">
                                    <h4 class="content-title fw-bold fz-020">{{ $form->title }}</h4>
                                    <ul class="info-list flex">
                                        @foreach($form->fields as $field)
                                            @if($formService->getFieldValuesCount($field->id) > 0)
                                                <li>
                                                    <div class="info-title">{{ $field->title }}</div>
                                                    <div class="info-data">{!! implode(', ', $formService->getFieldValues($field->id, $field->type)) !!}</div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach

                    @else
                        <h3>No values... Go to <a href="{{ route('page', $form_page) }}">{{ $form_page->subject }} page</a> to fill</h3>
                    @endif
                </div>
            </div>
        @endforeach

    </div>

@endsection
