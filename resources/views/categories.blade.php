<x-app-layout>
    <form action="{{ route("categories.index") }}" method="POST" class="mb-4">
        @csrf
        <h2 class="font-semibold mb-3">Buat Kategori Baru</h2>
        <div class="flex flex-col w-1/2">
            <label for="" class="mb-2 text-sm">Nama Kategori</label>
            <input type="text" class="rounded-md mb-2" name="name">
        </div>
        <div class="flex flex-col w-1/2">
            <label for="" class="mb-2 text-sm">Slug Kategori</label>
            <input type="text" class="rounded-md mb-2" name="slug">
        </div>
        <button class="text-xs px-4 py-2 bg-blue-500 text-white rounded-md">Buat Kategori</button>
    </form>
    <div class="" x-data="{ category : {}, open : false }">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left px-2 py-2">No</th>
                    <th class="text-left px-2 py-2">Nama</th>
                    <th>Jumlah Post</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td class="px-2 py-2">{{ $loop->iteration }}</td>
                    <td class="px-2 py-2">{{ $category->name }}</td>
                    <td class="w-32 text-center">{{ $category->articles_count }}</td>
                    <td class="flex justify-center">
                        <button @click="
                        () => {
                            fetch('http://localhost:8000/categories/{{ $category->id }}')
                            .then( response => response.json() )
                            .then( response =>  {
                                category = response
                                console.log(category)
                            } )
                            open = true
                        }
                        "class="text-xs px-5 py-2 bg-blue-500 rounded-md text-white mx-2">Edit</button>
                        {{-- <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="text-xs px-5 py-2 bg-blue-500 rounded-md text-white mx-2">Hapus</button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div @click="open = false" :class="{ 'hidden' : !open }" class="fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center bg-black/50">
            <form action="{{ route('categories.update', $category->id) }}" class="bg-white w-1/3 h-1/2 rounded-md px-12 py-10" method="POST">
                @csrf
                @method("PATCH")
                <h2 class="font-semibold mb-4">Edit Kategori</h2>
                <p></p>
                <div class="flex flex-col mb-4">
                    <label for="" class="text-sm mb-2">Nama</label>
                    <input type="text" class="text-rounded" :value="category.name" name="name">
                </div>
                <div class="flex flex-col mb-4">
                    <label for="" class="text-sm mb-2">Slug</label>
                    <input type="text" class="text-rounded" :value="category.slug" name="slug">
                </div>
                <button class="px-6 py-2 bg-blue-600 rounded-md text-white text-sm">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>