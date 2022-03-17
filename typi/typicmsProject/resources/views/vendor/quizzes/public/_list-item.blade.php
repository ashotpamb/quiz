<li class="quiz-list-item">
    <a class="quiz-list-item-link" href="{{ $quiz->uri() }}" title="{{ $quiz->title }}">
        <div class="quiz-list-item-title">{{ $quiz->title }}</div>
        <div class="quiz-list-item-image-wrapper">
            @empty (!$quiz->image)
            <img class="quiz-list-item-image" src="{{ $quiz->present()->image(null, 200) }}" width="{{ $quiz->image->width }}" height="{{ $quiz->image->height }}" alt="{{ $quiz->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
