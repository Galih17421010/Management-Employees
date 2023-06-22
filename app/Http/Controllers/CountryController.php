<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use App\Tables\Countries;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class CountryController extends Controller
{
    
    public function index()
    {
        return view('admin.countries.index', [
            'countries' => Countries::class
        ]);
            
    }

    
    public function create()
    {
        return view('admin.countries.create');
    }

   
    public function store(StoreCountryRequest $request)
    {
        Country::create($request->validated());
        Splade::toast('Country success created')->autoDismiss(3);

        return to_route('admin.countries.index');
    }

    
    public function edit(Country $country)
    {
        $form = SpladeForm::make()
            ->action(route('admin.countries.update', $country))
            ->fields([
                Input::make('country_code')->label('Country Code'),
                Input::make('name')->label('Country Name'),
                Submit::make()->label('Update'),
            ])
            ->class('p-4 bg-white rounded-md space-y-4')
            ->method('PUT')
            ->fill($country);

            return view('admin.countries.edit', [
                'form' => $form,
                'country' => $country
            ]);
    }

    
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        Splade::toast('Country success updated')->autoDismiss(3);

        return to_route('admin.countries.index');
    }

    
    public function destroy(Country $country)
    {
        $country->delete();
        Splade::toast('Country deleted')->autoDismiss(3);

        return back();
    }
}
