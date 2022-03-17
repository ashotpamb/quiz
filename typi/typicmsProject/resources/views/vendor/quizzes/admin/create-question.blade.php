@extends('core::admin.master')

@section('title', __('New question'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'quizzes'])
        <h1 class="header-title">@lang('New question')</h1>
    </div>
    {!! BootForm::open()->action(route('admin::store-quiz_question', $quiz->id))->multipart()->role('form') !!}
        @include('quizzes::admin._form-question')
    {!! BootForm::close() !!}

@endsection
