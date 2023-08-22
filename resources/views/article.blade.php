<x-general-layout>
    <div class="min-h-screen w-[75%] bg-white drop-shadow-md mr-5 rounded-md overflow-hidden">
        @if ($article->posted_at == null)
        <div class="absolute top-0 z-10  bg-blue-600">
            <p class="px-8 py-2 text-white">PREVIEW</p>
        </div>
        @endif
        <img class="w-full h-80 object-cover mb-3" src="{{ isset($article->thumbnail) ? url("storage/{$article->thumbnail}") : url("storage/placeholder.png") }}" alt="">
        <div class="px-16">
            <h2 class="text-xl font-semibold mb-2">{{ $article->title }}</h2>
            <div class="mb-5">
                <p class="text-sm mb-3">Publish At {{ \Carbon\Carbon::parse($article->posted_at)->diffForHumans()}} By {{ $article->user->name }}</p>
                <a href="" class="text-xs bg-slate-600 text-white px-4 py-2 rounded-full">{{ $article->category->name }}</a>
            </div>
            <div>
                {!! $article->content !!}
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        @include('layouts.widget')
    </div>
</x-general-layout>