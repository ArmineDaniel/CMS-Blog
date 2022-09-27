<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('articles')}}" class="mr-3 text-sm bg-orange-500 hover:bg-orange-700 text-white py-5 px-10 rounded focus:outline-none focus:shadow-outline">Articles</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <form method="POST" action="{{route('article_update', ['article' => $article->id])}}" enctype="multipart/form-data">
                    <table class="w-full text-md rounded mb-4">
                        <thead>
                        <tr class="border-b">
                            <th class="text-left p-3 px-5">
                                <label for="articleTitle">Title</label>
                            </th>
                            <th class="text-left p-3 px-5">
                                <label for="articleImage">Image</label>
                            </th>
                            <th class="text-left p-3 px-5">
                                <label for="articleMeta_title">Meta title</label>
                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                <input type="text"  name="articleTitle" value="{{$article->title}}" />
                                @if ($errors->has('articleTitle'))
                                    <span class="text-danger">{{ $errors->first('articleTitle') }}</span>
                                @endif
                            </td>
                            <td class="p-3 px-5">
                                <img src={{asset('/'.$article->image)}} width="100" height="100">
                                <input type="file"  name="articleImage" placeholder="Image" />
                            </td>
                            <td class="p-3 px-5">
                                <input type="text"  name="articleMeta_title" value="{{$article->meta_title}}" />
                                @if ($errors->has('articleMeta_title'))
                                    <span class="text-danger">{{ $errors->first('articleMeta_title') }}</span>
                                @endif
                            </td>
                        </tr>
                        </tbody>

                        <table class="w-10 text-md rounded mb-4">
                            <thead>
                            <tr class="border-b">
                                <th class="text-left p-3 px-5">Category</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody style="overflow-y:scroll; height:300px; width:200px; display:block;">
                            @foreach($categories as $category)
                                <tr class="border-b hover:bg-orange-100">
                                    <td class="p-3 px-5">
                                        {{ $category->title }}
                                    </td>
                                    <td class="p-3 px-5">
                                        <input
                                            @if($article->categories->contains('id',$category->id))
                                                checked
                                            @endif
                                            type="checkbox" name="checked[]" value="{{$category->id}}" />
                                    </td>
                                </tr>
                            @endforeach
                            @if ($errors->has('checked'))
                                <span class="text-danger">{{ $errors->first('checked') }}</span>
                            @endif
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label for="articleDescription">Description</label>
                            <textarea name="articleDescription" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" >{{$article->description }}</textarea>
                            @if ($errors->has('articleDescription'))
                                <span class="text-danger">{{ $errors->first('articleDescription')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="articleText">Text</label>
                            <textarea name="articleText" class="bg-gray-100 rounded border border-gray-400 leading-normal w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" >{{$article->text}}</textarea>
                            @if ($errors->has('articleText'))
                                <span class="text-danger">{{ $errors->first('articleText') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="hashtags">Hashtags</label>
                            <textarea name="hashtags" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">{{$article->hashtags }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="articleMeta_description">Meta description</label>
                            <textarea name="articleMeta_description" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Enter meta description' >{{$article->meta_description }}</textarea>
                            @if ($errors->has('articleMeta_description'))
                                <span class="text-danger">{{ $errors->first('articleMeta_description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update article</button>
                        </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
