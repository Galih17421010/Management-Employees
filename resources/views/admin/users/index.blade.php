<x-admin-layout>
    <h1>Users Index</h1>
    <x-splade-table :for="$users">
        @cell('action', $user)
        <Link href="{{route('admin.users.edit', $user)}}" 
            class="px-3 py-2  text-white  bg-yellow-400 hover:bg-yellow-500 rounded-md">
            Edit
        </Link>
        @endcell
    </x-splade-table>>
</x-admin-layout>