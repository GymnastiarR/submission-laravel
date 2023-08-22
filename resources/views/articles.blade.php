<x-app-layout>
    @if (session('success'))
    <div class="fixed top-8 bg-slate-400 right-1/3 left-1/3 flex h-12 items-center justify-center rounded-lg z-10">
        <p class="text-white">{{ session('success') }}</p>
    </div>
    @endif
    @foreach ($articles as $article)
    <x-article-card :article="$article" :status="true" :sunting="true" :hapus="true" :category="true" />
    @endforeach
    <div class="d-flex justify-content-center">
        {!! $articles->links() !!}
    </div>
</x-app-layout>