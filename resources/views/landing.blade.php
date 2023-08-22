<x-general-layout>
    <div class="w-3/4 mr-8">
            <div>
                @foreach ($articles as $article)
                {{-- @if ($loop->iteration % 2 == 1) --}}
                <x-article-card :article="$article"/>
                {{-- @endif --}}
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {!! $articles->links() !!}
            </div>
    </div>
    <div class="w-1/4 bg-white rounded-md drop-shadow-md px-8 py-5">
        @include('layouts.widget')
    </div>
</x-general-layout>