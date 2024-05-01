@if($field->type == 'multiselect')

    <div class="a-form__item-box"
         style="@if($field->is_full_width) width: 100%; @endif margin-top: 0!important;">
        @includeIf("layouts.blocks.form.form-elements.{$field->type}")
    </div>

@elseif($field->type == \App\Models\FormField::TYPE_CHECKBOX)

    @includeIf("layouts.blocks.form.form-elements.{$field->type}")

@elseif($field->type == \App\Models\FormField::TYPE_FREE_FORM)

    <div class="a-form__item">
    <div class="section-add-self">
        <div class="title">{{ $field->title }}</div>
        @includeIf("layouts.blocks.form.form-elements.{$field->type}")
    </div>
    </div>

@elseif(in_array($field->type, [\App\Models\FormField::TYPE_FAT_INPUT, \App\Models\FormField::TYPE_TEXTAREA, \App\Models\FormField::TYPE_FREE_FORM_LARGE, \App\Models\FormField::TYPE_FREE_FORM_LARGE_LIMITED, \App\Models\FormField::TYPE_FREE_FORM_LARGE_SINGLE, \App\Models\FormField::TYPE_FREE_FORM_LARGE_WITH_ICONS, \App\Models\FormField::TYPE_CD_FULL_WIDTH_INPUT]))

    @includeIf("layouts.blocks.form.form-elements.{$field->type}")

@elseif(in_array($field->type, [\App\Models\FormField::TYPE_FREE_FORM_LARGE_SINGLE]))

    <div class="choose-wrapper">
        @includeIf("layouts.blocks.form.form-elements.{$field->type}")
    </div>

@else

    <div class="a-form__item-box @if($field->is_sortable) sortable @endif" @if($field->is_full_width) style="width: 100%" @endif>
        <div class="a-form__item-additional flex align-center">
            <label class="a-form__item__label">{{ $field->title }}</label>
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
        </div>

        @if($field->type !== \App\Models\FormField::TYPE_DOC_FILE && $field->sub_title)
            <div class="a-form__item__label_bottom">{{ $field->sub_title }}</div>
        @endif

        @includeIf("layouts.blocks.form.form-elements.{$field->type}")

    </div>

@endif
