@extends("layouts.user")

@section('title', 'New Dashboard')

@section('content')
    <div class="dashboard-first">
        <div class="dashboard-part-top">
            <div class="title">
                Profile Summary
            </div>
            <button class="btn btn-blue" id="btnSeeFullOverview">See Full Overview</button>
        </div>

        <div class="dashboard-part-content">
            <div class="dropdown-item">
                <div class="dropdown-item-head">
                    <div class="name">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path
                                d="M16 27.3523C15.6583 27.3523 15.3289 27.2285 15.0722 27.0037C14.1027 26.1559 13.1679 25.3592 12.3432 24.6564L12.339 24.6528C9.92108 22.5923 7.83313 20.8129 6.38037 19.06C4.75641 17.1004 4 15.2424 4 13.2127C4 11.2407 4.67621 9.42133 5.90393 8.0896C7.1463 6.74213 8.85101 6 10.7046 6C12.09 6 13.3587 6.43799 14.4755 7.3017C14.6917 7.46894 14.9001 7.65055 15.1003 7.84603C15.5877 8.32185 16.4123 8.32189 16.8997 7.84607C17.1 7.65058 17.3084 7.46895 17.5247 7.3017C18.6415 6.43799 19.9102 6 21.2956 6C23.149 6 24.8539 6.74213 26.0963 8.0896C27.324 9.42133 28 11.2407 28 13.2127C28 15.2424 27.2438 17.1004 25.6198 19.0598C24.1671 20.8129 22.0793 22.5921 19.6617 24.6524C18.8356 25.3563 17.8994 26.1542 16.9276 27.004C16.6711 27.2285 16.3415 27.3523 16 27.3523Z"
                                fill="url(#paint0_linear_1858_11746)"/>
                            <defs>
                                <linearGradient id="paint0_linear_1858_11746" x1="4" y1="6" x2="25.2072" y2="29.837"
                                                gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#0075FF"/>
                                    <stop offset="1" stop-color="#7CB2F4"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        Self Assessment
                    </div>
                    <div class="progress-section">
                        <div class="a-progress-bar" data-form="formBlock6">
                            <div class="progress">
                                <div class="bar" style="width: 20%;"></div>
                            </div>
                            <div class="a-progress-bar-percent inter fw-medium fz-012">
                                <span class="count">0</span>%
                            </div>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M19.9201 8.9502L13.4001 15.4702C12.6301 16.2402 11.3701 16.2402 10.6001 15.4702L4.08008 8.9502"
                                stroke="#2C3659" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <div class="dropdown-item-content">
                    <div class="decor-border"></div>

                    <div class="overview-section">
                        <div class="overview-title">
                            <div class="title">My Values</div>
                            <button class="copy-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <path
                                        d="M20.25 3H8.25C8.05109 3 7.86032 3.07902 7.71967 3.21967C7.57902 3.36032 7.5 3.55109 7.5 3.75V7.5H3.75C3.55109 7.5 3.36032 7.57902 3.21967 7.71967C3.07902 7.86032 3 8.05109 3 8.25V20.25C3 20.4489 3.07902 20.6397 3.21967 20.7803C3.36032 20.921 3.55109 21 3.75 21H15.75C15.9489 21 16.1397 20.921 16.2803 20.7803C16.421 20.6397 16.5 20.4489 16.5 20.25V16.5H20.25C20.4489 16.5 20.6397 16.421 20.7803 16.2803C20.921 16.1397 21 15.9489 21 15.75V3.75C21 3.55109 20.921 3.36032 20.7803 3.21967C20.6397 3.07902 20.4489 3 20.25 3ZM15 19.5H4.5V9H15V19.5ZM19.5 15H16.5V8.25C16.5 8.05109 16.421 7.86032 16.2803 7.71967C16.1397 7.57902 15.9489 7.5 15.75 7.5H9V4.5H19.5V15Z"
                                        fill="#8599AD"/>
                                </svg>
                            </button>
                        </div>
                        <div class="overview-content">
                            <div class="overview-content-item">
                                <div class="title">As a leader I am</div>
                                <ul class="list">
                                    <li>Inspirational</li>
                                    <li>Risk Taking</li>
                                </ul>
                            </div>
                            <div class="overview-content-item">
                                <div class="title">My adaptability is</div>
                                <ul class="list">
                                    <li>Nimbleness</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="decor-border"></div>

                    <div class="overview-section">
                        <div class="overview-title">
                            <div class="title">My Competencies & Skills</div>
                            <button class="copy-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <path
                                        d="M20.25 3H8.25C8.05109 3 7.86032 3.07902 7.71967 3.21967C7.57902 3.36032 7.5 3.55109 7.5 3.75V7.5H3.75C3.55109 7.5 3.36032 7.57902 3.21967 7.71967C3.07902 7.86032 3 8.05109 3 8.25V20.25C3 20.4489 3.07902 20.6397 3.21967 20.7803C3.36032 20.921 3.55109 21 3.75 21H15.75C15.9489 21 16.1397 20.921 16.2803 20.7803C16.421 20.6397 16.5 20.4489 16.5 20.25V16.5H20.25C20.4489 16.5 20.6397 16.421 20.7803 16.2803C20.921 16.1397 21 15.9489 21 15.75V3.75C21 3.55109 20.921 3.36032 20.7803 3.21967C20.6397 3.07902 20.4489 3 20.25 3ZM15 19.5H4.5V9H15V19.5ZM19.5 15H16.5V8.25C16.5 8.05109 16.421 7.86032 16.2803 7.71967C16.1397 7.57902 15.9489 7.5 15.75 7.5H9V4.5H19.5V15Z"
                                        fill="#8599AD"/>
                                </svg>
                            </button>
                        </div>
                        <div class="overview-content">
                            <div class="overview-content-item">
                                <div class="title">As a leader I am</div>
                                <ul class="list">
                                    <li>Inspirational</li>
                                    <li>Risk Taking</li>
                                </ul>
                            </div>
                            <div class="overview-content-item">
                                <div class="title">My adaptability is</div>
                                <ul class="list">
                                    <li>Nimbleness</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-part-content">
            <div class="dropdown-item not-started">
                <div class="dropdown-item-head">
                    <div class="name">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M4 16C4 9.37258 9.37258 4 16 4C22.6274 4 28 9.37258 28 16C28 22.6274 22.6274 28 16 28C9.37258 28 4 22.6274 4 16Z"
                                  fill="url(#paint0_linear_1858_11751)"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16 1.5C16.5523 1.5 17 1.94772 17 2.5V7.5C17 8.05228 16.5523 8.5 16 8.5C15.4477 8.5 15 8.05228 15 7.5V2.5C15 1.94772 15.4477 1.5 16 1.5Z"
                                  fill="url(#paint1_linear_1858_11751)"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M1.5 16C1.5 15.4477 1.94772 15 2.5 15H7.5C8.05228 15 8.5 15.4477 8.5 16C8.5 16.5523 8.05228 17 7.5 17H2.5C1.94772 17 1.5 16.5523 1.5 16Z"
                                  fill="url(#paint2_linear_1858_11751)"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16 23.5C16.5523 23.5 17 23.9477 17 24.5V29.5C17 30.0523 16.5523 30.5 16 30.5C15.4477 30.5 15 30.0523 15 29.5V24.5C15 23.9477 15.4477 23.5 16 23.5Z"
                                  fill="url(#paint3_linear_1858_11751)"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M23.5 16C23.5 15.4477 23.9477 15 24.5 15H29.5C30.0523 15 30.5 15.4477 30.5 16C30.5 16.5523 30.0523 17 29.5 17H24.5C23.9477 17 23.5 16.5523 23.5 16Z"
                                  fill="url(#paint4_linear_1858_11751)"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16 13C14.3431 13 13 14.3431 13 16C13 17.6569 14.3431 19 16 19C17.6569 19 19 17.6569 19 16C19 14.3431 17.6569 13 16 13ZM11 16C11 13.2386 13.2386 11 16 11C18.7614 11 21 13.2386 21 16C21 18.7614 18.7614 21 16 21C13.2386 21 11 18.7614 11 16Z"
                                  fill="white"/>
                            <defs>
                                <linearGradient id="paint0_linear_1858_11751" x1="4" y1="4" x2="28" y2="28"
                                                gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#0075FF"/>
                                    <stop offset="1" stop-color="#7CB2F4"/>
                                </linearGradient>
                                <linearGradient id="paint1_linear_1858_11751" x1="15" y1="1.5" x2="18.6981" y2="2.5566"
                                                gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#0075FF"/>
                                    <stop offset="1" stop-color="#7CB2F4"/>
                                </linearGradient>
                                <linearGradient id="paint2_linear_1858_11751" x1="1.5" y1="15" x2="2.5566" y2="18.6981"
                                                gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#0075FF"/>
                                    <stop offset="1" stop-color="#7CB2F4"/>
                                </linearGradient>
                                <linearGradient id="paint3_linear_1858_11751" x1="15" y1="23.5" x2="18.6981"
                                                y2="24.5566"
                                                gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#0075FF"/>
                                    <stop offset="1" stop-color="#7CB2F4"/>
                                </linearGradient>
                                <linearGradient id="paint4_linear_1858_11751" x1="23.5" y1="15" x2="24.5566"
                                                y2="18.6981"
                                                gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#0075FF"/>
                                    <stop offset="1" stop-color="#7CB2F4"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        Career Direction
                    </div>
                    <div class="progress-section">
                        <div class="a-progress-bar" data-form="formBlock6">
                            <div class="progress">
                                <div class="bar" style="width: 0%;"></div>
                            </div>
                            <div class="a-progress-bar-percent inter fw-medium fz-012">
                                <span class="count">0</span>%
                            </div>
                        </div>

                        <a class="btn btn-blue" href="/self-assessment">Let’s start</a>
                    </div>
                </div>

                <div class="dropdown-item-content"></div>
            </div>
        </div>

        <div class="dashboard-part-content">
            <div class="dropdown-item">
                <div class="dropdown-item-head">
                    <div class="name">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path
                                d="M16 4C9.37261 4 4 9.37261 4 16C4 18.2165 4.60108 20.2925 5.64888 22.0742C5.79269 22.3188 5.83871 22.6103 5.76308 22.8837L4.95144 25.8182C4.74431 26.567 5.43298 27.2557 6.18183 27.0486L9.11626 26.2369C9.38969 26.1613 9.68124 26.2073 9.92579 26.3511C11.7075 27.399 13.7835 28 16 28C22.6274 28 28 22.6274 28 16C28 9.37261 22.6274 4 16 4Z"
                                fill="url(#paint0_linear_1858_11759)"/>
                            <path d="M16.9984 23.0137H15.0039V21.0192H16.9984V23.0137Z" fill="white"/>
                            <path
                                d="M13.0078 12.9746C13.0078 11.3223 14.3472 9.98286 15.9995 9.98286C17.6518 9.98286 18.9912 11.3223 18.9912 12.9746C18.9912 13.8488 18.616 14.6353 18.0181 15.1823L15.9995 17.03V19.0244"
                                stroke="white" stroke-width="1.5" stroke-miterlimit="10"/>
                            <defs>
                                <linearGradient id="paint0_linear_1858_11759" x1="4" y1="28" x2="28" y2="4"
                                                gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#0075FF"/>
                                    <stop offset="1" stop-color="#7CB2F4"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        Interview Preparation
                    </div>
                    <div class="progress-section">
                        <div class="a-progress-bar" data-form="formBlock6">
                            <div class="progress">
                                <div class="bar" style="width: 0%;"></div>
                            </div>
                            <div class="a-progress-bar-percent inter fw-medium fz-012">
                                <span class="count">0</span>%
                            </div>
                        </div>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M19.9201 8.9502L13.4001 15.4702C12.6301 16.2402 11.3701 16.2402 10.6001 15.4702L4.08008 8.9502"
                                stroke="#2C3659" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <div class="dropdown-item-content"></div>
            </div>
        </div>

        <div class="dashboard-part-content networking">
            <div class="title">Networking Funnel</div>
            <ul class="networking-list">
                <li>
                    <a href="#">
                        <span class="name">contacts total</span>
                        <span class="count">0</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="name">Not Contacted</span>
                        <span class="count">1</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="name">To Follow Up</span>
                        <span class="count">2</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="name">TO Contact</span>
                        <span class="count">0</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="name">Not Responded</span>
                        <span class="count">98</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="name">Meeting Scheduled</span>
                        <span class="count">98</span>
                    </a>
                </li>
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

                Full Overview
            </div>
            <a href="#" class="btn btn-blue">
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

        <div class="section-dashboard">
            <div class="section-dashboard-title border-none flex flex-between">
                <h2>My Values</h2>
                <button class="copy-button">
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
                    <div class="overview-content-item">
                        <div class="title">As a leader I am</div>
                        <ul class="list">
                            <li>Inspirational</li>
                            <li>Risk Taking</li>
                        </ul>
                    </div>
                    <div class="overview-content-item">
                        <div class="title">My adaptability is</div>
                        <ul class="list">
                            <li>Nimbleness</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-part-content text-img">
        <div class="text-content">
            <div class="title"><span>Largest</span> Executive Search Database</div>
            <div class="description">
                Our search database puts you in direct contact with influential professionals who can open doors and
                create opportunities that were once out of reach.
            </div>
        </div>

        <div class="img-content">
            <img src="" alt="">
        </div>
    </div>
@endsection
