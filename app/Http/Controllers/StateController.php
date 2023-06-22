<?php

namespace App\Http\Controllers;

use App\Forms\CreateStateForm;
use App\Forms\UpdateStateForm;
use App\Models\State;
use App\Tables\States;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;

class StateController extends Controller
{
    
    public function index()
    {
        return view('admin.states.index', [
            'states' => States::class
        ]);
    }

    
    public function create()
    {
        return view('admin.states.create', [
            'form' => CreateStateForm::class
        ]);
    }

    
    public function store(Request $request, CreateStateForm $form)
    {
        $data= $form->validate($request);
        State::create($data);
        Splade::toast('State success created')->autoDismiss(3);

        return to_route('admin.states.index');
    }

    
    public function edit(State $state)
    {
        return view('admin.states.edit', [
            'form' => UpdateStateForm::make()
            ->action(route('admin.states.update', $state))
            ->fill($state)
        ]);
    }

    
    public function update(Request $request, State $state, UpdateStateForm $form)
    {
        $data = $form->validate($request);
        $state->update($data);
        Splade::toast('State success updated')->autoDismiss(3);

        return to_route('admin.states.index');
    }

    
    public function destroy(State $state)
    {
        $state->delete();
        Splade::toast('State success deleted')->autoDismiss(3);

        return back();
    }
}
