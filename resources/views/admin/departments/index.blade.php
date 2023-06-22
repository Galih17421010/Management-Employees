<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold p-4">Data Departments</h1>
        <div class="p-4">
            <Link href="{{route('admin.departments.create')}}"
                class="px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-700 rounded">
                Add Department
            </Link>
        </div>
    </div>
    <x-splade-table :for="$departments">
        @cell('action', $department)
            <div class="space-x-2">
                <Link href="{{route('admin.departments.edit', $department)}}" 
                class="text-yellow-400 hover:text-yellow-700 font-semibold">
                    Edit
                </Link>
                <Link href="{{route('admin.departments.destroy', $department)}}" 
                method="DELETE" 
                confirm="Delete the departments"
                confirm-text="Are you sure delete {{$department->name}}?"
                confirm-button="Yes"
                cancel-button="No"
                class="text-red-400 hover:text-red-700 font-semibold">
                    Delete
                </Link>
            </div>
        @endcell
    </x-splade-table>
</x-admin-layout>