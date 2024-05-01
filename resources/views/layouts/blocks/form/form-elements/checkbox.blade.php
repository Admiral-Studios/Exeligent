<div class="a-form__item-box form-item-checkbox"
     @if($field->is_full_width) style="width: 100%" @endif>
    <div class="a-form__item-additional flex align-center">
        <label class="a-form__item__label" for="field-{{ $field->id }}">{{ $field->title }}</label>
        @if($field->info)
            <div class="additional-information">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11 11V17H13V11H11ZM11 7V9H13V7H11Z"
                        fill="black"></path>
                </svg>
                <div class="information">{{ $field->info }}</div>
            </div>
        @endif

        <label class="switch">
            <input type="checkbox" id="field-{{ $field->id }}" name="data[{{ $field->id }}][]"
                   value="Updated" @checked(old("data.{$field->id}.0", $formService->getFieldValue($field->id, 0)) == 'Updated')>
            <span class="slider"></span>
        </label>
    </div>
    @if($field->sub_title)
        <div
            class="a-form__item__label_bottom">{{ $field->sub_title }}</div>
    @endif

</div>
