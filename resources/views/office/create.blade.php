<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Office') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-jet-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('office.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:w-1/2">
                            <!--Office Initials -->
                            <div class="mt-4">
                                <x-jet-label for="initials" :value="__('Office Initials')" />

                                <x-jet-input id="initials" class="block mt-1 w-full" type="text" name="initials"
                                    :value="old('initials')" required autofocus/>
                            </div>
                            <!--Office Name -->
                            <div class="mt-4">
                                <x-jet-label for="name" :value="__('Office Name')" />

                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4 ">
                            <x-jet-button class="ml-3" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                {{ __('Save') }}
                            </x-jet-button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
