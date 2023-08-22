<aside class="bg-blue px-10 py-8 bg-blue-500 w-1/5 text-white hidden lg:block" :class="">
    <h1 class="mb-4">
        <a href="" class="text-2xl font-semibold">ContentFlowHub</a>
    </h1>
    <div>
        <ul>
            <li class="mb-3 flex items-center">
                <x-icons.dashboard />
                <a href="{{ route('dashboard') }}" class="ml-2">Dashboard</a>
            </li>
            <li class="mb-3" x-data="{ open: true }">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <x-icons.article />
                        <a href="" class="ml-2">Article</a>
                    </div>
                    <button @click="open = !open">
                        <template x-if="open">
                            <x-icons.more />
                        </template>
                        <template x-if="!open">
                            <x-icons.less />
                        </template>
                    </button>
                </div>
                <ul :class="{'hidden' : open }" class="ml-9">
                    <li class="my-2">
                        <a href="{{ route('articles.index') }}">Daftar Article</a>
                    </li>
                    <li class="my-2">
                        <a href="{{ route('articles.create') }}">Buat Article</a>
                    </li>
                    <li class="my-2">
                        <a href="{{ route('categories.index') }}">Kategori</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>