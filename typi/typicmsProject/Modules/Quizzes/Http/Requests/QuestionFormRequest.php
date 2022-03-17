<?php

namespace TypiCMS\Modules\Quizzes\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class QuestionFormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'quiz_id' => 'integer',
            'image_id' => 'nullable|integer',
            'title.*' => 'nullable|max:255',
            'question.*' => 'nullable|max:255',
            'status.*' => 'boolean',
        ];
    }
}
