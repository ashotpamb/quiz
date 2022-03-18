<?php

namespace TypiCMS\Modules\Quizzes\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class AnswerFormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'question_id' => 'integer',
            'image_id' => 'nullable|integer',
            'answer.*' => 'nullable|max:255',
            'title.*' => 'nullable|max:255',
        ];
    }
}
