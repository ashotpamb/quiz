@extends('core::admin.master')

@section('title', __('New Answer'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'answer'])
        <h1 class="header-title">@lang('New Answer')</h1>
    </div>
    {!! BootForm::open()->action(route('admin::store-question_answer', $quiz->id))->multipart()->role('form') !!}
        @include('quizzes::admin._form-answer')
    {!! BootForm::close() !!}

@endsection
