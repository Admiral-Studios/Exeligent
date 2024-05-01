@for($i = 0; $i < $field->init_count; $i++)
    <div class="a-form__item flex fat-input">
    <input class="a-input @error("data.{$field->id}.{$i}") is-invalid @enderror"
               name="data[{{ $field->id }}][]" type="text"
               placeholder="{{ $field->getPlaceholder($i) }}" value="{{ old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i)) }}">
        @error("data.{$field->id}.{$i}")
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        @if($field->is_addable)
            <button type="button" data-template-selector="template_{{ $field->id }}" data-after-parent-selector=".a-form__item:first"
                    class="a-form__item-box__add-more flex align-center add-input no-need-new-index input-has-name">
                + Add More
            </button>
        @endif

    </div>
@endfor

<template id="template_{{ $field->id }}">
    <div class="a-form__item flex multiple-input-deletable fat-input">
        <input class="a-input deletable" name="data[{{ $field->id }}][]" value="" type="text"
               placeholder="{{ $field->placeholder }}">
        <span class="delete"></span>
        <button type="button" data-template-selector="template_{{ $field->id }}" data-after-parent-selector=".a-form__item:first"
                class="a-form__item-box__add-more flex align-center add-input no-need-new-index input-has-name">
            + Add More
        </button>
    </div>
</template>

@if(($values_count = count(old("data.{$field->id}", $formService->getFieldValues($field->id)))) > $i)
    @for(; $i < $values_count; $i++)
        <div class="a-form__item flex multiple-input-deletable fat-input">
            <input class="a-input @error("data.{$field->id}.{$i}") is-invalid @enderror"
                   name="data[{{ $field->id }}][]" type="text"
                   placeholder="{{ $field->getPlaceholder($i) }}" value="{{ old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i)) }}">
            <span class="delete"></span>

            @error("data.{$field->id}.{$i}")
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror

            @if($field->is_addable)
                <button type="button" data-template-selector="template_{{ $field->id }}" data-after-parent-selector=".a-form__item:first"
                        class="a-form__item-box__add-more flex align-center add-input no-need-new-index input-has-name">
                    + Add More
                </button>
            @endif

        </div>
    @endfor
@endif
