<?php

namespace TypiCMS\Modules\Cats\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Cats\Models\Cat;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Cat::class)
            ->selectFields($request->input('fields.cats'))
            ->allowedSorts(['status_translated', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Cat $cat, Request $request)
    {
        foreach ($request->only('status') as $key => $content) {
            if ($cat->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $cat->setTranslation($key, $lang, $value);
                }
            } else {
                $cat->{$key} = $content;
            }
        }

        $cat->save();
    }

    public function destroy(Cat $cat)
    {
        $cat->delete();
    }
}
