@php($form = $block->model->load(['rows', 'rows.fields', 'rows.fields.values']))
@if($form)
    <form class="@if($form->is_progressible) progress-tracking @endif a-form submit-disabled"
          action="{{ route('user.form.store', $form) }}" method="POST" enctype="multipart/form-data"
          @if($form->is_progressible) data-sub-forms="formBlock{{ $form->id }}" @endif>
        @csrf
        <div class="section-dashboard section-dashboard-self">
            <div class="section-dashboard-title flex flex-between">
                <div class="title-box flex flow-column">
                    <h2>{{ $form->title }}</h2>
                    @if($block->sub_title)
                        <p class="inter fw-regular fz-012 dark">{{ $block->sub_title }}</p>
                    @elseif($form->sub_title)
                        <p class="inter fw-regular fz-012 dark">{{ $form->sub_title }}</p>
                    @endif
                </div>
                @if($form->is_progressible)
                    <div class="a-progress-bar" data-form="formBlock{{ $form->id }}">
                        <div class="a-progress-bar-percent inter fw-medium fz-012"><span class="count">0</span>%
                            <span>done</span>
                        </div>
                        <div class="progress">
                            <div class="bar" style="width:0"></div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="section-dashboard-content flex flow-column " id="formBlock{{ $form->id }}">
                @if(!empty($form->goals))
                    <div class="goals-mobile"></div>
                    <div class="goals">
                        <div class="goals-wrapper flex">
                            <div class="goals-box flex flow-column">
                                @foreach($form->goals as $i => $goal)
                                    @continue($i % 2 !== 0)
                                    <div class="goals-item inter fw-regular fz-012 dark flex">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_243_11100)">
                                                <path
                                                    d="M12 0C13.8614 0 15.6228 0.424057 17.1967 1.18043C16.5525 1.69011 15.9551 2.17941 15.3986 2.65036C14.3384 2.26504 13.1947 2.05505 12.002 2.05505C9.25586 2.05505 6.7686 3.1682 4.97044 4.9684C3.17023 6.7686 2.05708 9.25382 2.05708 12C2.05708 14.7462 3.17023 17.2314 4.97044 19.0316C6.77064 20.8318 9.25586 21.945 12.002 21.945C14.7482 21.945 17.2355 20.8318 19.0336 19.0316C20.8338 17.2314 21.947 14.7462 21.947 12C21.947 11.3476 21.8838 10.7074 21.7635 10.0897C22.2793 9.41692 22.8073 8.74618 23.3476 8.08155C23.7717 9.30887 24.002 10.6279 24.002 12C24.002 15.3129 22.6585 18.314 20.4873 20.4852C18.316 22.6565 15.315 24 12.002 24C8.68909 24 5.68807 22.6565 3.51682 20.4852C1.34353 18.314 0 15.3129 0 12C0 8.68705 1.34353 5.68603 3.51478 3.51478C5.68603 1.34353 8.68705 0 12 0ZM6.40979 10.0285L9.33741 9.98981L9.55556 10.0469C10.1468 10.3874 10.7034 10.7768 11.2232 11.2171C11.5984 11.5352 11.9572 11.8818 12.2977 12.2569C13.3476 10.5668 14.4669 9.01529 15.6493 7.58818C16.9439 6.02446 18.318 4.6055 19.7615 3.31091L20.0469 3.20082H23.2416L22.5973 3.91641C20.6177 6.11621 18.8216 8.3894 17.1988 10.7339C15.5759 13.0805 14.1244 15.5025 12.8338 17.9959L12.4322 18.7706L12.0632 17.9816C11.3823 16.5199 10.5668 15.1784 9.59429 13.9796C8.62181 12.7808 7.49032 11.7166 6.17125 10.8114L6.40979 10.0285Z"
                                                    fill="#728FF5"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_243_11100">
                                                    <rect width="24" height="24" fill="white"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        {{ $goal }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="goals-box flex flow-column">
                                @foreach($form->goals as $i => $goal)
                                    @continue($i % 2 === 0)
                                    <div class="goals-item inter fw-regular fz-012 dark flex">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_243_11100)">
                                                <path
                                                    d="M12 0C13.8614 0 15.6228 0.424057 17.1967 1.18043C16.5525 1.69011 15.9551 2.17941 15.3986 2.65036C14.3384 2.26504 13.1947 2.05505 12.002 2.05505C9.25586 2.05505 6.7686 3.1682 4.97044 4.9684C3.17023 6.7686 2.05708 9.25382 2.05708 12C2.05708 14.7462 3.17023 17.2314 4.97044 19.0316C6.77064 20.8318 9.25586 21.945 12.002 21.945C14.7482 21.945 17.2355 20.8318 19.0336 19.0316C20.8338 17.2314 21.947 14.7462 21.947 12C21.947 11.3476 21.8838 10.7074 21.7635 10.0897C22.2793 9.41692 22.8073 8.74618 23.3476 8.08155C23.7717 9.30887 24.002 10.6279 24.002 12C24.002 15.3129 22.6585 18.314 20.4873 20.4852C18.316 22.6565 15.315 24 12.002 24C8.68909 24 5.68807 22.6565 3.51682 20.4852C1.34353 18.314 0 15.3129 0 12C0 8.68705 1.34353 5.68603 3.51478 3.51478C5.68603 1.34353 8.68705 0 12 0ZM6.40979 10.0285L9.33741 9.98981L9.55556 10.0469C10.1468 10.3874 10.7034 10.7768 11.2232 11.2171C11.5984 11.5352 11.9572 11.8818 12.2977 12.2569C13.3476 10.5668 14.4669 9.01529 15.6493 7.58818C16.9439 6.02446 18.318 4.6055 19.7615 3.31091L20.0469 3.20082H23.2416L22.5973 3.91641C20.6177 6.11621 18.8216 8.3894 17.1988 10.7339C15.5759 13.0805 14.1244 15.5025 12.8338 17.9959L12.4322 18.7706L12.0632 17.9816C11.3823 16.5199 10.5668 15.1784 9.59429 13.9796C8.62181 12.7808 7.49032 11.7166 6.17125 10.8114L6.40979 10.0285Z"
                                                    fill="#728FF5"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_243_11100">
                                                    <rect width="24" height="24" fill="white"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        {{ $goal }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <div class="@if($form->rows->where(fn($q) => $q->fields->where('type', \App\Models\FormField::TYPE_TEXTAREA)->isNotEmpty())->isNotEmpty()) story-form @else content-item @endif">
                    @foreach($form->rows as $row)
                        @if($row->type == \App\Models\FormRow::TYPE_DIVIDER)
                            <div class="border"></div>
                        @elseif($row->type == \App\Models\FormRow::TYPE_CAREER_DIRECTION_HORIZONTAL)
                            <div class="a-form__section">
                                @foreach($row->fields as $field)
                                    @include('layouts.blocks.form.form-elements.field')
                                @endforeach
                            </div>
                        @elseif($row->type == \App\Models\FormRow::TYPE_CHOOSE_HORIZONTAL)
                            <div class="choose-wrapper">
                                @foreach($row->fields as $field)
                                    @include('layouts.blocks.form.form-elements.field')
                                @endforeach
                            </div>
                        @elseif($row->type == \App\Models\FormRow::TYPE_CHOOSE_VERTICAL)
                            <div class="choose-wrapper two-column">
                                @foreach(['left', 'right'] as $align)
                                    <div class="choose-wrapper-box">
                                    @foreach($row->fields->where('align', $align) as $field)
                                        @include('layouts.blocks.form.form-elements.field')
                                    @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @else
                        <div
                            class="a-form__section @if($row->fields->where('type', \App\Models\FormField::TYPE_FAT_INPUT)->isNotEmpty()) fat @endif @if($row->type == \App\Models\FormRow::TYPE_VERTICAL) a-form__section-target @endif">

                            @if($row->type == \App\Models\FormRow::TYPE_VERTICAL)

                                @foreach(['left', 'right'] as $align)
                                    <div class="a-form__item">
                                        @foreach($row->fields as $field)
                                            @continue($field->align != $align)

                                            @include('layouts.blocks.form.form-elements.field')

                                        @endforeach
                                    </div>
                                @endforeach

                            @else

                                @if($row->fields->whereIn('type', [\App\Models\FormField::TYPE_FAT_INPUT, \App\Models\FormField::TYPE_FREE_FORM])->isNotEmpty())
                                        @foreach($row->fields as $field)
                                            @include('layouts.blocks.form.form-elements.field')
                                        @endforeach
                                @else
                                    @foreach($row->fields->chunk(2) as $fields)
                                        <div class="a-form__item">
                                            @foreach($fields as $field)

                                                @if($field->is_full_width && $loop->last && $loop->count > 1)
                                                    <div class="a-form__item-box"></div>
                                        </div>
                                        <div class="a-form__item">
                                            @endif

                                            @include('layouts.blocks.form.form-elements.field')

                                            @if($field->is_full_width)
                                        </div>
                                        @elseif($loop->first && $loop->last)
                                            <div class="a-form__item-box"></div>
                                        @endif

                                    @endforeach
                                    @if(!$field->is_full_width)
                        </div>
                        @endif

                    @endforeach
                                @endif

                            @endif

                        </div>
                    @endif
                    @endforeach

                <div class="btn-bottom">
                    <button class="btn btn-black ml-auto" type="submit">Save</button>
                </div>
            </div>
        </div>
        </div>
    </form>
@endif

@push('scripts')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script src="{{ asset('js/sort.js') }}"></script>
@endpush
