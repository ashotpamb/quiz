@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush
@component('core::admin._buttons-form', ['model' => $question])
@endcomponent
{!! BootForm::hidden('id') !!}
{!! BootForm::hidden('question_id')->value($question->id) !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
<files-field :init-files="{{ $model->files }}"></files-field>

{{--@include('core::form._title-and-slug')--}}
<div class="mb-3">
{{--    {!! TranslatableBootForm::hidden('status')->value(0) !!}--}}
    {!! BootForm::hidden('question_id')->value($question->id) !!}
{{--    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}--}}
</div>
{!! TranslatableBootForm::text(__('Title'), 'title')->rows(4) !!}
{!! TranslatableBootForm::textarea(__('Answer'), 'answer')->rows(4) !!}
{{--{!! TranslatableBootForm::text(__('Body'), 'body')->addClass('ckeditor-full') !!}--}}
