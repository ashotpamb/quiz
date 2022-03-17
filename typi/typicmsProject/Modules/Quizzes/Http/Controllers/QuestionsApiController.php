<?php

namespace TypiCMS\Modules\Quizzes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Quizzes\Models\Question;
use TypiCMS\Modules\Quizzes\Models\Quiz;

class QuestionsApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Question::class)
            ->selectFields($request->input('fields.questions'))
            ->allowedSorts(['status_translated', 'title_translated', 'position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Question $question, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($question->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $question->setTranslation($key, $lang, $value);
                }
            } else {
                $question->{$key} = $content;
            }
        }

        $question->save();
    }

    public function destroy(Quiz $quiz, Question $question)
    {
          $question->delete();
    }
}
