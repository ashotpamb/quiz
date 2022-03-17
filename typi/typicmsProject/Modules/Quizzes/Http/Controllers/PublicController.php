<?php

namespace TypiCMS\Modules\Quizzes\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Quizzes\Models\Question;
use TypiCMS\Modules\Quizzes\Models\Quiz;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $models = Quiz::published()->order()->with('image')->get();

        return view('quizzes::public.index')
            ->with(compact('models'));
    }

    public function show($slug): View
    {
        $model = Quiz::published()->with(['questions' => function ($q) {
            $q->published();
        }])->whereSlugIs($slug)->firstOrFail();

        return view('quizzes::public.show')
            ->with(compact('model'));
    }
}
