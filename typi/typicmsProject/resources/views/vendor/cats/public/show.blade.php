@extends('core::public.master')

@section('title', $model->title.' – '.__('Cats').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-cats body-cat-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

<article class="cat">
    <header class="cat-header">
        <div class="cat-header-container">
            <div class="cat-header-navigator">
                @include('core::public._items-navigator', ['module' => 'Cats', 'model' => $model])
            </div>
            <h1 class="cat-title">{{ $model->title }}</h1>
        </div>
    </header>
    <div class="cat-body">
        @include('cats::public._form')
        @include('cats::public._json-ld', ['cat' => $model])
        @empty(!$model->summary)
        <p class="cat-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->image)
        <picture class="cat-picture">
            <img class="cat-picture-image" src="{{ $model->present()->image(2000, 1000) }}" width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
            @empty(!$model->image->description)
            <legend class="cat-picture-legend">{{ $model->image->description }}</legend>
            @endempty
        </picture>
        @endempty

        @empty(!$model->body)
        <div class="rich-content">{!! $model->present()->body !!}</div>
        @endempty
        @include('files::public._documents')
        @include('files::public._images')
    </div>
</article>

@endsection
