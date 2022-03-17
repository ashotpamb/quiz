@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush
@component('core::admin._buttons-form', ['model' => $quiz])
@endcomponent
{!! BootForm::hidden('id') !!}
{!! BootForm::hidden('quiz_id')->value($quiz->id) !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>
<files-field :init-files="{{ $model->files }}"></files-field>

{{--@include('core::form._title-and-slug')--}}
<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! BootForm::hidden('quiz_id')->value($quiz->id) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
{!! TranslatableBootForm::text(__('Title'), 'title')->rows(4) !!}
{!! TranslatableBootForm::textarea(__('Question'), 'question')->rows(4) !!}
{{--{!! TranslatableBootForm::text(__('Body'), 'body')->addClass('ckeditor-full') !!}--}}
@can('read answer')
    @if ($model->id)
        <item-list
            url-base="/api/question/{{ $model->id }}/answer"
            locale="{{ config('typicms.content_locale') }}"
            fields="id,image_id,question_id,position,status,title"
            table="answers"
            title="answers"
            include="image"
            appends="thumb"
            :searchable="['title']"
            :sorting="['position']">

            <template slot="add-button" v-if="$can('create answer')">
                @include('core::admin._button-create', ['url' => route('admin::create-question_answers', $model->id), 'module' => 'answer'])
            </template>

            <template slot="columns" slot-scope="{ sortArray }">
                <item-list-column-header name="checkbox"
                                         v-if="$can('update answer')||$can('delete answer')"></item-list-column-header>
                <item-list-column-header name="edit" v-if="$can('update answer')"></item-list-column-header>
                <item-list-column-header name="status_translated" sortable :sort-array="sortArray"
                                         :label="$t('Status')"></item-list-column-header>
                <item-list-column-header name="position" sortable :sort-array="sortArray"
                                         :label="$t('Position')"></item-list-column-header>
                <item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>
                <item-list-column-header name="title_translated" sortable :sort-array="sortArray"
                                         :label="$t('Title')"></item-list-column-header>
            </template>

            <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
                <td class="checkbox" v-if="$can('update answer')||$can('delete answer')">
                    <item-list-checkbox :model="model" :checked-models-prop="checkedModels"
                                        :loading="loading"></item-list-checkbox>
                </td>
                <td v-if="$can('update answer')">@include('core::admin._button-edit', ['segment' => 'answer', 'module' => 'answer'])</td>
                <td>
                    <item-list-status-button :model="model"></item-list-status-button>
                </td>
                <td>
                    <item-list-position-input :model="model"></item-list-position-input>
                </td>
                <td><img :src="model.thumb" alt="" height="27"></td>
                <td v-html="model.title_translated"></td>
            </template>

        </item-list>
        @endif
        @endcan

        </div>

