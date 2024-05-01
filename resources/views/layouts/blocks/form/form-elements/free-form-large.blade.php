<div class="choose-section culture-list">
    <div class="title">{{ $field->title }}</div>
    <ul class="choose-block-list">
        @foreach($field->values as $value)
            @php($active = is_array($values = old("data.{$field->id}", $formService->getFieldValues($field->id))) && in_array($value->title, $values))
            <li class="choose-block big @if($active) active @endif">
                <input type="checkbox" name="data[{{ $field->id }}][]" value="{{ $value->title }}" @checked($active) style="display:none;">
                {{ $value->title }}
            </li>
        @endforeach
            @foreach($formService->getFieldValues($field->id) as $custom_value)
                @continue($field->values->where('title', $custom_value)->isNotEmpty())
                <li class="choose-block big active">
                    <input type="checkbox" name="data[{{ $field->id }}][]" value="{{ $custom_value }}" checked style="display:none;">
                    {{ $custom_value }}
                    <svg class="delete-item" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                        <path opacity="0.6" d="M1 9L5 5L9 9M9 1L4.99924 5L1 1" stroke="#0066CC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </li>
            @endforeach
        @if($field->is_addable)
            <div class="choose-block item-add">+ Add</div>
            <input class="input-add-value" type="text" data-name="data[{{ $field->id }}][]" placeholder="Add your value..." style="display: none">
        @endif
    </ul>
</div>
