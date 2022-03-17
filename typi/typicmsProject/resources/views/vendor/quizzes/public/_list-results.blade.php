<ul class="quiz-list-results-list">
    @foreach ($items as $quiz)
    <li class="quiz-list-results-item">
        <a class="quiz-list-results-item-link" href="{{ $quiz->uri() }}" title="{{ $quiz->title }}">
            <span class="quiz-list-results-item-title">{{ $quiz->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
