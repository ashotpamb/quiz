@extends('core::admin.master')

@section('title', __('New cat'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'cats'])
        <h1 class="header-title">@lang('New cat')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-cats'))->multipart()->role('form') !!}
        @include('cats::admin._form')
    {!! BootForm::close() !!}

@endsection
