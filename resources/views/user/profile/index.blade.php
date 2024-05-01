@extends('layouts.user')

@section('title', 'My Profile | ' . config('app.name'))

@section('styles')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"/>
@endsection

@section('content')

    <div class=" my-profile-page">
        <div class="tab-menu">
            <ul class="tab-menu-list flex">
                <li>
                    <a href="#" class="tab-a" data-id="tab-profile">My Profile</a>
                </li>
                <li>
                    <a href="#" class="tab-a" data-id="tab-subscription">My Subscription</a>
                </li>
            </ul>
        </div>

        <div class="tab" data-id="tab-profile">

            <div class="section-dashboard section-dashboard-profile">
                <div class="section-dashboard-title">
                    <div class="title-box flex flow-column">
                        <h2>My Profile</h2>
                    </div>
                </div>

                <div class="section-dashboard-content flex flow-column">
                    <form action="{{ route('user.profile.store') }}" method="POST"
                          onchange="this.querySelector('button[type=submit]').disabled = false">
                        @csrf

                        <div class="a-form__section">

                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="first_name">First Name</label>
                                    <input class="a-input a-input-brand @error('first_name') is-invalid @enderror"
                                           id="first_name" name="first_name" value="{{ $user->first_name }}" type="text"
                                           placeholder="Enter First name..."/>
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>

                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="last_name">Last Name</label>
                                    <input class="a-input a-input-brand @error('last_name') is-invalid @enderror"
                                           id="last_name" name="last_name" value="{{ $user->last_name }}" type="text"
                                           placeholder="Enter Last name..."/>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="email">Email Adress</label>
                                    <input class="a-input a-input-brand @error('email') is-invalid @enderror"
                                           id="email" name="email_old" value="{{ $user->email }}" type="email"
                                           placeholder="Enter email..." disabled/>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="country">Country</label>
                                    {{--                        <input class="a-input a-input-brand @error('country') is-invalid @enderror"--}}
                                    {{--                               id="country" name="country" value="{{ $user->country }}" type="text"--}}
                                    {{--                               placeholder="Enter country..."/>--}}
                                    <div class="a-select placeholder">
                                        <select class="a-input a-input-brand @error('country') is-invalid @enderror"
                                                data-role="country-selector" data-code-mode="alpha2" id="country"
                                                name="country" value="{{ $user->country->iso_a2 ?? '' }}">
                                        </select>
                                        @if(!$user->country_id)
                                            <span>Enter country...</span>
                                        @endif
                                    </div>
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="city">City</label>
                                    <select class="a-input a-input-brand @error('city') is-invalid @enderror"
                                            id="city" name="city" value="{{ $user->city }}" type="text"
                                            placeholder="Enter city...">
                                        @if($user->city)
                                            <option value="{{ $user->city }}" selected>{{ $user->city }}</option>
                                        @endif
                                    </select>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label">Age</label>
                                    <input class="a-input a-input-brand @error('age') is-invalid @enderror"
                                           id="age" name="age" value="{{ $user->age }}" type="text"
                                           placeholder="Enter your age..."/>
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="separate"></div>
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="current_company">Current Company
                                        Name</label>
                                    <input class="a-input a-input-brand @error('current_company') is-invalid @enderror"
                                           id="current_company" name="company" value="{{ $user->company }}" type="text"
                                           placeholder="Enter current company name..."/>
                                    @error('current_company')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="current_position">Current Position</label>
                                    <input class="a-input a-input-brand @error('current_position') is-invalid @enderror"
                                           id="current_position" name="position" value="{{ $user->position }}"
                                           type="text"
                                           placeholder="Enter current position..."/>
                                    @error('current_position')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="industry">Industry</label>
                                    <input class="a-input a-input-brand @error('industry') is-invalid @enderror"
                                           id="industry" name="industry" value="{{ $user->industry }}" type="text"
                                           placeholder="Enter industry..."/>
                                    @error('industry')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="since">Since</label>
                                    <input class="a-input a-input-brand @error('since') is-invalid @enderror"
                                           type="text" name="work_since" id="since" value="{{ $user->work_since }}"
                                           placeholder="Enter the date from which you work..." autocomplete="off"/>
                                    @error('since')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="btn-bottom">
                            <button class="btn btn-black ml-auto" type="submit" disabled>Save</button>
                        </div>

                    </form>

                </div>
            </div>

            <div class="section-dashboard section-dashboard-profile small-section">
                <span class="small-title">Log out</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <div class="btn-bottom">
                        <button class="button" type="submit">
                            Log out
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.9668 2.72L10.3135 7.06667C10.8268 7.58 10.8268 8.42 10.3135 8.93333L5.9668 13.28"
                                    stroke="#AAB3BC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="section-dashboard section-dashboard-profile small-section">
                <span class="small-title">Delete Account</span>
                <div class="btn-bottom">
                    <button class="button" id="btnModalDeleteAccount">
                        Delete account and data
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.9668 2.72L10.3135 7.06667C10.8268 7.58 10.8268 8.42 10.3135 8.93333L5.9668 13.28"
                                stroke="#AAB3BC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
                {{--                </form>--}}
            </div>
        </div>

        <div class="tab" data-id="tab-subscription">

            <div class="section-dashboard section-dashboard-profile small-section">
                <div class="title">Subscription</div>
                @if(auth()->user()->isTest())
                    <div class="info-table">
                        <div class="info-table__col">
                            <div class="title">Plan</div>
                            <div class="content">You are on test-access</div>
                        </div>
                        @if($user->voucher_expire_at)
                        <div class="info-table__col">
                            <div class="title">Expire At</div>
                            <div class="content">{{ $user->voucher_expire_at->isoFormat('ll') }}</div>
                        </div>
                        @endif
                    </div>
                @else

                    @if($user->hasOneTimePaid())

                        <div class="info-table">
                            <div class="info-table__col">
                                <div class="title">Plan</div>
                                <div class="content">{{ $user->currentPlan->name }}</div>
                            </div>
                            <div class="info-table__col">
                                <div class="title">Status</div>
                                <div class="content">Active</div>
                            </div>
                            <div class="info-table__col">
                                <div class="title">Charged</div>
                                <div class="content">${{ $user->currentPlan->chargePrice->amount }}</div>
                            </div>
                            <div class="info-table__col">
                                <div class="title">Benefits</div>
                                <div class="content">{{ $user->currentPlan->description }}</div>
                            </div>
                        </div>

                    @else

                        @if($subscription)
                            <div class="info-table">
                                <div class="info-table__col">
                                    <div class="title">Plan</div>
                                    <div class="content">{{ $subscription->plan->name }}</div>
                                </div>
                                <div class="info-table__col">
                                    <div class="title">Status</div>
                                    <div
                                        class="content">{{ $subscription->onGracePeriod() ? 'Canceled' : 'Active' }}</div>
                                </div>
                                @if($subscription->onGracePeriod())
                                    <div class="info-table__col">
                                        <div class="title">Ends At</div>
                                        <div class="content">{{ $subscription->ends_at->isoFormat('ll') }}</div>
                                    </div>
                                @endif
                                <div class="info-table__col">
                                    <div class="title">Type of Subscription</div>
                                    <div class="content">{{ $subscription->planPrice->title }}</div>
                                </div>
                                <div class="info-table__col">
                                    <div class="title">Charged</div>
                                    <div class="content">${{ $subscription->planPrice->amount }}</div>
                                </div>
                                <div class="info-table__col">
                                    <div class="title">Benefits</div>
                                    <div class="content">{{ $subscription->plan->description }}</div>
                                </div>
                                <button class="btn-blue-border" id="btnChangeSubscription">Change Subscription</button>
                            </div>
                        @else

                            <div class="info-table">
                                <div class="info-table__col">
                                    <div class="content">You do not have an active subscription!</div>
                                </div>
                                {{--                                <button type="button" class="btn-blue-border"--}}
                                {{--                                        id="btnChangeSubscription">--}}
                                {{--                                     Change Subscriptions--}}
                                {{--                                </button>--}}
                            </div>

                        @endif

                    @endif

                @endif
            </div>

            <div class="section-dashboard section-dashboard-profile small-section">
                <div class="title">Billing</div>
                <div class="info-table">
                    @if($user->activeSubscription)
                        <div class="info-table__col">
                            <div class="title">Next payment</div>
                            <div class="content">{{ $subscription->onGracePeriod()
                            ? 'None'
                            : now()->timestamp($user->activeSubscription->asStripeSubscription()->current_period_end)->isoFormat('ll') }}</div>
                        </div>
                        <div class="info-table__col">
                            <div class="title">Card</div>
                            <div class="content">
                                @if($user->pm_type == 'visa')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path
                                            d="M1 4H23V6H1V4ZM1 18H23V20H1V18ZM19.622 14.914L19.448 14.044H17.499L17.189 14.907L15.627 14.911C16.632 12.504 17.377 10.721 17.863 9.561C17.99 9.259 18.216 9.105 18.548 9.107C18.802 9.109 19.217 9.109 19.793 9.107L21 14.912L19.622 14.915V14.914ZM17.938 12.852H19.194L18.724 10.672L17.938 12.852ZM7.872 9.106L9.442 9.108L7.015 14.914L5.425 14.913C4.888 12.843 4.493 11.307 4.241 10.308C4.164 10.001 4.011 9.787 3.715 9.686C3.452 9.596 3.014 9.456 2.4 9.267V9.107H4.909C5.343 9.107 5.596 9.317 5.678 9.747L6.298 13.036L7.872 9.106ZM11.599 9.108L10.359 14.913L8.864 14.911L10.104 9.106L11.599 9.108ZM14.631 9C15.077 9 15.641 9.138 15.965 9.267L15.703 10.471C15.41 10.353 14.928 10.194 14.523 10.201C13.933 10.21 13.569 10.457 13.569 10.694C13.569 11.078 14.201 11.272 14.853 11.693C15.596 12.173 15.693 12.603 15.685 13.071C15.674 14.042 14.853 15 13.12 15C12.329 14.988 12.044 14.922 11.4 14.694L11.672 13.438C12.328 13.712 12.607 13.799 13.167 13.799C13.682 13.799 14.123 13.592 14.127 13.231C14.129 12.974 13.972 12.847 13.395 12.529C12.818 12.212 12.009 11.773 12.02 10.889C12.033 9.759 13.108 9 14.631 9Z"
                                            fill="#3199FF"/>
                                    </svg>
                                @elseif($user->pm_type == 'mastercard')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 192.756 192.756">
                                        <g fill-rule="evenodd" clip-rule="evenodd">
                                            <path fill="#fff" d="M0 0h192.756v192.756H0V0z"/>
                                            <path fill="#1b3771" d="M8.504 151.977h175.748V40.78H8.504v111.197z"/>
                                            <path
                                                d="M96.52 131.904c8.48 7.729 19.883 12.439 32.229 12.439 26.574 0 48.059-21.486 48.059-48.061 0-26.479-21.484-48.059-48.059-48.059-12.346 0-23.748 4.712-32.229 12.439-9.707 8.857-15.832 21.485-15.832 35.62 0 14.138 6.125 26.859 15.832 35.622z"
                                                fill="#e9b040"/>
                                            <path
                                                d="M170.4 123.047c0-.848.658-1.508 1.602-1.508.848 0 1.508.66 1.508 1.508s-.66 1.602-1.508 1.602a1.589 1.589 0 0 1-1.602-1.602zm1.602 1.224c.564 0 1.131-.564 1.131-1.225s-.566-1.131-1.131-1.131c-.66 0-1.225.471-1.225 1.131s.565 1.225 1.225 1.225zm-.283-.47h-.283v-1.414h.566c.094 0 .283 0 .377.094.094.096.188.189.188.283 0 .189-.094.377-.281.377l.281.66h-.377l-.188-.566h-.283v.566zm0-.848h.377c.094 0 .094-.096.094-.189 0 0 0-.094-.094-.094h-.377v.283z"
                                                fill="#e9b040"/>
                                            <path
                                                d="M112.068 91.195a47.818 47.818 0 0 0-.848-5.088H81.819a51.097 51.097 0 0 1 1.414-5.089h26.574a56.747 56.747 0 0 0-1.979-5.089H85.211a68.395 68.395 0 0 1 2.827-5.089H105a31.658 31.658 0 0 0-3.674-5.088h-9.613c1.414-1.791 3.11-3.487 4.806-5.088-8.481-7.728-19.79-12.439-32.229-12.439-26.574 0-48.06 21.58-48.06 48.059 0 26.574 21.486 48.061 48.06 48.061 12.439 0 23.747-4.711 32.229-12.439 1.695-1.602 3.393-3.297 4.9-5.088h-9.707a50.187 50.187 0 0 1-3.675-5.088H105a44.338 44.338 0 0 0 2.828-5.09H85.211a40.765 40.765 0 0 1-1.979-5.088h26.574a51.661 51.661 0 0 0 1.414-5.09c.377-1.695.658-3.393.848-5.088a45.936 45.936 0 0 0 0-10.179z"
                                                fill="#cc2131"/>
                                            <path
                                                d="M170.4 107.404c0-.848.658-1.508 1.602-1.508.848 0 1.508.66 1.508 1.508s-.66 1.602-1.508 1.602a1.588 1.588 0 0 1-1.602-1.602zm1.602 1.225c.564 0 1.131-.566 1.131-1.225 0-.66-.566-1.131-1.131-1.131-.66 0-1.225.471-1.225 1.131 0 .658.565 1.225 1.225 1.225zm-.283-.471h-.283v-1.414h.566c.094 0 .283 0 .377.094.094.096.188.189.188.283 0 .189-.094.377-.281.377l.281.66h-.377l-.188-.566h-.283v.566zm0-.847h.377c.094 0 .094-.096.094-.189 0 0 0-.094-.094-.094h-.377v.283z"
                                                fill="#fff"/>
                                            <path
                                                d="M80.217 110.137c-1.602.471-2.733.66-3.958.66-2.45 0-3.958-1.508-3.958-4.336 0-.564.094-1.131.188-1.789l.282-1.885.283-1.604 2.262-13.569h4.994l-.565 3.015h3.11l-.754 4.995h-3.109l-1.414 8.104c0 .283-.094.564-.094.754 0 1.037.565 1.508 1.791 1.508.66 0 1.037-.094 1.602-.189l-.66 4.336zM96.331 109.947a17.74 17.74 0 0 1-5.372.85c-5.56 0-8.858-3.016-8.858-8.859 0-6.784 3.864-11.873 9.141-11.873 4.241 0 6.973 2.827 6.973 7.256 0 1.414-.188 2.828-.658 4.9H87.19v.566c0 2.355 1.508 3.486 4.523 3.486 1.885 0 3.581-.377 5.466-1.225l-.848 4.899zm-3.11-11.779v-.941c0-1.602-.942-2.544-2.45-2.544-1.696 0-2.827 1.225-3.298 3.486h5.748v-.001zM40.355 110.42h-5.183l3.016-18.753-6.691 18.753h-3.58l-.377-18.659-3.205 18.659h-4.994l4.052-24.408h7.444l.284 15.078 4.994-15.078h8.293l-4.053 24.408zM52.889 101.561c-.565 0-.66-.094-1.037-.094-2.921 0-4.429 1.131-4.429 3.016 0 1.318.753 2.074 1.884 2.074 2.545 0 3.487-2.075 3.582-4.996zm4.146 8.859h-4.523l.094-2.074c-1.131 1.602-2.639 2.451-5.466 2.451-2.544 0-4.617-2.262-4.617-5.467 0-.941.188-1.789.376-2.543.848-3.111 3.958-4.996 8.67-5.09.565 0 1.508 0 2.261.094.188-.658.188-.941.188-1.318 0-1.319-1.036-1.696-3.486-1.696-1.508 0-3.109.283-4.335.565l-.659.283h-.377l.754-4.429c2.45-.754 4.146-1.037 6.031-1.037 4.523 0 6.879 1.979 6.879 5.843 0 .941.094 1.695-.283 3.863l-1.036 7.068-.188 1.225-.188 1.035v.66l-.095.567zM121.398 90.819c1.412 0 2.732.376 4.617 1.319l.848-5.372c-.471-.188-.566-.188-1.225-.471l-2.168-.471c-.66-.188-1.414-.282-2.355-.282-2.545 0-4.053 0-5.654 1.036-.848.471-1.885 1.225-3.109 2.545l-.566-.189-5.371 3.77.283-2.073h-5.561l-3.109 19.79h5.184l1.885-10.648s.754-1.508 1.131-1.98c.941-1.225 1.789-1.225 2.826-1.225h.377c-.094 1.131-.189 2.451-.189 3.77 0 6.502 3.676 10.555 9.33 10.555 1.414 0 2.639-.189 4.523-.754l.941-5.561c-1.695.85-3.109 1.225-4.428 1.225-3.016 0-4.807-2.166-4.807-5.936 0-5.279 2.638-9.048 6.597-9.048zM165.404 86.012l-1.131 6.974c-1.225-1.885-2.732-2.733-4.711-2.733-2.732 0-5.277 1.508-6.879 4.429l-3.299-1.979.283-2.073h-5.561l-3.203 19.79h5.277l1.695-10.648s1.32-1.508 1.697-1.98c.754-.941 1.602-1.225 2.262-1.225a18.507 18.507 0 0 0-.943 5.844c0 4.994 2.639 8.291 6.408 8.291 1.885 0 3.393-.658 4.807-2.26l-.283 1.979h4.994l3.959-24.408h-5.372v-.001zm-6.312 19.695c-1.791 0-2.639-1.225-2.639-3.863 0-3.863 1.602-6.69 4.051-6.69 1.791 0 2.734 1.413 2.734 3.958 0 3.863-1.697 6.595-4.146 6.595zM135.061 101.561c-.564 0-.658-.094-1.035-.094-2.922 0-4.43 1.131-4.43 3.016 0 1.318.754 2.074 1.885 2.074 2.544 0 3.486-2.075 3.58-4.996zm4.146 8.859h-4.521l.094-2.074c-1.131 1.602-2.639 2.451-5.467 2.451-2.543 0-4.805-2.168-4.805-5.467.094-4.711 3.58-7.633 9.234-7.633.566 0 1.508 0 2.262.094.189-.658.189-.941.189-1.318 0-1.319-1.037-1.696-3.488-1.696-1.508 0-3.203.283-4.334.565l-.754.283h-.283l.754-4.429c2.451-.754 4.146-1.037 6.031-1.037 4.523 0 6.879 1.979 6.879 5.843 0 .941.094 1.695-.283 3.863l-1.035 7.068-.189 1.225-.188 1.035-.096.66v.567zM67.872 94.871c1.037 0 2.45.094 3.958.283l.754-4.618c-1.508-.188-3.486-.377-4.711-.377-5.749 0-7.727 3.11-7.727 6.785 0 2.355 1.13 4.146 3.863 5.371 2.167 1.037 2.544 1.227 2.544 2.074 0 1.225-1.131 1.979-3.204 1.979-1.507 0-2.921-.283-4.618-.754l-.565 4.523h.095l.942.189c.282.094.754.188 1.319.188 1.319.188 2.355.188 3.015.188 5.749 0 8.199-2.166 8.199-6.596 0-2.732-1.319-4.334-3.958-5.465-2.167-1.037-2.45-1.131-2.45-2.074 0-.942.942-1.696 2.544-1.696z"
                                                fill="#1b3771"/>
                                            <path
                                                d="M128.277 85.259l-.85 5.277c-1.885-.942-3.203-1.319-4.617-1.319-3.957 0-6.689 3.77-6.689 9.141 0 3.676 1.885 5.936 4.898 5.936 1.32 0 2.734-.375 4.43-1.225l-.941 5.561c-1.885.471-3.109.66-4.617.66-5.561 0-9.047-3.959-9.047-10.461 0-8.764 4.805-14.794 11.684-14.794.943 0 1.697.094 2.357.188l2.166.565c.66.282.754.282 1.226.471zM111.598 88.934c-.189-.094-.377-.094-.566-.094-1.695 0-2.639.848-4.24 3.204l.471-3.016h-4.805l-3.111 19.884h5.184c1.885-12.156 2.355-14.23 4.9-14.23h.377c.471-2.356 1.037-4.146 1.979-5.749h-.189v.001zM81.536 108.629c-1.414.471-2.544.66-3.77.66-2.639 0-4.146-1.508-4.146-4.336 0-.564.094-1.131.188-1.789l.282-1.98.283-1.508 2.262-13.569h5.183l-.565 2.921h2.639l-.754 4.9H80.5l-1.414 8.199c0 .377-.094.66-.094.848 0 1.037.565 1.508 1.791 1.508.66 0 1.037-.094 1.414-.189l-.661 4.335zM61.464 95.342c0 2.449 1.225 4.24 3.958 5.465 2.167 1.037 2.45 1.32 2.45 2.262 0 1.225-.942 1.791-3.016 1.791-1.508 0-2.921-.283-4.618-.848l-.754 4.617h.283l.943.189a4.37 4.37 0 0 0 1.319.188c1.225.094 2.262.188 2.921.188 5.466 0 8.01-2.072 8.01-6.596 0-2.732-1.036-4.334-3.675-5.561-2.168-.941-2.45-1.224-2.45-2.072 0-1.131.848-1.696 2.544-1.696 1.037 0 2.45.188 3.769.377l.754-4.618c-1.319-.188-3.393-.377-4.617-.377-5.842 0-7.821 3.016-7.821 6.691zM168.139 108.912h-4.994l.281-1.979c-1.414 1.508-2.922 2.166-4.807 2.166-3.768 0-6.312-3.203-6.312-8.197 0-6.597 3.863-12.157 8.48-12.157 2.074 0 3.582.848 4.994 2.733l1.131-6.974h5.184l-3.957 24.408zm-7.729-4.713c2.451 0 4.146-2.732 4.146-6.689 0-2.451-.941-3.864-2.732-3.864-2.355 0-4.053 2.732-4.053 6.69 0 2.545.848 3.863 2.639 3.863zM97.461 108.441c-1.79.564-3.486.848-5.371.848-5.843 0-8.858-3.111-8.858-8.859 0-6.878 3.864-11.873 9.141-11.873 4.241 0 6.973 2.827 6.973 7.256 0 1.414-.188 2.828-.564 4.9H88.416c-.095.283-.095.377-.095.566 0 2.262 1.508 3.486 4.618 3.486 1.791 0 3.487-.377 5.372-1.225l-.85 4.901zm-2.92-11.781v-1.036c0-1.602-.849-2.544-2.45-2.544s-2.827 1.319-3.298 3.58h5.748zM41.675 108.912h-5.183l3.015-18.753-6.691 18.753h-3.58l-.377-18.659-3.204 18.659h-4.806l4.052-24.408h7.444l.283 15.078 4.995-15.078h8.104l-4.052 24.408zM54.585 100.053c-.566-.094-.848-.094-1.225-.094-2.921 0-4.429 1.037-4.429 3.016 0 1.225.753 2.074 1.884 2.074 2.168 0 3.676-2.074 3.77-4.996zm3.769 8.859h-4.335l.095-2.074c-1.319 1.604-3.016 2.355-5.466 2.355-2.827 0-4.712-2.166-4.712-5.371 0-4.805 3.299-7.633 9.141-7.633.565 0 1.319 0 2.073.094.188-.565.188-.847.188-1.224 0-1.319-.848-1.791-3.298-1.791-1.508 0-3.204.188-4.335.565l-.754.188-.471.094.754-4.429c2.638-.754 4.334-1.037 6.219-1.037 4.523 0 6.879 1.979 6.879 5.749 0 1.037-.095 1.79-.472 3.958l-1.036 7.068-.188 1.225-.095 1.035-.094.66-.093.568zM136.758 100.053c-.564-.094-.848-.094-1.225-.094-2.922 0-4.43 1.037-4.43 3.016 0 1.225.754 2.074 1.885 2.074 2.073 0 3.676-2.074 3.77-4.996zm3.769 8.859h-4.334l.094-2.074c-1.32 1.604-3.109 2.355-5.467 2.355-2.826 0-4.805-2.166-4.805-5.371 0-4.805 3.393-7.633 9.234-7.633.564 0 1.32 0 2.072.094.189-.565.189-.847.189-1.224 0-1.319-.848-1.791-3.299-1.791-1.508 0-3.203.188-4.334.565l-.754.188-.471.094.754-4.429c2.637-.754 4.334-1.037 6.219-1.037 4.523 0 6.879 1.979 6.879 5.749 0 1.037-.094 1.79-.471 3.958l-1.037 7.068-.188 1.225-.189 1.035-.094.66v.568h.002zM154.475 88.934c-.096-.094-.283-.094-.473-.094-1.695 0-2.732.848-4.334 3.204l.471-3.016h-4.711l-3.205 19.884h5.277c1.791-12.156 2.357-14.23 4.807-14.23h.377c.471-2.356 1.131-4.146 1.979-5.749h-.188v.001z"
                                                fill="#fff"/>
                                        </g>
                                    </svg>
                                @endif
                                **** **** **** {{ $user->pm_last_four }}
                            </div>
                        </div>
                        <div class="info-table__col">
                            <div class="title">Name on the card</div>
                            <div class="content">{{ $user->pm_cardholder_name }}</div>
                        </div>
                        <div class="info-table__col">
                            <div class="title">Billing address</div>
                            <div class="content">{{ $user->pm_billing_address }}</div>
                        </div>
                        <button class="btn-blue-border" id="btnPaymentMethods">Edit Payment details</button>
                    @else
                        <div class="info-table__col">
                            <div class="content">There are no billing details</div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="section-dashboard section-dashboard-profile small-section">
                <span class="small-title">Billing History</span>

                <div class="btn-bottom">
                    <button class="button" type="button"
                            onclick="location.href = '{{ route('user.profile.download-invoices') }}'">
                        Download billing history
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.9668 2.72L10.3135 7.06667C10.8268 7.58 10.8268 8.42 10.3135 8.93333L5.9668 13.28"
                                stroke="#AAB3BC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>

            @if($user->activeSubscription)
                <div class="section-dashboard section-dashboard-profile small-section">
                    <span class="small-title">Subscription management</span>

                    <div class="btn-bottom">
                        @if($subscription->onGracePeriod())
                            <form action="{{ route('user.subscription.resume', $subscription) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="button" onclick="return confirm('Are you sure?')">
                                    Resume Subscription
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.9668 2.72L10.3135 7.06667C10.8268 7.58 10.8268 8.42 10.3135 8.93333L5.9668 13.28"
                                            stroke="#AAB3BC" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </form>
                        @else
                            <button class="button" id="btnModalCanselSubscription">
                                Cancel Subscription
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.9668 2.72L10.3135 7.06667C10.8268 7.58 10.8268 8.42 10.3135 8.93333L5.9668 13.28"
                                        stroke="#AAB3BC" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($subscription)
    <div class="a-modal" id="modalSubscription">
        <div class="a-modal__wrapper">
            <form action="{{ route('user.subscription.change', $subscription) }}" method="POST">
                @csrf
                @method('PUT')
            <div class="a-modal__header">
                <div class="title">Subscription</div>
                <div class="description">We warn you that you will be billed (to change text)</div>
            </div>
            <div class="a-modal__content">
                    <div class="subscription-choice">

                        @foreach($plans as $plan)
                            @foreach($plan->prices as $plan_price)
                            <div class="subscription-choice__item @if($subscription && $subscription->planPrice->id == $plan_price->id) active @endif">
                                <div class="period-box">
                                    <div class="period">
                                        <p>
                                            <input type="radio" id="monthly" name="price" value="{{ $plan_price->stripe_price_id }}" @checked($subscription && $subscription->planPrice->id == $plan_price->id)>
                                            <label for="monthly">{{ $plan_price->title . ' | ' . $plan->name }}</label>
                                        </p>
                                    </div>
                                    <div class="price">
                                        ${{ $plan_price->amount }}
                                        @if($plan_price->interval == \App\Models\PlanPrice::INTERVAL_YEAR)
                                            <span>${{ round(($plan_price->amount / 12), 2) }}/m0</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="description">
                                    {{ $plan->description }}
                                </div>
                            </div>
                            @endforeach
                        @endforeach

                    </div>
            </div>
            <div class="a-modal__footer">
                <button type="button" class="button-clear modal-close">Cancel</button>
                <button type="submit" class="button-blue">Save</button>
            </div>
            </form>
        </div>
    </div>
    @endif

    <div class="a-modal" id="modalPaymentMethods">
        <div class="a-modal__wrapper">
            <form action="{{ route('user.payment-method.update') }}"
                  id="subscriptionForm"
                  method="POST">
            <div class="a-modal__header">
                <div class="title">Payment Methods</div>
                <div class="description">Edit your payment method</div>
            </div>
            <div class="a-modal__content">
                    @csrf
                    @method('PUT')
                <div class="a-form__section">
                    <input type="hidden" id="stripeKey" value="{{ $stripe_key }}">
                    @include('user.subscription._payment-methods', ['user' => auth()->user(), 'user_payment_methods' => $user_payment_methods, 'user_default_payment_method' => $user_default_payment_method])
                </div>
            </div>
            <div class="a-modal__footer">
                <button class="button-clear modal-close">Cancel</button>
                <button class="button-blue">Save</button>
            </div>
            </form>
        </div>
    </div>

    <div class="a-modal" id="modalDeleteAccount">
        <div class="a-modal__wrapper">
            <form action="{{ route('user.profile.destroy') }}" method="POST">
                <div class="a-modal__header">
                    <div class="title">Delete account</div>
                    <div class="description">Are you sure, that you want to delete? it can not be undone.<br>
                        Please, enter your password to confirm.
                    </div>
                </div>
                <div class="a-modal__content">
                    @csrf
                    @method('DELETE')
                    <div class="a-form__section">
                        <div class="a-form__item">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="password">Password</label>
                                <input class="a-input a-input-brand @error('password') is-invalid @enderror"
                                       id="password" name="password" type="password"
                                       placeholder="Enter password" required/>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="a-modal__footer">
                    <button type="button" class="button-clear modal-close delete">Cancel</button>
                    <button type="submit" class="button-blue delete">Yes, delete</button>
                </div>
            </form>
        </div>
    </div>

    @if($user->activeSubscription)
        <div class="a-modal" id="modalCanselSubscription">
            <div class="a-modal__wrapper">
                <form action="{{ route('user.subscription.cancel', $subscription) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="a-modal__header">
                        <div class="title">Cancel Subscription</div>
                        <div class="description">
                            Are you sure, that you want to cancel subscription? Full access to the service will be lost
                            just now.
                            <br>
                            Please, enter your password to confirm.
                        </div>
                    </div>
                    <div class="a-modal__content">
                        <div class="a-form__section">
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="password">Password</label>
                                    <input class="a-input a-input-brand @error('password') is-invalid @enderror"
                                           id="password" name="password" type="password"
                                           placeholder="Enter password" required/>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="a-modal__footer">
                        <button type="button" class="button-clear modal-close delete">No, Close</button>
                        <button type="submit" id="card-button" class="button-blue delete" data-secret="{{ $intent->client_secret }}">Yes, Cancel Subscription</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="overlay-modal"></div>

@endsection

@push('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="{{ asset('/js/jquery-3.7.0.min.js') }}"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/jquery-country-selector@2.0.1/src/js/jquery.countrySelector.min.js"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/subscription.js') }}"></script>
    <script src="{{ asset('js/search-city.js') }}"></script>
@endpush
