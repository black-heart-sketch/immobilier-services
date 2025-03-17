<div id="{{ $id }}" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $title }}</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            {{ $slot }}
        </div>
        <div class="px-4 py-3 bg-gray-50 sm:px-6 flex justify-end space-x-3">
            {{ $footer }}
        </div>
    </div>
</div> 