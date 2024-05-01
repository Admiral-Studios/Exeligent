<div class="choose-section">
    <div class="title">{{ $field->title }}</div>
    <ul class="choose-block-list one-select-list">
        @foreach($field->values as $value)
            @php($active = is_array($values = old("data.{$field->id}", $formService->getFieldValues($field->id))) && in_array($value->title, $values))
            <li class="choose-block big @if($active) active @endif">
                <input type="checkbox" name="data[{{ $field->id }}][]" value="{{ $value->title }}" @checked($active) style="display:none;">
                {{ $value->title }}
            </li>
        @endforeach
    </ul>
</div>
