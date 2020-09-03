<?php

namespace App\Http\Controllers;

use App\Forms\LotForm;
use App\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class LotController extends Controller
{
    use FormBuilderTrait;

    public function createForm()
    {
        $form = $this->form(LotForm::class, [
            'method' => 'POST',
            'url' => route('lot.store')
        ]);
        return view('crud.form', compact('form'), ['title' => 'Лот']);
    }
    public function store(Request $request)
    {
        $form = $this->form(LotForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        $values['src'] = Storage::disk('local')->put("public", $values['src']);
        $lot = new Lot();
        $lot->fill($values);
        $lot->save();
        return redirect()->route('lot.index');
    }
    public function index()
    {
        $lots = Lot::get()->all();
        return view('lot.index',  ['lots' => $lots]);
    }

    public function updateForm(Request $request)
    {
        $itemId = $request->route('id');
        $item = Lot::find($itemId);
        $form = $this->form(LotForm::class, [
            'method' => 'POST',
            'url' => route('lot.update', ['id' => $itemId]),
            'model' => $item,
        ]);

        return view('crud.form', compact('form'), ['title' => 'Лот']);
    }

    public function update(Request $request)
    {
        $itemId = $request->route('id');
        $item = Lot::find($itemId);
        $form = $this->form(LotForm::class, [
            'model' => $item,
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        $values['src'] = Storage::disk('local')->put("public", $values['src']);
        $item->fill($values);
        $item->save();
        return redirect()->route('lot.index');
    }

    public function destroy(Request $request)
    {
        $id = $request->route('id');
        $item = Lot::find($id);
        if (isset($item)) {
            Storage::delete($item->src);
            $item->delete();
        }
        return redirect()->route('lot.index');
    }




}
