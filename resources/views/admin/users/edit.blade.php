<x-admin-layout>
    <h1 class="text-2xl font-semibold p-4">Edit Users</h1>
    <x-splade-form :default="$user" :action="route('admin.users.update', $user)" method="PUT"
    class="p-4 bg-white rounded-md space-y-4">
        <x-splade-input name="username" label="User Name" />
        <x-splade-input name="first_name" label="First Name" />
        <x-splade-input name="last_name" label="Last Name" />
        <x-splade-input name="email" label="Email address" />
        <x-splade-select label="Role" name="roles[]" :options="$roles" multiple relation choices />
        <x-splade-select label="Permission" name="permissions[]" :options="$permissions" multiple relation choices />
        <x-splade-submit />
    </x-splade-form>
</x-admin-layout>