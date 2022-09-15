<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Office') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-jet-validation-errors />

                    <form method="POST" action="{{ route('file.update', ['file' => $file]) }}">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-jet-label for="parent_office_id" :value="__('Parent Office')" />
                                <x-input-select id="parent_office_id" class="block mt-1 w-full" name="parent_office_id"
                                    required>
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}"
                                            {{ $office->id == $file->parent_office_id ? 'selected' : '' }}>
                                            {{ $office->name . '-' . $office->initials }}</option>
                                    @endforeach
                                </x-input-select>
                            </div>
                            <div>
                                <x-jet-label for="name" :value="__('File Name')" />
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" required
                                    value="{{ $file->name }}" />
                            </div>
                            <div>
                                <x-jet-label for="file_number" :value="__('File Number')" />
                                <x-jet-input id="file_number" class="block mt-1 w-full" type="text" name="file_number" required
                                    value="{{ $file->file_number }}" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4 ">
                            <x-jet-button class="ml-3" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                {{ __('Update') }}
                            </x-jet-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
