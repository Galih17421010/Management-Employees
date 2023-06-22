<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold p-4">Data City</h1>
        <div class="p-4">
            <Link href="{{route('admin.cities.create')}}"
                class="px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-700 rounded">
                Add City
            </Link>
        </div>
    </div>
    <x-splade-table :for="$cities">
        @cell('action', $city)
            <div class="space-x-2">
                <Link href="{{route('admin.cities.edit', $city)}}" 
                class="text-yellow-400 hover:text-yellow-700 font-semibold">
                    Edit
                </Link>
                <Link href="{{route('admin.cities.destroy', $city)}}" 
                method="DELETE" 
                confirm="Delete the cities"
                confirm-text="Are you sure delete {{$city->name}}?"
                confirm-button="Yes"
                cancel-button="No"
                class="text-red-400 hover:text-red-700 font-semibold">
                    Delete
                </Link>
            </div>
        @endcell
    </x-splade-table>
</x-admin-layout>