@props(['article', 'status' => false, 'sunting' => false, 'hapus' => false, 'category' => false])

<div class="mb-3 flex flex-col md:flex-row">
    <div class="w-full md:w-1/3 h-72 relative mr-3">
        @if ($status)
        <div class="top-1 left-1 absolute bg-blue-600 px-4 py-2 rounded-md text-xs text-white">
            @if ($article->posted_at == null)
            <p>Draft</p>
            @else
            <p>Pusblished</p>
            @endif
        </div>
        @endif
        <img src='{{ $article->thumbnail ? url("storage/{$article->thumbnail}") : url("storage/placeholder.png") }}' alt="" class="w-full h-full object-cover">
    </div>
    <div class="flex-1">
        <h2 class="font-semibold mb-3"><a href="{{ !$article->posted_at ? route('articles.preview', $article->id) : route('articles.show', $article->slug) }}">{{ $article->title ? excerpt($article->title, 20) : '' }}</a></h2>
        @if ($category)
        <div class="mb-3">
            <a href="" class="px-4 py-2 bg-slate-500 rounded-full text-xs text-white">{{ $article->category->name }}</a>
        </div>
        @endif
        <p class="text-sm mb-3">{{ $article->content ? excerpt($article->content, 90) : '' }} . . .</p>
        <div class="flex">
            <div class="flex mr-3 items-center">
                <x-icons.comment fill="black" />
                <p>10</p>
            </div>
            @if ($sunting)
            <div>
                <a class="flex mr-3 items-center" href="{{ route('articles.edit', $article->id) }}">
                    <x-icons.edit fill="black" />
                    <p class="text-sm">Sunting</p>
                </a>
            </div>
            @endif
            @if ($hapus)
            <div>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="flex mr-3 items-center">
                        <x-icons.delete fill="black" />
                        <p class="text-sm">Hapus</p>
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>