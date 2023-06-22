<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold p-4">Data Satates</h1>
        <div class="p-4">
            <Link href="{{route('admin.states.create')}}"
                class="px-4 py-2 text-white bg-indigo-500 hover:bg-indigo-700 rounded">
                Add State
            </Link>
        </div>
    </div>
    <x-splade-table :for="$states">
        @cell('action', $state)
            <div class="space-x-2">
                <Link href="{{route('admin.states.edit', $state)}}" 
                class="text-yellow-400 hover:text-yellow-700 font-semibold">
                    Edit
                </Link>
                <Link href="{{route('admin.states.destroy', $state)}}" 
                method="DELETE" 
                confirm="Delete the state"
                confirm-text="Are you sure delete {{$state->name}}?"
                confirm-button="Yes"
                cancel-button="No"
                class="text-red-400 hover:text-red-700 font-semibold">
                    Delete
                </Link>
            </div>
        @endcell
    </x-splade-table>
</x-admin-layout>