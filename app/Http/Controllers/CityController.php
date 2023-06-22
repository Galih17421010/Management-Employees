<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCityRequest;
use App\Models\City;
use App\Models\State;
use App\Tables\Cities;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class CityController extends Controller
{
    
    public function index()
    {
        return view('admin.cities.index', [
            'cities' => Cities::class
        ]);
    }

    
    public function create()
    {
        $form = SpladeForm::make()
        ->action(route('admin.cities.store'))
        ->class('p-4 bg-white rounded-md space-y-4')
        ->fields([
            Input::make('name')->label('Name'),
            Select::make('state_id')->options(State::pluck('name', 'id')->toArray()),
            Submit::make()->label('Save')
        ]);

        return view('admin.cities.create', [
            'form' => $form
        ]);
    }


    
    public function store(CreateCityRequest $request)
    {
        City::create($request->validated());
        Splade::toast('City success created')->autoDismiss(3);

        return to_route('admin.cities.index');
    }

    
    public function edit(City $city)
    {
        $form = SpladeForm::make()
        ->action(route('admin.cities.update', $city))
        ->class('p-4 bg-white rounded-md space-y-4')
        ->fill($city)
        ->method('PUT')
        ->fields([
            Input::make('name')->label('Name'),
            Select::make('state_id')->options(State::pluck('name', 'id')->toArray()),
            Submit::make()->label('Save')
        ]);

        return view('admin.cities.edit', [
            'form' => $form
        ]);
    }

  
    public function update(CreateCityRequest $request, City $city)
    {
        $city->update($request->validated());
        Splade::toast('City success updated')->autoDismiss(3);

        return to_route('admin.cities.index');
    }

    
    public function destroy(City $city)
    {
        $city->delete();
        Splade::toast('City success deleted')->autoDismiss(3);

        return back();
    }
}
