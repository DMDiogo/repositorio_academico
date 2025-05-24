<div class="px-6 py-4">
    <div class="text-sm text-gray-900">
        <p class="font-medium">{{ $publication->title }}</p>
        <div class="flex items-center space-x-2 mt-2">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                {{ $publication->course }}
            </span>
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                {{ $publication->discipline }}
            </span>
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                {{ $publication->publicationType->name }}
            </span>
        </div>
        <p class="text-gray-500 mt-2">{{ $publication->publication_date->format('d/m/Y') }}</p>
    </div>
</div>