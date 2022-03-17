@extends('core::admin.master')

@section('title', __('New quiz'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'quizzes'])
        <h1 class="header-title">@lang('New quiz')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-quizzes'))->multipart()->role('form') !!}
        @include('quizzes::admin._form')
    {!! BootForm::close() !!}

@endsection
