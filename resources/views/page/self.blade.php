@extends("layouts.user")

@section('title', 'New Self')

@section('content')

    <div class="tab-menu">
        <ul class="tab-menu-list flex">
            <li><a href="#" class="tab-a active-a" data-id="tab1">Values</a></li>
            <li><a href="#" class="tab-a" data-id="tab2">Competencies & Skills</a></li>
            <li><a href="#" class="tab-a" data-id="tab3">Interests</a></li>
            <li><a href="#" class="tab-a" data-id="tab4">Strengths & Weaknesses</a></li>
            <li class="story">
                <a href="#" class="tab-a" data-id="tab5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                        <path
                            d="M14.3844 4.90897L11.5913 2.11647C11.3568 1.88213 11.039 1.75049 10.7075 1.75049C10.376 1.75049 10.0582 1.88213 9.82375 2.11647L2.11625 9.82335C1.99978 9.9391 1.90744 10.0768 1.84457 10.2285C1.7817 10.3802 1.74956 10.5429 1.75 10.7071V13.5002C1.75 13.8317 1.8817 14.1497 2.11612 14.3841C2.35054 14.6185 2.66848 14.7502 3 14.7502H5.79313C5.95735 14.7507 6.12002 14.7186 6.27173 14.6557C6.42343 14.5928 6.56114 14.5005 6.67688 14.384L11.6431 9.41835L11.9031 10.2865L9.72001 12.4696C9.57911 12.6105 9.49995 12.8016 9.49995 13.0008C9.49995 13.2001 9.57911 13.3912 9.72001 13.5321C9.8609 13.673 10.052 13.7521 10.2513 13.7521C10.4505 13.7521 10.6416 13.673 10.7825 13.5321L13.2825 11.0321C13.3782 10.9362 13.4462 10.8162 13.4792 10.6848C13.5123 10.5535 13.5091 10.4156 13.47 10.2858L12.8488 8.21522L14.3856 6.67835C14.5019 6.56216 14.594 6.4242 14.6569 6.27235C14.7197 6.1205 14.752 5.95774 14.7519 5.7934C14.7518 5.62906 14.7193 5.46635 14.6562 5.31459C14.5932 5.16283 14.5008 5.02499 14.3844 4.90897ZM4.0625 10.0002L8.5 5.56272L10.9375 8.00022L6.5 12.4377L4.0625 10.0002ZM3.25 11.3127L5.1875 13.2502H3.25V11.3127ZM12 6.93772L9.5625 4.50022L10.7088 3.35397L13.1463 5.79147L12 6.93772Z"
                            fill="#027FFE"/>
                    </svg>
                    Write your story
                </a>
            </li>
        </ul>
    </div>

    <div class="tab tab-active tab-dashboard" data-id="tab1">
        <div class="section-dashboard">
            <div class="section-dashboard-title">
                <h2>Values</h2>
            </div>
            <div class="section-dashboard-content">
                <div class="section-add-self">
                    <div class="title">Leadership</div>
                    <div class="list">
                        <div class="item">Strategic Thinking</div>
                        <div class="item">Inspirational</div>
                        <div class="item item-add">+ Add</div>
                        <input class="input-add-value" type="text" placeholder="Add your value...">
                    </div>
                </div>

                <div class="section-add-self">
                    <div class="title">Adaptability</div>
                    <div class="list">
                        <div class="item">Change Readiness</div>
                        <div class="item">Flexibility</div>
                        <div class="item">Nimbleness</div>
                        <div class="item">Resourcefulness</div>
                        <div class="item">Resilence</div>
                        <div class="item item-add">+ Add</div>
                        <input class="input-add-value" type="text" placeholder="Add your value...">
                    </div>
                </div>
            </div>
            <div class="section-dashboard-bottom">
                <button class="btn btn-blue">Save</button>
            </div>
        </div>
    </div>

    <div class="tab tab-active tab-dashboard" data-id="tab2">
        <div class="section-dashboard">
            <div class="section-dashboard-title">
                <h2>Competencies & Skills</h2>
            </div>
            <div class="section-dashboard-content">
                <div class="section-add-self">
                    <div class="title">Leadership</div>
                    <div class="list">
                        <div class="item">Strategic Thinking</div>
                        <div class="item">Inspirational</div>
                        <div class="item item-add">+ Add</div>
                        <input class="input-add-value" type="text" placeholder="Add your value...">
                    </div>
                </div>

                <div class="section-add-self">
                    <div class="title">Adaptability</div>
                    <div class="list">
                        <div class="item">Change Readiness</div>
                        <div class="item">Flexibility</div>
                        <div class="item">Nimbleness</div>
                        <div class="item">Resourcefulness</div>
                        <div class="item">Resilence</div>
                        <div class="item item-add">+ Add</div>
                        <input class="input-add-value" type="text" placeholder="Add your value...">
                    </div>
                </div>
            </div>
            <div class="section-dashboard-bottom">
                <button class="btn btn-blue">Save</button>
            </div>
        </div>
    </div>

    <div class="tab tab-active tab-dashboard" data-id="tab3">
        <div class="section-dashboard">
            <div class="section-dashboard-title">
                <h2>Interests</h2>
            </div>
            <div class="section-dashboard-content">
                <form class="a-form" action="">
                    <div class="a-form__section">
                        <div class="a-form__item flex">
                            <input class="a-input" type="text" placeholder="Type here">
                            <button type="button"
                                    class="a-form__item-box__add-more flex align-center add-input no-need-new-index input-has-name">
                                + Add More
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="section-dashboard-bottom">
                <button class="btn btn-blue">Save</button>
            </div>
        </div>
    </div>

    <div class="tab tab-active tab-dashboard" data-id="tab4">
        <div class="section-dashboard">
            <div class="section-dashboard-title">
                <h2>Strengths & Weaknesses</h2>
            </div>
            <div class="section-dashboard-content">
                <form class="a-form" action="">
                    <div class="a-form__section">
                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="strengths">Strengths</label>
                                <input class="a-input" type="text" placeholder="Type..." id="strengths">
                                <button type="button"
                                        class="a-form__item-box__add-more flex align-center add-input no-need-new-index input-has-name">
                                    + Add More
                                </button>
                            </div>
                        </div>
                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="weaknesses">Weaknesses</label>
                                <input class="a-input" type="text" placeholder="Type..." id="weaknesses">
                                <button type="button"
                                        class="a-form__item-box__add-more flex align-center add-input no-need-new-index input-has-name">
                                    + Add More
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="section-dashboard-bottom">
                <button class="btn btn-blue">Save</button>
            </div>
        </div>
    </div>
    <div class="tab tab-active tab-dashboard" data-id="tab5">
        <div class="section-dashboard">
            <div class="section-dashboard-title">
                <h2>Storytelling</h2>
                <p class="inter fw-regular fz-012 dark">
                    Prepare your version of events in advance
                </p>
            </div>

            <script>

            </script>

            <div class="section-dashboard-content">
                {{--                <form class="a-form story-form" action="">--}}
                <div class="a-form story-form">
                    <div class="a-form__section">
                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <div class="story-change-text flex">
                                    <label class="a-form__item__label" for="about_you">About you</label>
                                    <input class="a-input change-text" type="text" value="">
                                    <svg class="change-btn" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 20 20"
                                         fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M13.1976 1.22004L3.11964 11.298C2.96899 11.4483 2.8702 11.6428 2.83764 11.853L2.13264 16.447C2.10885 16.6022 2.12193 16.7608 2.1708 16.91C2.21968 17.0591 2.30299 17.1947 2.41399 17.3057C2.52499 17.4167 2.66056 17.5 2.80973 17.5489C2.9589 17.5978 3.11748 17.6108 3.27264 17.587L7.86764 16.882C8.07781 16.8498 8.27222 16.7513 8.42264 16.601L18.5006 6.52304C18.6881 6.33552 18.7934 6.08121 18.7934 5.81604C18.7934 5.55088 18.6881 5.29657 18.5006 5.10905L14.6106 1.21904C14.4232 1.03188 14.1691 0.926758 13.9041 0.926758C13.6392 0.926758 13.3851 1.03188 13.1976 1.21904V1.22004ZM4.31664 15.404L4.76464 12.48L13.9046 3.34004L16.3796 5.81604L7.23964 14.956L4.31664 15.404Z"
                                              fill="#027FFE"/>
                                        <path
                                            d="M11.4414 5.24704L12.5014 4.18604L15.7434 7.42604L14.6824 8.48704L11.4414 5.24704Z"
                                            fill="#027FFE"/>
                                    </svg>
                                </div>

                                <textarea class="a-input textarea" type="text" placeholder="Type here"
                                          id="about_you"></textarea>
                            </div>
                        </div>

                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <div class="story-change-text flex">
                                    <label class="a-form__item__label" for="biggest_win">Your biggest win</label>
                                    <input class="a-input change-text" type="text" value="">
                                    <svg class="change-btn" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 20 20"
                                         fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M13.1976 1.22004L3.11964 11.298C2.96899 11.4483 2.8702 11.6428 2.83764 11.853L2.13264 16.447C2.10885 16.6022 2.12193 16.7608 2.1708 16.91C2.21968 17.0591 2.30299 17.1947 2.41399 17.3057C2.52499 17.4167 2.66056 17.5 2.80973 17.5489C2.9589 17.5978 3.11748 17.6108 3.27264 17.587L7.86764 16.882C8.07781 16.8498 8.27222 16.7513 8.42264 16.601L18.5006 6.52304C18.6881 6.33552 18.7934 6.08121 18.7934 5.81604C18.7934 5.55088 18.6881 5.29657 18.5006 5.10905L14.6106 1.21904C14.4232 1.03188 14.1691 0.926758 13.9041 0.926758C13.6392 0.926758 13.3851 1.03188 13.1976 1.21904V1.22004ZM4.31664 15.404L4.76464 12.48L13.9046 3.34004L16.3796 5.81604L7.23964 14.956L4.31664 15.404Z"
                                              fill="#027FFE"/>
                                        <path
                                            d="M11.4414 5.24704L12.5014 4.18604L15.7434 7.42604L14.6824 8.48704L11.4414 5.24704Z"
                                            fill="#027FFE"/>
                                    </svg>
                                </div>
                                <textarea class="a-input textarea" type="text" placeholder="Type here"
                                          id="biggest_win"></textarea>
                            </div>
                        </div>

                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <div class="story-change-text flex">
                                    <label class="a-form__item__label" for="examples">Examples</label>
                                    <input class="a-input change-text" type="text" value="">
                                    <svg class="change-btn" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 20 20"
                                         fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M13.1976 1.22004L3.11964 11.298C2.96899 11.4483 2.8702 11.6428 2.83764 11.853L2.13264 16.447C2.10885 16.6022 2.12193 16.7608 2.1708 16.91C2.21968 17.0591 2.30299 17.1947 2.41399 17.3057C2.52499 17.4167 2.66056 17.5 2.80973 17.5489C2.9589 17.5978 3.11748 17.6108 3.27264 17.587L7.86764 16.882C8.07781 16.8498 8.27222 16.7513 8.42264 16.601L18.5006 6.52304C18.6881 6.33552 18.7934 6.08121 18.7934 5.81604C18.7934 5.55088 18.6881 5.29657 18.5006 5.10905L14.6106 1.21904C14.4232 1.03188 14.1691 0.926758 13.9041 0.926758C13.6392 0.926758 13.3851 1.03188 13.1976 1.21904V1.22004ZM4.31664 15.404L4.76464 12.48L13.9046 3.34004L16.3796 5.81604L7.23964 14.956L4.31664 15.404Z"
                                              fill="#027FFE"/>
                                        <path
                                            d="M11.4414 5.24704L12.5014 4.18604L15.7434 7.42604L14.6824 8.48704L11.4414 5.24704Z"
                                            fill="#027FFE"/>
                                    </svg>
                                </div>
                                <textarea class="a-input textarea" type="text" placeholder="Type here"
                                          id="examples"></textarea>
                            </div>
                        </div>

                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <div class="story-change-text flex">
                                    <label class="a-form__item__label" for="mistakes">Biggest Mistakes</label>
                                    <input class="a-input change-text" type="text" value="">
                                    <svg class="change-btn" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 20 20"
                                         fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M13.1976 1.22004L3.11964 11.298C2.96899 11.4483 2.8702 11.6428 2.83764 11.853L2.13264 16.447C2.10885 16.6022 2.12193 16.7608 2.1708 16.91C2.21968 17.0591 2.30299 17.1947 2.41399 17.3057C2.52499 17.4167 2.66056 17.5 2.80973 17.5489C2.9589 17.5978 3.11748 17.6108 3.27264 17.587L7.86764 16.882C8.07781 16.8498 8.27222 16.7513 8.42264 16.601L18.5006 6.52304C18.6881 6.33552 18.7934 6.08121 18.7934 5.81604C18.7934 5.55088 18.6881 5.29657 18.5006 5.10905L14.6106 1.21904C14.4232 1.03188 14.1691 0.926758 13.9041 0.926758C13.6392 0.926758 13.3851 1.03188 13.1976 1.21904V1.22004ZM4.31664 15.404L4.76464 12.48L13.9046 3.34004L16.3796 5.81604L7.23964 14.956L4.31664 15.404Z"
                                              fill="#027FFE"/>
                                        <path
                                            d="M11.4414 5.24704L12.5014 4.18604L15.7434 7.42604L14.6824 8.48704L11.4414 5.24704Z"
                                            fill="#027FFE"/>
                                    </svg>
                                </div>
                                <textarea class="a-input textarea" type="text" placeholder="Type here"
                                          id="mistakes"></textarea>
                            </div>
                        </div>

                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <div class="story-change-text flex">
                                    <label class="a-form__item__label" for="lesson">Lesson that You’ve learned</label>
                                    <input class="a-input change-text" type="text" value="">
                                    <svg class="change-btn" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 20 20"
                                         fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M13.1976 1.22004L3.11964 11.298C2.96899 11.4483 2.8702 11.6428 2.83764 11.853L2.13264 16.447C2.10885 16.6022 2.12193 16.7608 2.1708 16.91C2.21968 17.0591 2.30299 17.1947 2.41399 17.3057C2.52499 17.4167 2.66056 17.5 2.80973 17.5489C2.9589 17.5978 3.11748 17.6108 3.27264 17.587L7.86764 16.882C8.07781 16.8498 8.27222 16.7513 8.42264 16.601L18.5006 6.52304C18.6881 6.33552 18.7934 6.08121 18.7934 5.81604C18.7934 5.55088 18.6881 5.29657 18.5006 5.10905L14.6106 1.21904C14.4232 1.03188 14.1691 0.926758 13.9041 0.926758C13.6392 0.926758 13.3851 1.03188 13.1976 1.21904V1.22004ZM4.31664 15.404L4.76464 12.48L13.9046 3.34004L16.3796 5.81604L7.23964 14.956L4.31664 15.404Z"
                                              fill="#027FFE"/>
                                        <path
                                            d="M11.4414 5.24704L12.5014 4.18604L15.7434 7.42604L14.6824 8.48704L11.4414 5.24704Z"
                                            fill="#027FFE"/>
                                    </svg>
                                </div>
                                <textarea class="a-input textarea" type="text" placeholder="Type here"
                                          id="lesson"></textarea>
                            </div>
                        </div>

                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <div class="story-change-text flex">
                                    <label class="a-form__item__label" for="project">Project you’re Proud of</label>
                                    <input class="a-input change-text" type="text" value="">
                                    <svg class="change-btn" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 20 20"
                                         fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M13.1976 1.22004L3.11964 11.298C2.96899 11.4483 2.8702 11.6428 2.83764 11.853L2.13264 16.447C2.10885 16.6022 2.12193 16.7608 2.1708 16.91C2.21968 17.0591 2.30299 17.1947 2.41399 17.3057C2.52499 17.4167 2.66056 17.5 2.80973 17.5489C2.9589 17.5978 3.11748 17.6108 3.27264 17.587L7.86764 16.882C8.07781 16.8498 8.27222 16.7513 8.42264 16.601L18.5006 6.52304C18.6881 6.33552 18.7934 6.08121 18.7934 5.81604C18.7934 5.55088 18.6881 5.29657 18.5006 5.10905L14.6106 1.21904C14.4232 1.03188 14.1691 0.926758 13.9041 0.926758C13.6392 0.926758 13.3851 1.03188 13.1976 1.21904V1.22004ZM4.31664 15.404L4.76464 12.48L13.9046 3.34004L16.3796 5.81604L7.23964 14.956L4.31664 15.404Z"
                                              fill="#027FFE"/>
                                        <path
                                            d="M11.4414 5.24704L12.5014 4.18604L15.7434 7.42604L14.6824 8.48704L11.4414 5.24704Z"
                                            fill="#027FFE"/>
                                    </svg>
                                </div>
                                <textarea class="a-input textarea" type="text" placeholder="Type here"
                                          id="project"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-dashboard-bottom">
                <button class="btn btn-blue">Save</button>
            </div>
        </div>
    </div>

@endsection
