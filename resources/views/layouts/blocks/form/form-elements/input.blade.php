@for($i = 0; $i < $field->init_count; $i++)
    <div class=" @if($field->is_sortable) input-sortable @endif">
        @if($field->is_sortable)
            <span class="move-icon handle"></span>
        @endif
        <input class="a-input a-input-brand @error("data.{$field->id}.{$i}") is-invalid @enderror"
               name="data[{{ $field->id }}][]" type="text"
               placeholder="{{ $field->getPlaceholder($i) }}" value="{{ old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i)) }}">
        @error("data.{$field->id}.{$i}")
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
@endfor

@if(($values_count = count(old("data.{$field->id}", $formService->getFieldValues($field->id)))) > $i)
    @for(; $i < $values_count; $i++)
        <div class="multiple-input-deletable @if($field->is_sortable) input-sortable @endif">
            @if($field->is_sortable)
                <span class="move-icon handle"></span>
            @endif
            <input class="a-input a-input-brand @error("data.{$field->id}.{$i}") is-invalid @enderror"
                   name="data[{{ $field->id }}][]" type="text"
                   placeholder="{{ $field->getPlaceholder($i) }}"
                   value="{{ old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i))  }}">
            @error("data.{$field->id}.{$i}")
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
            <span class="delete"></span>
        </div>
    @endfor
@endif

@if($field->is_addable)
    <button type="button"
            class="a-form__item-box__add-more flex align-center add-input no-need-new-index input-has-name">
        + Add More
    </button>
    <template>
        <div class="multiple-input-deletable @if($field->is_sortable) input-sortable @endif">
            @if($field->is_sortable)
                <span class="move-icon handle"></span>
            @endif
            <input class="a-input a-input-brand deletable" name="data[{{ $field->id }}][]" value="" type="text"
                   placeholder="{{ $field->placeholder }}">
            <span class="delete"></span>
        </div>
    </template>
@endif
