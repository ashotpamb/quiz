@extends('core::public.master')

@section('title', $model->title.' – '.__('Quizzes').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('ogImage', $model->present()->image(1200, 630))
@section('bodyClass', 'body-quizzes body-quiz-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

    <article class="quiz">
        <header class="quiz-header">
            <div class="quiz-header-container">
                <div class="quiz-header-navigator">
                    @include('core::public._items-navigator', ['module' => 'Quizzes', 'model' => $model])
                </div>
                <h1 class="quiz-title">{{ $model->title }}</h1>
            </div>
        </header>
        <div class="quiz-body">

            @include('quizzes::public._json-ld', ['quiz' => $model])
            @empty(!$model->summary)
                <p class="quiz-summary">{!! nl2br($model->summary) !!}</p>
            @endempty
            @empty(!$model->image)
                <picture class="quiz-picture">
                    <img class="quiz-picture-image" src="{{ $model->present()->image(2000, 1000) }}"
                         width="{{ $model->image->width }}" height="{{ $model->image->height }}" alt="">
                    @empty(!$model->image->description)
                        <legend class="quiz-picture-legend">{{ $model->image->description }}</legend>
                    @endempty
                </picture>
            @endempty
            @empty(!$model->questions)
                @foreach($model->questions as $items)
                    <div class="rich-content">{!! $items['title'] !!}
                        <p> {{$items['summary']}}</p>
                        <p> {{$items->present()->body}}</p>
                    </div>
                @endforeach
            @endempty
            @include('files::public._documents')
            @include('files::public._images')
        </div>
    </article>

@endsection
