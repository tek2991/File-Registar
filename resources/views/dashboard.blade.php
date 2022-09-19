<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 w-full">
                    <x-success-message />
                    <h1 class="py-6 font-semibold text-xl">Expected files at {{ Auth::user()->office->name }}</h1>
                    <livewire:expected-file-table />
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 w-full">
                    <x-success-message />
                    <h1 class="py-6 font-semibold text-xl text-right">Received files at {{ Auth::user()->office->name }}
                    </h1>
                    <livewire:received-file-table />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
