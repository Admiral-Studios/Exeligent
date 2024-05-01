@extends("layouts.user")

@section('title', 'New Self')

@section('content')

    <div class="tab-menu">
        <ul class="tab-menu-list flex">
            <li><a href="#" class="tab-a active-a" data-id="tab1">Preferred Work Environment</a></li>
            <li><a href="#" class="tab-a" data-id="tab2">Key Employer Criteria</a></li>
            <li><a href="#" class="tab-a" data-id="tab3">Target Regions</a></li>
            <li><a href="#" class="tab-a" data-id="tab4">Target Industry</a></li>
            <li><a href="#" class="tab-a" data-id="tab5">Alumni Networks</a></li>
        </ul>
    </div>

    <div class="tab tab-active tab-dashboard" data-id="tab1">
        <div class="section-dashboard">
            <div class="section-dashboard-title border-none">
                <h2>Preferred Work Environment</h2>
                <p class="inter fw-regular fz-012 dark">
                    Select only 3 criteria
                </p>
            </div>
            <div class="section-dashboard-content">
                <ul class="choose-block-list preferred-list">
                    <li class="choose-block">
                        Company culture
                    </li>
                    <li class="choose-block">
                        Work-life balance
                    </li>
                    <li class="choose-block">
                        Growth opportunities
                    </li>
                    <li class="choose-block">
                        Compensation and benefits
                    </li>
                </ul>
            </div>
            <div class="section-dashboard-bottom">
                <button class="btn btn-blue">Save</button>
            </div>
        </div>
    </div>

    <div class="tab tab-active tab-dashboard" data-id="tab2">
        <div class="section-dashboard">
            <div class="section-dashboard-title">
                <h2>Key Employer Criteria</h2>
            </div>
            <div class="section-dashboard-content">
                <div class="choose-wrapper">
                    <div class="choose-section">
                        <div class="title">Size of the company</div>
                        <ul class="choose-block-list one-select-list">
                            <li class="choose-block big">Small</li>
                            <li class="choose-block big">Middle</li>
                            <li class="choose-block big">Large</li>
                        </ul>
                    </div>
                    <div class="choose-section">
                        <div class="title">Travel in %</div>
                        <ul class="choose-block-list one-select-list">
                            <li class="choose-block big">0%</li>
                            <li class="choose-block big">10%</li>
                            <li class="choose-block big">25%</li>
                            <li class="choose-block big">50%</li>
                            <li class="choose-block big">80%</li>
                            <li class="choose-block big">100%</li>
                        </ul>
                    </div>

                    <div class="choose-section culture-list">
                        <div class="title">Types of Culture</div>
                        <ul class="choose-block-list">
                            <li class="choose-block big">Customer service</li>
                            <li class="choose-block big">Efficiency</li>
                            <li class="choose-block big">Hard work</li>
                            <div class="choose-block item-add">+ Add</div>
                            <input class="input-add-value" type="text" placeholder="Add your value...">
                        </ul>
                    </div>
                </div>

                <div class="border"></div>

                <div class="choose-wrapper two-column">
                    <div class="choose-wrapper-box">
                        <div class="choose-section">
                            <div class="title">Relocate</div>
                            <ul class="choose-block-list one-select-list">
                                <li class="choose-block big">Yes</li>
                                <li class="choose-block big">No</li>
                            </ul>
                        </div>
                        <div class="choose-section">
                            <div class="title">Schools</div>
                            <ul class="choose-block-list one-select-list">
                                <li class="choose-block big">Local</li>
                                <li class="choose-block big">Private</li>
                                <li class="choose-block big">International</li>
                            </ul>
                        </div>
                    </div>

                    <div class="choose-wrapper-box">
                        <div class="choose-section">
                            <div class="title">Cost of Living</div>
                            <ul class="choose-block-list one-select-list">
                                <li class="choose-block big">Low</li>
                                <li class="choose-block big">Mid</li>
                                <li class="choose-block big">High</li>
                            </ul>
                        </div>
                        <div class="choose-section">
                            <div class="title">City size</div>
                            <ul class="choose-block-list one-select-list">
                                <li class="choose-block big">Small</li>
                                <li class="choose-block big">Middle</li>
                                <li class="choose-block big">Large</li>
                            </ul>
                        </div>
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
                <h2>Target Regions</h2>
            </div>
            <div class="section-dashboard-content">
                <form class="a-form" action="">
                    <div class="a-form__section">
                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Primary Regions</label>
                                <input class="a-input" type="text" placeholder="Type..." id="">
                                <input class="a-input" type="text" placeholder="Type..." id="">
                                <input class="a-input" type="text" placeholder="Type..." id="">
                            </div>
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Secondary Regions</label>
                                <input class="a-input" type="text" placeholder="Type..." id="">
                                <input class="a-input" type="text" placeholder="Type..." id="">
                                <input class="a-input" type="text" placeholder="Type..." id="">
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

    <div class="tab tab-active tab-dashboard" data-id="tab4">
        <div class="section-dashboard">
            <div class="section-dashboard-title border-none">
                <h2>Target Industry</h2>
            </div>
            <div class="section-dashboard-content">
                <div class="choose-section culture-list">
                    <ul class="choose-block-list">
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_hospital.svg') }}" alt="icon">
                            Healthcare&LifeScience
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_desktop_computer.svg') }}" alt="icon">
                            Technology
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_notebook_with_decorative_cover.svg') }}" alt="icon">
                            Professional Services
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_chart_increasing_with_yen.svg') }}" alt="icon">
                            Financial
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_shopping_cart.svg') }}" alt="icon">
                            Retail
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_high_voltage.svg') }}" alt="icon">
                            Energy
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_factory.svg') }}" alt="icon">
                            Manufacturing
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_performing_arts.svg') }}" alt="icon">
                            Entertainment
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_ear_of_corn.svg') }}" alt="icon">
                            Agriculture
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_articulated_lorry.svg') }}" alt="icon">
                            Transportation
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_books.svg') }}" alt="icon">
                            Education
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_building_construction.svg') }}" alt="icon">
                            Construction
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_notebook_with_decorative_cover.svg') }}" alt="icon">
                            Professional Services
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_judge_medium-light_skin_tone.svg') }}" alt="icon">
                            Government
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_love_letter.svg') }}" alt="icon">
                            Nonprofit
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_judge_medium-light_skin_tone.svg') }}" alt="icon">
                            Hospitality
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_house.svg') }}" alt="icon">
                            Real Estate
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_money_bag.svg') }}" alt="icon">
                            Wholesale
                        </li>
                        <li class="choose-block big">
                            <img src="{{ asset('images/icons/emoji_person_in_lotus_position.svg') }}" alt="icon">
                            Personal Care
                        </li>
                        <div class="choose-block item-add">+ Add</div>
                        <div class="utility-container">
                            <ul class="utility-group">
                                <li class="emoji-selector" id="emojiSelector">
                                    <div class="input-container">
                                        <input id="emojiSearch" type="text" name="" placeholder="Search...">
                                    </div>
                                    <ul id="emojiList" class="emoji-list">
                                    </ul>
                                </li>
                                <li id="emojiSelectorIcon">
                                    <img src="{{ asset('images/icons/face-smile-regular.svg') }}" alt="icon">
                                </li>
                            </ul>
                        </div>
                        <input class="input-add-value" type="text" placeholder="Add your value...">
                    </ul>
                </div>
            </div>
            <div class="section-dashboard-bottom">
                <button class="btn btn-blue">Save</button>
            </div>
        </div>
    </div>

    <div class="tab tab-active tab-dashboard" data-id="tab5">
        <div class="section-dashboard">
            <div class="section-dashboard-title">
                <h2>Alumni Networks</h2>
            </div>

            <div class="section-dashboard-content">
                <form class="a-form" action="">
                    <div class="a-form__section">
                        <div class="a-form__item flex flow-column">
                            <label class="a-form__item__label" for="education">Education</label>
                            <div class="a-form__item-box flex-row">
                                <input class="a-input" type="text" placeholder="Type here" id="education">
                                <button type="button" class="a-form__item-box__add-more flex align-center add-input">
                                    + Add More
                                </button>
                            </div>
                        </div>
                        <div class="a-form__item flex flow-column">
                            <label class="a-form__item__label" for="previous_employer">Previous Employers</label>
                            <div class="a-form__item-box flex-row">
                                <input class="a-input" type="text" placeholder="Type here" id="previous_employer">
                                <button type="button" class="a-form__item-box__add-more flex align-center add-input">
                                    + Add More
                                </button>
                            </div>
                        </div>
                        <div class="a-form__item flex flow-column">
                            <label class="a-form__item__label" for="foundations">
                                Foundations & Extracurricular Activities
                            </label>
                            <div class="a-form__item-box flex-row">
                                <input class="a-input" type="text" placeholder="Type here" id="foundations">
                                <button type="button" class="a-form__item-box__add-more flex align-center add-input">
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

    {{--    <div class="section-dashboard-content">--}}
    {{--        <div class="section-add-self">--}}
    {{--            <div class="title">Leadership</div>--}}
    {{--            <div class="list">--}}
    {{--                <div class="item">Strategic Thinking</div>--}}
    {{--                <div class="item">Inspirational</div>--}}
    {{--                    <div class="item item-add">+ Add</div>--}}
    {{--                    <input class="input-add-value" type="text" placeholder="Add your value...">--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--        <div class="section-add-self">--}}
    {{--            <div class="title">Adaptability</div>--}}
    {{--            <div class="list">--}}
    {{--                <div class="item">Change Readiness</div>--}}
    {{--                <div class="item">Flexibility</div>--}}
    {{--                <div class="item">Nimbleness</div>--}}
    {{--                <div class="item">Resourcefulness</div>--}}
    {{--                <div class="item">Resilence</div>--}}
    {{--                <div class="item item-add">+ Add</div>--}}
    {{--                <input class="input-add-value" type="text" placeholder="Add your value...">--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

@endsection
