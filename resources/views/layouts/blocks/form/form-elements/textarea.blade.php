<div class="a-form__item-box">
    <div class="story-change-text flex">
        <label class="a-form__item__label" for="{{ $field->type . '-' . $field->id }}">{{ $formService->getFieldLabel($field->id, $field->title) }}</label>
        <input class="a-input change-text" type="text" name="data[custom_labels][{{ $field->id }}]" value="{{ $formService->getFieldLabel($field->id, $field->title) }}">
        <svg class="change-btn" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
             viewBox="0 0 20 20"
             fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M13.1976 1.22004L3.11964 11.298C2.96899 11.4483 2.8702 11.6428 2.83764 11.853L2.13264 16.447C2.10885 16.6022 2.12193 16.7608 2.1708 16.91C2.21968 17.0591 2.30299 17.1947 2.41399 17.3057C2.52499 17.4167 2.66056 17.5 2.80973 17.5489C2.9589 17.5978 3.11748 17.6108 3.27264 17.587L7.86764 16.882C8.07781 16.8498 8.27222 16.7513 8.42264 16.601L18.5006 6.52304C18.6881 6.33552 18.7934 6.08121 18.7934 5.81604C18.7934 5.55088 18.6881 5.29657 18.5006 5.10905L14.6106 1.21904C14.4232 1.03188 14.1691 0.926758 13.9041 0.926758C13.6392 0.926758 13.3851 1.03188 13.1976 1.21904V1.22004ZM4.31664 15.404L4.76464 12.48L13.9046 3.34004L16.3796 5.81604L7.23964 14.956L4.31664 15.404Z"
                  fill="#027FFE"/>
            <path
                d="M11.4414 5.24704L12.5014 4.18604L15.7434 7.42604L14.6824 8.48704L11.4414 5.24704Z"
                fill="#027FFE"/>
        </svg>
    </div>

    <textarea class="a-input textarea" name="data[{{ $field->id }}][]" type="text" placeholder="{{ $field->getPlaceholder(0) }}"
              id="{{ $field->type . '-' . $field->id }}">{{ $formService->getFieldValue($field->id, 0) }}</textarea>
</div>
