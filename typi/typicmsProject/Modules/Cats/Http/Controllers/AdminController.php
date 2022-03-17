<?php

namespace TypiCMS\Modules\Cats\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Cats\Exports\Export;
use TypiCMS\Modules\Cats\Http\Requests\FormRequest;
use TypiCMS\Modules\Cats\Models\Cat;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('cats::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' cats.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Cat();

        return view('cats::admin.create')
            ->with(compact('model'));
    }

    public function edit(cat $cat): View
    {
        return view('cats::admin.edit')
            ->with(['model' => $cat]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $cat = Cat::create($request->validated());

        return $this->redirect($request, $cat);
    }

    public function update(cat $cat, FormRequest $request): RedirectResponse
    {
        $cat->update($request->validated());

        return $this->redirect($request, $cat);
    }
}
