<div class="targets-industry flex flow-column">
    <div class="dropdown_with-chk">
        <button class="dropdown_with-chk__button flex flow-column @error("data.{$field->id}") is-invalid @enderror" type="button">
            {{ $field->title }}
            @if($field->sub_title)
                <span>{{ $field->sub_title }}</span>
            @endif
        </button>
        <ul class="dropdown_with-chk__list">
            @foreach($field->values as $value)
                @php($active = is_array($values = old("data.{$field->id}", $formService->getFieldValues($field->id))) && in_array($value->title, $values))
            <li class="dropdown_with-chk__list-item flex align-center @if($active) dropdown_with-chk__list-item_active @endif">
                <input class="dropdown_with-chk__list-item_label" type="checkbox" name="data[{{ $field->id }}][]"
                       @checked($active)
                       value="{{ $value->title }}">
                <label class="dropdown_with-chk__list-item_label">{{ $value->title }}</label>

                @if($value->info)
                <div class="additional-information">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11 11V17H13V11H11ZM11 7V9H13V7H11Z" fill="black"></path>
                    </svg>
                    <div class="information">
                        {{ $value->info }}
                    </div>
                </div>
                @endif

            </li>
            @endforeach
        </ul>
    </div>
</div>
