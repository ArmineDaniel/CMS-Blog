<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('articles')}}" class="mr-3 text-sm bg-orange-500 hover:bg-orange-700 text-white py-5 px-10 rounded focus:outline-none focus:shadow-outline">Articles</a>
        </h2>
                    <div>
                        <form action="{{route('articles')}}" method="GET">
                            <input type="text" name="search" placeholder="Article's title or hashtag" required/>
                            <button type="submit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Search</button>
                        </form>
                    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">Articles List</div>

                    <div class="flex-auto text-right mt-2">
                        <a href="{{route('article_create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add new article</a>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Title</th>
                        <th class="text-left p-3 px-5">Description</th>
                        <th class="text-left p-3 px-5">Hashtags</th>
                        <th class="text-left p-3 px-5">Image</th>
                        <th class="text-left p-3 px-5">Published time</th>
                        <th class="text-left p-3 px-5"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                {{$article->title}}
                            </td>
                            <td class="p-3 px-5">
                                {{$article->description}}
                            </td>
                            <td class="p-3 px-5">
                                {{$article->hashtags}}
                            </td>
                            <td class="p-3 px-5">
                                <img src={{$article->image}} width="100" height="100">
                            </td>
                            <td class="p-3 px-5">
                                {{$article->published_at}}
                            </td>
                            <td class="p-3 px-5">
                                <form action="{{route('article_publish', ['article' => $article->id])}}" class="inline-block">
                                    <button type="submit" name="published" formmethod="POST" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Publish</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                            <td class="p-3 px-5">
                                <form action="{{route('article_draft', ['article' => $article->id])}}" class="inline-block">
                                    <button type="submit" name="draft" formmethod="POST" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Draft</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                            <td class="p-3 px-5">
                                <a href="{{route('article_edit', ['article' => $article->id])}}" name="edit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
                            </td>
                            <td class="p-3 px-5">
                                <form action="{{route('article_delete', ['article' => $article->id])}}" class="inline-block">
                                    <button type="submit" name="delete" formmethod="POST" onclick="return confirm('Are you sure you want to delete this article?');" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    {{ $articles->links() }}
</x-app-layout>
