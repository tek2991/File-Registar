@props(['message'])

@if (session('error'))
<div class="alert flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300 py-5 mb-4">
    <div class="alert-icon flex items-center bg-red-100 border-2 border-red-500 justify-center h-10 w-10 flex-shrink-0 rounded-full">
        <span class="text-red-500">
            <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                <path fill-rule="evenodd" d="M5 13a1 1 0 01-.707-1.707l7-7a1 1 0 011.414 0l7 7A1 1 0 0115 13H5z" clip-rule="evenodd"></path>
            </svg>
        </span>
    </div>
    <div class="alert-content ml-4">
        <div class="alert-title font-semibold text-lg text-red-800">
            {{ __('Error') }}
        </div>
        <div class="alert-description text-sm text-red-600">
            {{ session('error') }}
        </div>
    </div>
</div>
@endif