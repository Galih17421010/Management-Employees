<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold p-4">Data Countries</h1>
        <div class="p-4">
            <Link href="{{route('admin.countries.create')}}"
                class="px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-700 rounded">
                Add Country
            </Link>
        </div>
    </div>
    <x-splade-table :for="$countries">
        @cell('action', $country)
            <div class="space-x-2">
                <Link href="{{route('admin.countries.edit', $country)}}" 
                class="text-yellow-400 hover:text-yellow-700 font-semibold">
                    Edit
                </Link>
                <Link href="{{route('admin.countries.destroy', $country)}}" 
                method="DELETE" 
                confirm="Delete the countries"
                confirm-text="Are you sure {{ $country->name }}?"
                confirm-button="Yes"
                cancel-button="No"
                class="text-red-400 hover:text-red-700 font-semibold">
                    Delete
                </Link>
            </div>
        @endcell
    </x-splade-table>
</x-admin-layout>