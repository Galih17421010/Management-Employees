<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Models\Department;
use App\Tables\Departments;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class DepartmentController extends Controller
{
   
    public function index()
    {
        return view('admin.departments.index', [
            'departments' => Departments::class
        ]);
    }

    
    public function create()
    {
        $form = SpladeForm::make()
        ->action(route('admin.departments.store'))
        ->class('p-4 bg-white rounded-md space-y-4')
        ->fields([
            Input::make('name')->label('Name'),
            Submit::make()->label('Save')
        ]);

        return view('admin.departments.create', [
            'form' => $form
        ]);
    }

    
    public function store(CreateDepartmentRequest $request)
    {
        Department::create($request->validated());
        Splade::toast('Department success created')->autoDismiss(3);

        return to_route('admin.departments.index');
    }

    
    public function edit(Department $department)
    {
        $form = SpladeForm::make()
        ->action(route('admin.departments.update', $department))
        ->method('PUT')
        ->fill($department)
        ->class('p-4 bg-white rounded-md space-y-4')
        ->fields([
            Input::make('name')->label('Name'),
            Submit::make()->label('Save')
        ]);

        return view('admin.departments.edit', [
            'form' => $form
        ]);
    }

    
    public function update(CreateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        Splade::toast('Department success updated')->autoDismiss(3);

        return to_route('admin.departments.index');

    }

    
    public function destroy(Department $department)
    {
        $department->delete();
        Splade::toast('Department success deleted')->autoDismiss(3);

        return back();

    }
}
