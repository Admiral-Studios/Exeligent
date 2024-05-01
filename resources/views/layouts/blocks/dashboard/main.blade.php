@section('body-class', 'dashboard-new-part')

<div class="dashboard-first">
    <div class="dashboard-part-top">
        <div class="title">
            {{ $block->title ?? 'Profile Summary' }}
        </div>
        <button class="btn btn-blue" id="btnSeeFullOverview">See Full Overview</button>
    </div>

    @php
        $custom_forms = Auth::user()->forms;
        $form_pages = App\Models\Page::whereHas('activeForms')->with('activeForms')->get();
    @endphp

    @foreach($form_pages as $form_page)
        @php($is_user_has_values_for_page = $form_page->activeForms->isNotEmpty() && \App\Services\FormService::userHasSomeForms($form_page->activeForms->pluck('id')))
        <div class="dashboard-part-content">
            <div class="dropdown-item @if(!$is_user_has_values_for_page) not-started @endif">
                <div class="dropdown-item-head">
                    <div class="name">
                        @if($form_page->img)
                            <img src="{{ page_img_url($form_page->img) }}" alt="">
                        @endif
                        {{ $form_page->subject }}
                    </div>
                    <div class="progress-section">
                        <div class="a-progress-bar" data-form="formBlock6">
                            <div class="progress">
                                <div class="bar" style="width: {{ $form_page->getFormsPassTotalPercentage() }}%;"></div>
                            </div>
                            <div class="a-progress-bar-percent inter fw-medium fz-012">
                                <span class="count">{{ $form_page->getFormsPassTotalPercentage() }}</span>%
                            </div>
                        </div>

                        @if($is_user_has_values_for_page)
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <path
                                    d="M19.9201 8.9502L13.4001 15.4702C12.6301 16.2402 11.3701 16.2402 10.6001 15.4702L4.08008 8.9502"
                                    stroke="#2C3659" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>
                        @else
                            <a class="btn btn-blue" href="{{ route('page', $form_page) }}">Let’s start</a>
                        @endif
                    </div>
                </div>

                <div class="dropdown-item-content">

                    @if($is_user_has_values_for_page)

                        @foreach($form_page->activeForms as $form)
                            @php($formService = \App\Services\FormService::create($form))
                            @continue($formService->isEmpty())
                            <div class="decor-border"></div>

                            <div class="overview-section">
                                <div class="overview-title">
                                    <div class="title">{{ $form->title }}</div>
                                    <button class="copy-button" data-text="{{ $formService }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none">
                                            <path
                                                d="M20.25 3H8.25C8.05109 3 7.86032 3.07902 7.71967 3.21967C7.57902 3.36032 7.5 3.55109 7.5 3.75V7.5H3.75C3.55109 7.5 3.36032 7.57902 3.21967 7.71967C3.07902 7.86032 3 8.05109 3 8.25V20.25C3 20.4489 3.07902 20.6397 3.21967 20.7803C3.36032 20.921 3.55109 21 3.75 21H15.75C15.9489 21 16.1397 20.921 16.2803 20.7803C16.421 20.6397 16.5 20.4489 16.5 20.25V16.5H20.25C20.4489 16.5 20.6397 16.421 20.7803 16.2803C20.921 16.1397 21 15.9489 21 15.75V3.75C21 3.55109 20.921 3.36032 20.7803 3.21967C20.6397 3.07902 20.4489 3 20.25 3ZM15 19.5H4.5V9H15V19.5ZM19.5 15H16.5V8.25C16.5 8.05109 16.421 7.86032 16.2803 7.71967C16.1397 7.57902 15.9489 7.5 15.75 7.5H9V4.5H19.5V15Z"
                                                fill="#8599AD"/>
                                        </svg>
                                    </button>
                                </div>
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
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    @endforeach

    @php($counts = (new \App\Services\NetworkingService())->getFunnelCounts())
    <div class="dashboard-part-content networking">
        <div class="title">Networking Funnel</div>
        <ul class="networking-list">
            <li>
                <a href="{{ route('page', ['networking', 'tab' => 'tab1']) }}">
                    <span class="name">contacts total</span>
                    <span class="count">{{ $counts['all'] }}</span>
                </a>
            </li>
            @foreach(\App\Enums\ContactStatusEnum::cases() as $case)
                <li>
                    <a href="{{ route('page', ['networking', \App\Services\NetworkingService::FUNNEL_PREFIX . 'status' => $case->value, 'tab' => 'tab1']) }}">
                        <span class="name">{{ $case->getTitle() }}</span>
                        <span class="count">{{ $counts[$case->value] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="dashboard-second hide">
    <div class="dashboard-part-top">
        <div class="title">
            <svg class="back-button" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                 fill="none">
                <path d="M11.4375 18.75L4.6875 12L11.4375 5.25M5.625 12H19.3125" stroke="black" stroke-width="2.25"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{ $block->sub_title ?? 'Full Overview' }}
        </div>
        <a href="{{ route('user.dashboard.export') }}" class="btn btn-blue">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path
                    d="M7.56023 8.90039C3.96023 9.21039 2.49023 11.0604 2.49023 15.1104V15.2404C2.49023 19.7104 4.28023 21.5004 8.75023 21.5004H15.2702C19.7402 21.5004 21.5302 19.7104 21.5302 15.2404V15.1104C21.5302 11.0904 20.0802 9.24039 16.5402 8.91039"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 15.0001V3.62012" stroke="white" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round"/>
                <path d="M8.65039 5.85L12.0004 2.5L15.3504 5.85" stroke="white" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Export all to PDF
        </a>
    </div>


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

<div class="a-modal welcome-modal" id="welcomeModal">
    <div class="a-modal__wrapper">
        <div class="a-modal__header">
            <div class="title">Your Path to Success in a Snapshot:</div>
            <div class="description">
                <p>Embark on your journey to career excellence with CareerCompany.com's streamlined 3-step process.</p>
                <p>First, understand your aspirations through a detailed self-assessment. Then, connect with
                    industry-leading recruiters in your field and location through our Executive Search. Finally, build
                    and execute a robust networking plan with our specialized tools. </p>
                <p>This cohesive approach is designed to provide clarity, focus, and strategic direction, paving your
                    way to landing your dream job. Let's get started!</p>
            </div>
        </div>
        <div class="a-modal__body">
            <ul class="welcome-modal-steps">
                <li class="welcome-modal-step">
                    <div class="subtitle">Step 1</div>
                    <hr>
                    <div class="content">
                        <div class="title">Self-Assessment & Career Direction</div>
                        <div class="description">
                            Begin with self-reflection. Understand your strengths, passions, and where you see yourself
                            in
                            the future. Our platform helps you define your career direction with insightful assessments
                            and
                            guidance tailored just for you.
                        </div>
                    </div>
                </li>
                <li class="welcome-modal-step">
                    <div class="subtitle">Step 2</div>
                    <hr>
                    <div class="content">
                        <div class="title">Find the Right Recruiters</div>
                        <div class="description">
                            Navigate to our Executive Search section to connect with recruiters who specialize in your
                            industry and function, and are located near you. Our curated list ensures you find the best
                            match for your career ambitions.
                        </div>
                    </div>
                </li>
                <li class="welcome-modal-step">
                    <div class="subtitle">Step 3</div>
                    <hr>
                    <div class="content">
                        <div class="title">Craft Your Networking Plan</div>
                        <div class="description">
                            Your network is your net worth. Dive into our Networking section to identify key individuals
                            you'd like to connect with. We'll help you devise a strategic plan to build and nurture
                            these
                            valuable connections.
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="a-modal__footer">
            <button type="button" class="button-clear modal-close">Go to the Dashboard</button>
            <button type="submit" class="button-blue" id="startBtn">Let’s start</button>
        </div>
    </div>
</div>

<div class="overlay-modal"></div>

<?php
$user_old = \App\Models\User::isOldUser();
?>

@push('scripts')
    <script src="{{ asset('js/dashboard.js') }}"></script>

    <script>
        let welcomeModal = document.querySelector('#welcomeModal'),
            overlayModal = document.querySelector('.overlay-modal'),
            modalClose = document.querySelector('.modal-close'),
            startBtn = document.querySelector('#startBtn'),

            userOld = <?php echo json_encode($user_old); ?>;

        if (!userOld && !localStorage.getItem('modalClosed')) {
            welcomeModal.classList.add('active');
            overlayModal.classList.add('active');
        }

        startBtn.addEventListener('click', function () {
            closeWelcomeModal();
        });

        modalClose.addEventListener('click', function () {
            closeWelcomeModal();
        });

        function closeWelcomeModal() {
            welcomeModal.classList.remove('active');
            overlayModal.classList.remove('active');
            localStorage.setItem('modalClosed', true);
        }
    </script>
@endpush

