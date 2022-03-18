<?php

namespace TypiCMS\Modules\Quizzes\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Quizzes\Exports\Export;
use TypiCMS\Modules\Quizzes\Http\Requests\AnswerFormRequest;
use TypiCMS\Modules\Quizzes\Http\Requests\FormRequest;
use TypiCMS\Modules\Quizzes\Http\Requests\QuestionFormRequest;
use TypiCMS\Modules\Quizzes\Models\Answer;
use TypiCMS\Modules\Quizzes\Models\Question;
use TypiCMS\Modules\Quizzes\Models\Quiz;

class AdminAnswerController extends BaseAdminController
{

    public function create(Question $question): View
    {
        $model = new Answer();

        return view('quizzes::admin.create-answer')
            ->with(compact('model', 'question'));
    }

    public function edit(Quiz $quizzes,Question $question, Answer $answer): View
    {
        return view('quizzes::admin.edit-answer')
            ->with([
                'model' => $answer,
                'question' => $question,
            ]);
    }

    public function store(Question $question, AnswerFormRequest $request): RedirectResponse
    {
        $question = Answer::create($request->validated());
        return $this->redirect($request, $question);
    }

    public function update(Quiz $quiz, Question $question, QuestionFormRequest $request): RedirectResponse
    {
        $question->update($request->validated());

        return $this->redirect($request, $question);
    }
}
