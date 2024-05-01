<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="New approach for job finding.">
</head>

<style>
    /* Reset */
    body {
        height: 100%;
        margin: 0;
    }

    html {
        box-sizing: border-box;
        margin: 0;
        height: 100%;
    }

    *,
    *::after,
    *::before {
        box-sizing: inherit;
    }

    ul, ol {
        padding: 0;
    }

    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    ul,
    ol,
    li,
    figure,
    figcaption,
    blockquote,
    dl,
    dd {
        margin: 0;
        font-size: inherit;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    img {
        max-width: 100%;
        display: block;
    }

    input,
    button,
    textarea,
    select {
        font: inherit;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    button {
        border: unset;
        background-color: transparent;
        cursor: pointer;
    }

    body {
        background: #F5F6F9;
        padding: 20px;
        overflow-x: hidden;
    }

    .copy-button {
        display: none;
    }

    .dashboard-second {
        display: -webkit-box;
        display: flex;
        flex-flow: column;
    }

    .section-dashboard {
        width: 100%;
        border-radius: 8px;
        background: #FFF;
        border: none;
        padding: 24px 32px;
    }

    .section-dashboard + .section-dashboard {
        margin-top: 24px;
    }

    .dashboard-new-part .section-dashboard .section-dashboard-title h2, .dashboard-part .section-dashboard .section-dashboard-title h2 {
        font-family: "Inter", sans-serif;
        font-weight: 600;
        font-size: 24px;
        line-height: 29px;
        color: #000000;
        margin-bottom: 32px;
    }

    .dashboard-new-part .overview-content, .dashboard-part .overview-content {
        display: flex;
        flex-flow: column;
        gap: 24px;
    }

    .dashboard-new-part .overview-content-item, .dashboard-part .overview-content-item {
        margin-bottom: 24px;
    }

    .overview-content-item .title, .dashboard-part .overview-content-item .title {
        color: #14191F;
        font-family: "Inter", sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 28px;
        margin-bottom: 16px;
        padding-bottom: 16px;
        display: flex;
        display: -webkit-flex;
    }

    .dashboard-new-part .overview-content-item .list li, .dashboard-part .overview-content-item .list li {
        color: #004C99;
        font-family: "Inter", sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 28px;
        padding: 10px !important;
        border-radius: 6px;
        border: 1px solid #C2CCD6;
        background: #FFF;
        width: fit-content;
        height: fit-content;
        display: inline-block;
        margin-bottom: 16px;
        margin-right: 16px;
    }
</style>

<body class="dashboard-parts dashboard-part dashboard-new-part">
<main>
    <div class="wrapper-dashboard">
        <div class="dashboard-second">
            @foreach($form_pages as $form_page)
                @php($is_user_has_values_for_page = $form_page->activeForms->isNotEmpty() && \App\Services\FormService::userHasSomeForms($form_page->activeForms->pluck('id')))
                @foreach($form_page->activeForms as $form)
                    @php($formService = \App\Services\FormService::create($form))
                    @continue($formService->isEmpty())
                    <div class="section-dashboard">

                        <div class="section-dashboard-title border-none flex flex-between">
                            <h2>{{ $form->title }}</h2>
                            <button class="copy-button" data-text="{{ $formService }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <path
                                        d="M20.25 3H8.25C8.05109 3 7.86032 3.07902 7.71967 3.21967C7.57902 3.36032 7.5 3.55109 7.5 3.75V7.5H3.75C3.55109 7.5 3.36032 7.57902 3.21967 7.71967C3.07902 7.86032 3 8.05109 3 8.25V20.25C3 20.4489 3.07902 20.6397 3.21967 20.7803C3.36032 20.921 3.55109 21 3.75 21H15.75C15.9489 21 16.1397 20.921 16.2803 20.7803C16.421 20.6397 16.5 20.4489 16.5 20.25V16.5H20.25C20.4489 16.5 20.6397 16.421 20.7803 16.2803C20.921 16.1397 21 15.9489 21 15.75V3.75C21 3.55109 20.921 3.36032 20.7803 3.21967C20.6397 3.07902 20.4489 3 20.25 3ZM15 19.5H4.5V9H15V19.5ZM19.5 15H16.5V8.25C16.5 8.05109 16.421 7.86032 16.2803 7.71967C16.1397 7.57902 15.9489 7.5 15.75 7.5H9V4.5H19.5V15Z"
                                        fill="#8599AD"/>
                                </svg>
                            </button>
                        </div>
                        <div class="section-dashboard-content">
                            <div class="overview-content">
                                @foreach($form->rows as $row)
                                    @foreach($row->fields as $field)
                                        @if($formService->getFieldValuesCount($field->id) > 0)
                                            <div class="overview-content-item">
                                                <div class="title">{{ $field->title }}</div>
                                                <ul class="list">
                                                    @foreach($formService->getFieldValues($field->id, $field->type) as $field_value)
                                                        <li>{!! $field_value !!}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>

                @endforeach
            @endforeach
        </div>
    </div>
</main>
</body>
</html>
