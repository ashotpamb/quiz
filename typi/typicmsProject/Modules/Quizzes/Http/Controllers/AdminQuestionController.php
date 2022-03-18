<?php

namespace TypiCMS\Modules\Quizzes\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Quizzes\Exports\Export;
use TypiCMS\Modules\Quizzes\Http\Requests\FormRequest;
use TypiCMS\Modules\Quizzes\Http\Requests\QuestionFormRequest;
use TypiCMS\Modules\Quizzes\Models\Question;
use TypiCMS\Modules\Quizzes\Models\Quiz;

class AdminQuestionController extends BaseAdminController
{

    public function create(Quiz $quiz): View
    {
        $model = new Question();

        return view('quizzes::admin.create-question')
            ->with(compact('model', 'quiz'));
    }

    public function edit(Quiz $quiz, Question $question): View
    {
        return view('quizzes::admin.edit-question')
            ->with([
                'model' => $question,
                'quiz' => $quiz,
            ]);
    }

    public function store(Quiz $quiz, QuestionFormRequest $request): RedirectResponse
    {
        $question = Question::create($request->validated());
        return $this->redirect($request, $question);
    }

    public function update(Quiz $quiz, Question $question, QuestionFormRequest $request): RedirectResponse
    {
        $question->update($request->validated());

        return $this->redirect($request, $question);
    }
}
