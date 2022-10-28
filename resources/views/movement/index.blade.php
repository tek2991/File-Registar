<x-app-layout>
    <x-slot name="header">
        <span class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('File Movements') }}
            </h2>
            <div

            </div>
        </span>
    </x-slot>

    <div class="py-12">
        <div class="max-11/12 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-success-message />
                    <livewire:movement-table fileId=""/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
