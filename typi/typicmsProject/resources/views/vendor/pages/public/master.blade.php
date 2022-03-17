@extends('core::public.master')

@section('title', $page->title.' – '.$websiteTitle)
@section('ogTitle', $page->title)
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
<meta name="csrf-token" content="{{ csrf_token() }}" />
@empty(!$page->image)
@section('ogImage', $page->present()->image(1200, 630))
@endempty
@section('bodyClass', 'body-page body-page-'.$page->id)

@if ($page->css)
    @push('css')
        <style type="text/css">{{ $page->css }}</style>
    @endpush
@endif

@if ($page->js)
    @push('js')
        <script>{!! $page->js !!}</script>
    @endpush
@endif

@section('content')

    @section('page-header')
    <header class="page-header">

        <div class="page-header-container">
            <h1>{{ $page->title }}</h1>
        </div>

    </header>
    @show

    @yield('page')

@endsection
