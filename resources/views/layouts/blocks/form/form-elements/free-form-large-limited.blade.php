<ul class="choose-block-list preferred-list" data-limit="{{ $field->values_limit ?? 1 }}">
    @foreach($field->values as $value)
        @php($active = is_array($values = old("data.{$field->id}", $formService->getFieldValues($field->id))) && in_array($value->title, $values))
        <li class="choose-block @if($active) active @endif">
            <input type="checkbox" name="data[{{ $field->id }}][]" value="{{ $value->title }}" @checked($active) style="display:none;">
            {{ $value->title }}
        </li>
    @endforeach
</ul>
