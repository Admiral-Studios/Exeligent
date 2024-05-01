<div class="choose-section culture-list">
    @php
    $blockId = md5(Str::random() . microtime());
    @endphp
    <ul class="choose-block-list" id="{{ $blockId }}">
        @php
            $i = 0
        @endphp
        @foreach($field->values as $value)
            @php
                $active = old("data.{$field->id}.{$i}.value", $formService->getFieldValue($field->id, $i)['value'] ?? null) == $value->title
            @endphp
            <li class="choose-block big @if($active) active @endif">
                <input type="checkbox" name="data[{{ $field->id }}][{{ $i }}][value]" value="{{ $value->title }}"
                       @checked($active) style="display:none;">
                @if($value->info)
                    <span class="icon">
                    <input type="checkbox" name="data[{{ $field->id }}][{{ $i }}][icon]" value="{!! $value->info !!}"
                           @checked($active) style="display:none;">
                    {!! $value->info !!}
                </span>
                @endif
                {{ $value->title }}
            </li>
            @php
                $i++
            @endphp
        @endforeach

        @foreach($formService->getFieldValues($field->id) as $custom_value)
                @php
                    $icon = $custom_value['icon'] ?? null;
                    $custom_value = $custom_value['value'] ?? $custom_value;
                @endphp
            @continue($field->values->where('title', $custom_value)->isNotEmpty())
            <li class="choose-block big add active">
                <input type="checkbox" name="data[{{ $field->id }}][{{ $i }}][value]" value="{{ $custom_value }}" checked
                       style="display:none;">
                @if($icon)
                    <span class="icon">
                    <input type="checkbox" name="data[{{ $field->id }}][{{ $i }}][icon]" value="{!! $icon !!}" checked
                           style="display:none;">
                    {!! $icon !!}
                </span>
                @endif
                {{ $custom_value }}
                <div class="btn-delete">
                    <svg class="delete-item" xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                         viewBox="0 0 10 10" fill="none">
                        <path opacity="0.6" d="M1 9L5 5L9 9M9 1L4.99924 5L1 1" stroke="#0066CC" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </li>
            @php
                $i++
            @endphp
        @endforeach

        <div class="choose-block item-add">+ Add</div>
        <div class="utility-container">
            <ul class="utility-group">
                <li class="emoji-selector" id="emojiSelector">
                    <div class="input-container">
                        <input id="emojiSearch" type="text" name="" placeholder="Search...">
                    </div>
                    <ul id="emojiList" class="emoji-list">
                    </ul>
                </li>
                <li id="emojiSelectorIcon">
                    <img src="{{ asset('images/icons/face-smile-regular.svg') }}" alt="icon">
                </li>
            </ul>
        </div>
        <input class="input-add-value" type="text" data-block="#{{ $blockId }} li.choose-block" data-name="data[{{ $field->id }}][%i%][value]" data-icon-name="data[{{ $field->id }}][%i%][icon]" placeholder="Add your value..."
               style="display:none;">
    </ul>
</div>
