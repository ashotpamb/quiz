<?php

namespace TypiCMS\Modules\Quizzes\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Route;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Quizzes\Presenters\ModulePresenter;

class Question extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use PresentableTrait;

    protected $presenter = ModulePresenter::class;

    protected $guarded = [];

    public $translatable = [
        'title',
        'question',
        'status',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class,'question_id','id');
    }
    public function getThumbAttribute(): string
    {
        return $this->present()->image(null, 54);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function editUrl(): string
    {
        $route = 'admin::edit-question';
        if (Route::has($route)) {
            return route($route, [$this->quiz_id, $this->id]);
        }

        return route('admin::dashboard');
    }

    public function indexUrl(): string
    {
        $route = 'admin::edit-quiz';
        if (Route::has($route)) {
            return route($route, $this->quiz_id);
        }

        return route('admin::dashboard');
    }

}
