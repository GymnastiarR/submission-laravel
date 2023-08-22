<div class="mb-5">
    <h2 class="font-semibold mb-2">Kategori</h2>
    <div class="flex flex-wrap">
        @foreach ($categories as $category)
        <a class="text-xs text-gray-500 hover:text-black px-4 py-2 rounded-full border-gray-500 border-2 inline mr-2 mb-2">{{ $category->name }}</a>
        @endforeach
    </div>
</div>
<div class="">
    <h2 class="font-semibold mb-2">Tags</h2>
    <div class="flex flex-wrap">
        @foreach ($tags as $tag)
        <a class="text-xs text-gray-500 hover:text-black px-4 py-2 rounded-full border-gray-500 border-2 inline mr-2 mb-2">{{ $tag->name }}</a>
        @endforeach
    </div>
</div>