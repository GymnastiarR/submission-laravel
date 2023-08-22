<x-app-layout>
    <form class="py-4 px-6" action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if (isset($article))
            @method('PATCH')
        @endif
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <div class="flex flex-col mb-4">
                <input value="{{ $article->title ?? @old('title') }}" name="title" placeholder="Judul Artikel" type="text" class="border-none text-xl px-0">
            </div>
        </div>
        <input value="{{ $article->content ?? @old('content') }}" id="content" type="hidden" name="content">
        <trix-editor input="content" class="min-h-[70vh] mb-5 text-sm p-3"></trix-editor>
        <div class="mb-6">
            <div class="flex flex-col mb-6">
                <label for="" class="mb-2 font-semibold text-sm" >Slug</label>
                <input value="{{ $article->slug ?? @old('slug') }}" name="slug" type="text" class="text-sm w-1/2 border-gray-300 border-2">
            </div>
            <div class="flex flex-col mb-6">
                <label for="" class="mb-2 font-semibold text-sm">Kategori</label>
                <select class="text-sm w-1/2 border-gray-300 border-2" name="category" id="category">
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach ($categories as $category)
                    <option  value="{{ $category->id }}" {{ isset($article) ? $article->category_id == $category->id ? 'selected' : '' : (old('category') == $category->id ? 'selected' : '')}}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col mb-6 w-1/2" x-data="{tags : {{ isset($article) ? $article->tags : (old('tags') ? json_encode($tags->whereIn('id', old('tags'))) : '[]')  }}}">
                <label for="" class="mb-2 font-semibold text-sm">Tags</label>
                <div class="flex mb-2 flex-wrap">
                    <template x-for="tag in tags">
                        <p @click="tags.splice(tags.indexOf(tag), 1)" x-text="tag['name']" class="text-xs px-5 text-white py-2 bg-slate-500 rounded-full mx-1 mb-2"></p>
                    </template>
                </div>
                <div>
                    <template x-for="(tag, index) in tags">
                        <input type="hidden" :name="'tags['+index+']'" :value="tag['id']">
                    </template>
                </div>
                <div x-data="{open : false}">
                    <div class="border-2 px-3 py-2" @click="open = !open">
                        <p class="text-sm">Pilih Kategori</p>
                    </div>
                    <div :class="{'hidden' : !open}" class="flex flex-col">
                        @foreach ($tags as $tag)
                        <button @click.prevent="tags.push({{ $tag }})" class="w-full text-left px-2 py-1 border-2">{{ $tag->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div x-data="{'preview' : false}" class="flex flex-col mb-6">
                <label for="thumbnail" class="mb-2 font-semibold text-sm">Thumbnail</label>
                <input @change="preview = true" value="{{ old('thumbnail') }}" name="thumbnail" id="thumbnail" type="file" class="text-sm w-1/2 border-gray-300 border-2 mb-3">
                <img src="{{ $article->thumbnail ?? '' }}" id="preview-image" alt="" class="w-72 h-72 object-cover" :class="{'hidden' : !preview}">
            </div>
        </div>
        @if (!isset($article->posted_at)) 
        <div>
            <button name="publish" class="bg-blue-500 px-6 py-2 text-sm text-white rounded-md">Publish</button>
            <button class="border-2 border-slate-400 px-5 py-[7px] text-sm  rounded-md">Save as Draft</button>
        </div>
        @else
        <div>
            <button class="bg-blue-500 px-6 py-2 text-sm text-white rounded-md">Update</button>
        </div>
        @endif
    </form>
    <script>
        const image = document.getElementById('thumbnail');
        image.addEventListener('change', function() {
            const file = this.files[0];
            const url = window.URL.createObjectURL(file);
            document.getElementById('preview-image').src = url;
        });
    </script>
</x-app-layout>