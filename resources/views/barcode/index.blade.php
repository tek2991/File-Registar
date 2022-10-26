<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Print Barcodes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-jet-validation-errors />
                    <form method="POST" action="{{ route('barcode.generate') }}">
                        @csrf

                        <div>
                            <x-jet-label for="file_numbers" :value="__('File Numbers')" />
                            <x-jet-label for="file_numbers" class="text-orange-700 font-bold" :value="__('Enter File Numbers seperated by commas , or Next Line')" />
                            <x-textarea class="block mt-1 w-full" name=file_numbers rows="5">{{ old('file_numbers') }}</x-textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4 ">
                            <x-jet-button class="ml-3" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                {{ __('Generate') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Show if files array is set and has one or more items --}}
    @if (session('files'))
        @php
            $files = session('files');
        @endphp
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" id="print_area">
                        {{-- Table with two columns --}}
                        <table class="table-auto">
                            @foreach ($files as $file)
                                @php
                                    $barcode_src = 'data:image/png;base64,' . DNS1D::getBarcodePNG($file->file_number, 'C39');
                                @endphp
                                {{-- If iteration is an odd number --}}
                                @if ($loop->iteration % 2 != 0)
                                    {{-- Start row and add a data column --}}
                                    <tr>
                                        <td class="border px-4 py-2" style="width:50%">
                                            <div>
                                                <p class="font-bold">Name: {{ $file->name }}</p>
                                                <img src="{{ $barcode_src }}" alt="barcode" class="w-30 h-14">
                                                <p class="font-bold">File No.:{{ $file->file_number }} </p>
                                            </div>
                                        </td>
                                        {{-- If it is the last iteration and another data column and close the row --}}
                                        @if ($loop->last)
                                            <td class="border px-4 py-2" style="width:50%">
                                                
                                            </td>
                                    </tr>
                                @endif
                            @else
                                {{-- Add a data column --}}
                                <td class="border px-4 py-2" style="width:50%">
                                    <div>
                                        <p class="font-bold">Name: {{ $file->name }}</p>
                                        <img src="{{ $barcode_src }}" alt="barcode" class="w-30 h-14">
                                        <p class="font-bold">File No.: {{ $file->file_number }} </p>
                                    </div>
                                </td>
                                </tr>
                            @endif
    @endforeach
    </table>
    </div>
    {{-- print button --}}
    <div class="flex items-center justify-end m-4">
        <x-jet-button class="ml-3" onclick="printDiv('print_area')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12M2 6h20M2 12h20M2 18h20" />
            </svg>
            {{ __('Print') }}
        </x-jet-button>
    </div>
    </div>
    </div>
    </div>
    @endif

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
