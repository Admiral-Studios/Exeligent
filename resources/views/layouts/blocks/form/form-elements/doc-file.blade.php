<div id="uploadFile" data-files='@json($formService->getFieldFiles($field->id))'
     data-show-url="{{ route('user.form.file.show', 0) }}">
{{--    <h2>Upload Files</h2>--}}
    <div class="container">
        <div class="file-input-box">
            <div class="wrapper-file-input">
                <div class="input-box" onclick="openFileInput()">
                    <h4><i class="fas fa-upload"></i>{{ $field->getPlaceholder(0) }}</h4>
                    <input
                        name="data[{{ $field->id }}][]"
                        id="fileInput"
                        type="file"
                        hidden
                        onchange="handleFileChange(event)"
                        multiple
                        accept="application/msword, application/pdf"
                    />
                </div>
                @if($field->sub_title)
                <small style="margin-bottom: 10px; display: block">{{ $field->sub_title }}</small>
                @endif
            </div>

            <div class="wrapper-file-section">
                <div class="selected-files" id="selectedFiles">
                    <h5>Selected File</h5>
                    <ul class="file-list">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
