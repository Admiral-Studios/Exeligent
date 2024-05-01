@for($i = 0; $i < $field->init_count; $i++)
    <div class="dropdown">
        <button
            class="dropdown__button @error("data.{$field->id}.{$i}") is-invalid @enderror @if(old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i))) select-active @endif"
            type="button">{{ old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i)) ?? $field->getPlaceholder($i) }}</button>
        @error("data.{$field->id}.{$i}")
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <ul class="dropdown__list">
            @foreach($field->values as $value)
                <li class="dropdown__list-item @if(old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i)) == $value->title) dropdown__list-item_active @endif"
                    data-value="{{ $value->title }}">{{ $value->title }}</li>
            @endforeach
            <input class="dropdown__input_hidden" type="text"
                   name="data[{{ $field->id }}][]"
                   value="{{ old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i)) }}">
        </ul>
    </div>
@endfor

@if(($values_count = count(old("data.{$field->id}", $formService->getFieldValues($field->id)))) > $i)
    @for(; $i < $values_count; $i++)
        <div class="dropdown multiple-input-deletable">
            <button
                class="dropdown__button @error("data.{$field->id}.{$i}") is-invalid @enderror @if(old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i))) select-active @endif"
                type="button">{{ old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i)) ?? $field->getPlaceholder($i) }}</button>
            @error("data.{$field->id}.{$i}")
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
            <ul class="dropdown__list">
                @foreach($field->values as $value)
                    <li class="dropdown__list-item @if(old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i)) == $value->title) dropdown__list-item_active @endif"
                        data-value="{{ $value->title }}">{{ $value->title }}</li>
                @endforeach
                <input class="dropdown__input_hidden" type="text"
                       name="data[{{ $field->id }}][]"
                       value="{{ old("data.{$field->id}.{$i}", $formService->getFieldValue($field->id, $i)) }}">
            </ul>
            <span class="delete"></span>
        </div>
    @endfor
@endif

@if($field->is_addable)
<button type="button"
        class="a-form__item-box__add-more flex align-center add-input no-need-new-index input-has-name">
    Add New Value
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="black"/>
    </svg>
</button>
<template>
    <div class="dropdown multiple-input-deletable">
        <button class="dropdown__button" type="button">{{ $field->placeholder }}
        </button>
        <ul class="dropdown__list">
            @foreach($field->values as $value)
                <li class="dropdown__list-item"
                    data-value="{{ $value->title }}">{{ $value->title }}</li>
            @endforeach
            <input class="dropdown__input_hidden" type="text" name="data[{{ $field->id }}][]"
                   value="">
        </ul>
        <span class="delete"></span>
    </div>
</template>
@endif
