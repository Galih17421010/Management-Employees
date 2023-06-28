<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Models\City;
use App\Models\Department;
use App\Models\Employee;
use App\Tables\Employees;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Date;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class EmployeeController extends Controller
{
    
    public function index()
    {
        return view('admin.employees.index', [
            'employees' => Employees::class
        ]);
    }

    
    public function create()
    {
        $form = SpladeForm::make()
        ->action(route('admin.employees.store'))
        ->class('p-4 bg-white rounded-md space-y-4')
        ->fields([
            Input::make('first_name')->label(' First Name'),
            Input::make('last_name')->label(' Last Name'),
            Input::make('middle_name')->label(' Middle Name'),
            Input::make('zip_code')->label(' Zip Code'),
            Select::make('department_id')->label('Chose a Department')->options(Department::pluck('name', 'id')->toArray()),
            Select::make('city_id')->label('Chose a City')->options(City::pluck('name', 'id')->toArray()),
            Date::make('birth_date')->label('Birth Date'),
            Date::make('date_hired')->label('Date Hired'),
            Submit::make()->label('Save')
        ]);

        return view('admin.cities.create', [
            'form' => $form
        ]);
    }

    
    public function store(CreateEmployeeRequest $request)
    {
        $city = City::findOrFail($request->city_id);

        Employee::create(array_merge($request->validated(), [
            'country_id' => $city->state->country_id,
            'state_id' => $city->state_id,
        ]));

        Splade::toast('Employee success created')->autoDismiss(3);

        return to_route('admin.employees.index');
    }

   
    
    public function edit(Employee $employee)
    {
        $form = SpladeForm::make()
        ->action(route('admin.employees.update', $employee))
        ->method('PUT')
        ->class('p-4 bg-white rounded-md space-y-4')
        ->fields([
            Input::make('first_name')->label(' First Name'),
            Input::make('last_name')->label(' Last Name'),
            Input::make('middle_name')->label(' Middle Name'),
            Input::make('zip_code')->label(' Zip Code'),
            Select::make('department_id')->label('Chose a Department')->options(Department::pluck('name', 'id')->toArray()),
            Select::make('city_id')->label('Chose a City')->options(City::pluck('name', 'id')->toArray()),
            Date::make('birth_date')->label('Birth Date'),
            Date::make('date_hired')->label('Date Hired'),
            Submit::make()->label('Save')
        ])
        ->fill($employee);

        return view('admin.employees.edit', [
            'form' => $form
        ]);
    }

    
    public function update(CreateEmployeeRequest $request, Employee $employee)
    {
        $city = City::findOrFail($request->city_id);

        $employee->update(array_merge($request->validated(), [
            'country_id' => $city->state->country_id,
            'state_id' => $city->state_id,
        ]));

        Splade::toast('Employee success edit')->autoDismiss(3);

        return to_route('admin.employees.index'); 
    }

    
    public function destroy(Employee $employee)
    {
        $employee->delete();
        Splade::toast('City success deleted')->autoDismiss(3);

        return back();
    }
}
