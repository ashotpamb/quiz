<ul class="quiz-list-list">
    @foreach ($items as $quiz)
    @include('quizzes::public._list-item')
    @endforeach
</ul>
