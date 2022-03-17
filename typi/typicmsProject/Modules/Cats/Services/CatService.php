<?php

namespace TypiCMS\Modules\Cats\Services;

use TypiCMS\Modules\Cats\Models\Cat;

class CatService
{
    public function insert($postData)
    {
        if (isset($postData['title'])) {
            $cats = new Cat();
            $cats->title = $postData['title'];
            $cats->slug = 'english';
            $cats->save();
        }
    }

}
