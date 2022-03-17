<?php

namespace TypiCMS\Modules\Quizzes\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Quizzes\Exports\Export;
use TypiCMS\Modules\Quizzes\Http\Requests\FormRequest;
use TypiCMS\Modules\Quizzes\Models\Quiz;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('quizzes::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' quizzes.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Quiz();

        return view('quizzes::admin.create')
            ->with(compact('model'));
    }

    public function edit(quiz $quiz): View
    {
        return view('quizzes::admin.edit')
            ->with(['model' => $quiz]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $quiz = Quiz::create($request->validated());

        return $this->redirect($request, $quiz);
    }

    public function update(quiz $quiz, FormRequest $request): RedirectResponse
    {
        $quiz->update($request->validated());

        return $this->redirect($request, $quiz);
    }
}
