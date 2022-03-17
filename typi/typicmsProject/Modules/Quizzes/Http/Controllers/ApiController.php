<?php

namespace TypiCMS\Modules\Quizzes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Quizzes\Models\Quiz;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Quiz::class)
            ->selectFields($request->input('fields.quizzes'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Quiz $quiz, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($quiz->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $quiz->setTranslation($key, $lang, $value);
                }
            } else {
                $quiz->{$key} = $content;
            }
        }

        $quiz->save();
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
    }
}
