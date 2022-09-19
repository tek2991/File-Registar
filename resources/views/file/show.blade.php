<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Office') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-jet-label for="parent_office_id" :value="__('Parent Office')" />
                            <x-input-select id="parent_office_id" class="block mt-1 w-full" disabled>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}"
                                        {{ $office->id == $file->parent_office_id ? 'selected' : '' }}>
                                        {{ $office->name . '-' . $office->initials }}</option>
                                @endforeach
                            </x-input-select>
                        </div>
                        <div>
                            <x-jet-label for="current_office_id" :value="__('Current Office')" />
                            <x-input-select id="current_office_id" class="block mt-1 w-full" disabled>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}"
                                        {{ $office->id == $file->current_office_id ? 'selected' : '' }}>
                                        {{ $office->name . '-' . $office->initials }}</option>
                                @endforeach
                            </x-input-select>
                        </div>
                        <div>
                            <x-jet-label for="name" :value="__('File Name')" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" disabled
                                value="{{ $file->name }}" />
                        </div>
                        <div>
                            <x-jet-label for="file_number" :value="__('File Number')" />
                            <x-jet-input id="file_number" class="block mt-1 w-full" type="text" disabled
                                value="{{ $file->file_number }}" />
                        </div>
                        <div>
                            @php
                                $barcode_src = 'data:image/png;base64,' . DNS1D::getBarcodePNG($file->file_number, 'C39+');
                            @endphp
                            <x-jet-label for="barcode" :value="__('Barcode')" />
                            <div>
                                <p class="font-bold">Name: {{ $file->name }}</p>
                                <img src="{{ $barcode_src }}" alt="barcode" class="w-30 h-14">
                                <p class="font-bold">UID: {{ $file->file_number }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-jet-button class="ml-4" onclick="printDiv('print_area')">
                            {{ __('Print Barcode') }}
                        </x-jet-button>
                    </div>
                    <div id="print_area" class="hidden">
                        <table>
                            <tr>
                                <td style="width:50%">
                                    <p class="font-bold">Name: {{ $file->name }}</p>
                                    <img src="{{ $barcode_src }}" alt="barcode" class="w-30 h-14">
                                    <p class="font-bold">UID: {{ $file->file_number }} </p>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</x-app-layout>
