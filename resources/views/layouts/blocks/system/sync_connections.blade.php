<div class="section-dashboard section-dashboard-preparation">
    <form class="progress-tracking submit-disabled networking-preparation-form"
          action="{{ route('user.contacts.import') }}"
          enctype="multipart/form-data"
          method="POST">
        @csrf
    <div class="section-dashboard-title js-section-dashboard-title flex flex-between">
        <div class="title-box flex flow-column">
            <h2>{{ $block->title }}</h2>
            <p class="inter fw-regular fz-012 dark">{{ $block->sub_title }}</p>
        </div>
    </div>

    <div class="section-dashboard-content js-section-dashboard-content flex flow-column">
        <div class="a-form__section">
            <div class="extract">
                @if(isset($block->additional_content['inline_text']))
                <div class="extract-top flex align-center inter fw-regular fz-012">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11 11V17H13V11H11ZM11 7V9H13V7H11Z"
                            fill="black"/>
                    </svg>
                    <span>{{ $block->additional_content['inline_text'] }}</span>
                </div>
                @endif
                <div class="extract-wrapper">
                    <div class="extract-mobile-close">
                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.63595 5.08583L11.5857 0.136047L12.9999 1.55026L8.05015 6.50003L12.9999 11.4497L11.5857 12.8639L6.63595 7.91423L1.68618 12.8639L0.271973 11.4497L5.22175 6.50003L0.271973 1.55026L1.68618 0.136047L6.63595 5.08583Z"
                                fill="black"/>
                        </svg>
                    </div>
                    {!! $block->content !!}
                </div>
                <div class="extract-bottom">
                    <label for="extractFile"
                           class="extract-button-label flex align-center justify-center">
                        <svg width="29" height="28" viewBox="0 0 29 28" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_243_12073)">
                                <path
                                    d="M22.124 21.7768L23.7736 23.4265L20.0403 27.1598C19.4991 27.6992 18.7662 28.002 18.0021 28.002C17.2381 28.002 16.5052 27.6992 15.964 27.1598L12.2306 23.4265L13.8803 21.7768L16.8331 24.7332V15.1665H19.1665V24.7332L22.124 21.7768ZM21.2548 8.41035C20.7343 6.18314 19.414 4.22461 17.5447 2.9066C15.6754 1.58859 13.3872 1.00288 11.1145 1.26066C8.84185 1.51844 6.74296 2.60176 5.21634 4.30496C3.68971 6.00815 2.84164 8.21263 2.83315 10.4998C2.832 11.9913 3.19228 13.4609 3.88315 14.7827C2.62446 15.4572 1.62728 16.533 1.05003 17.8391C0.47279 19.1453 0.348594 20.6069 0.697179 21.9917C1.04576 23.3765 1.84713 24.6051 2.97397 25.4823C4.1008 26.3595 5.48846 26.835 6.91648 26.8332H12.3321L9.99881 24.4998H6.91648C5.92297 24.5028 4.96264 24.1425 4.21625 23.4868C3.46985 22.8311 2.98888 21.9252 2.86385 20.9396C2.73882 19.954 2.97836 18.9566 3.53739 18.1353C4.09641 17.314 4.93637 16.7254 5.89915 16.4802L7.57565 16.0473L6.54548 14.6567C5.64847 13.4566 5.16463 11.9981 5.16648 10.4998C5.18173 8.73485 5.86318 7.04077 7.07438 5.75686C8.28558 4.47295 9.93711 3.69399 11.6982 3.57598C13.4593 3.45797 15.2 4.00963 16.5717 5.12047C17.9433 6.23131 18.8447 7.81933 19.0953 9.56651L19.212 10.4508L20.0975 10.5675C21.2723 10.7233 22.3882 11.1755 23.3401 11.8814C24.292 12.5873 25.0488 13.5238 25.539 14.6027C26.0293 15.6816 26.2371 16.8676 26.1428 18.0489C26.0484 19.2303 25.6551 20.3682 24.9998 21.3557L26.6681 23.024C27.5892 21.7809 28.1859 20.3278 28.404 18.7961C28.6221 17.2645 28.4549 15.7025 27.9175 14.2517C27.3801 12.8009 26.4894 11.507 25.3261 10.4871C24.1627 9.46716 22.7634 8.75338 21.2548 8.41035Z"
                                    fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_243_12073">
                                    <rect width="28" height="28" fill="white"
                                          transform="translate(0.5)"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>{{ $block->additional_content['button'] ?? 'Import CSV with Connections' }}</span>
                    </label>
                    <br>
                    <input type="file"
                           class="@error('import_connections') is-invalid @enderror"
                           id="extractFile" name="import_connections">
                    <span class="invalid-feedback" role="alert">
                                    @error('import_connections')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                    </span>
                </div>
            </div>

            <div class="content-item">
                <div class="decor-title neue-bold fz-016 dark">List other connections (not in LinkedIn)
                </div>
                <div class="a-form__item">
                    <div class="a-form__item-box">
                        <div>
                            <label class="inter fw-semibold fz-014 dark">First Name</label>
                            <input
                                class="a-input a-input-brand @error('first_name.0') is-invalid @enderror"
                                id="first_name" name="first_name[0]"
                                value="{{ old('first_name.0') }}"
                                type="text" placeholder="Enter First Name..."/>
                            @error('first_name.0')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div>
                            <label class="inter fw-semibold fz-014 dark">Last Name</label>
                            <input
                                class="a-input a-input-brand @error('last_name.0') is-invalid @enderror"
                                id="last_name" name="last_name[0]"
                                value="{{ old('last_name.0') }}" type="text"
                                placeholder="Enter Last Name..."/>
                            @error('last_name.0')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        @if(is_array(old('first_name')))
                            @foreach(old('first_name') as $i => $first_name)
                                @continue($i == 0)
                                <div class="multiple-input-deletable with-label has-many">
                                    <div>
                                        <label class="inter fw-semibold fz-014 dark">First Name</label>
                                        <input
                                            class="a-input a-input-brand @error("first_name.$i") is-invalid @enderror"
                                            id="first_name" name="first_name[{{ $i }}]"
                                            value="{{ $first_name }}"
                                            type="text" placeholder="Enter First Name..."/>
                                        @error("first_name.$i")
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="inter fw-semibold fz-014 dark">Last Name</label>
                                        <input
                                            class="a-input a-input-brand @error("last_name.$i") is-invalid @enderror"
                                            id="last_name" name="last_name[{{ $i }}]"
                                            value="{{ old("last_name.$i") }}"
                                            type="text" placeholder="Enter Last Name..."/>
                                        @error("last_name.$i")
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                        @enderror
                                    </div>
                                    <span class="delete"></span>
                                </div>
                            @endforeach
                        @endif

                        <button type="button" data-name="synchronization[first_name]"
                                class="a-form__item-box__add-more flex align-center add-input input-has-name">
                            Add New Contact
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="black"/>
                            </svg>
                        </button>

                        <template>
                            <div class="multiple-input-deletable with-label has-many">
                                <div>
                                    <label class="inter fw-semibold fz-014 dark">First Name</label>
                                    <input class="a-input a-input-brand"
                                           id="first_name" name="synchronization[first_name]" value=""
                                           type="text" placeholder="Enter First Name..."/>
                                </div>

                                <div>
                                    <label class="inter fw-semibold fz-014 dark">Last Name</label>
                                    <input class="a-input a-input-brand"
                                           id="last_name" name="synchronization[last_name]" value=""
                                           type="text" placeholder="Enter Last Name..."/>
                                </div>
                                <span class="delete"></span>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="btn-bottom">
                    <button class="btn btn-black ml-auto" type="submit" disabled>Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="decoration-line"></div>
    </form>
</div>


<div class="modal-custom modal-success">
    <div class="modal-wrapper">
        <button class="close-modal">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.63595 5.08583L11.5857 0.136047L12.9999 1.55026L8.05015 6.50003L12.9999 11.4497L11.5857 12.8639L6.63595 7.91423L1.68618 12.8639L0.271973 11.4497L5.22175 6.50003L0.271973 1.55026L1.68618 0.136047L6.63595 5.08583Z"
                    fill="black"/>
            </svg>
        </button>
        <h4 class="modal-title">Success</h4>
        <p class="modal-description">Your file has been uploaded successfully</p>
    </div>
</div>
