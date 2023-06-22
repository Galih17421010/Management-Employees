<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold p-4">New Country</h1>
    </div>
    <x-splade-form :action="route('admin.countries.store')"
    class="p-4 bg-white rounded-md space-y-4">
        <x-splade-input name="country_code" label="Code Country" />
        <x-splade-input name="name" label="Name Country" />
        <x-splade-submit />
    </x-splade-form>
</x-admin-layout>