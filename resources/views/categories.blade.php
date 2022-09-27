<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('categories')}}" class="mr-3 text-sm bg-orange-500 hover:bg-orange-700 text-white py-5 px-10 rounded focus:outline-none focus:shadow-outline">Categories</a>
        </h2>
        <div>
            <form action="{{route('categories')}}" method="GET">
                <input type="text" name="search" placeholder="Category's title" required/>
                <button type="submit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Search</button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">Categories List</div>

                    <div class="flex-auto text-right mt-2">
                        <a href="{{route('category_create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add new category</a>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Title</th>
                        <th class="text-left p-3 px-5">Description</th>
                        <th class="text-left p-3 px-5">Image</th>
                        <th class="text-left p-3 px-5">Published time</th>
                        <th class="text-left p-3 px-5"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                {{$category->title}}
                            </td>
                            <td class="p-3 px-5">
                                {{$category->description}}
                            </td>
                            <td class="p-3 px-5">
                                <img src={{$category->image}} width="100" height="100">
                            </td>
                            <td class="p-3 px-5">
                                {{$category->published_at}}
                            </td>
                            <td class="p-3 px-5">
                                <form action="{{route('category_publish', ['category' => $category->id])}}" class="inline-block">
                                    <button type="submit" name="published" formmethod="POST" class="text-sm bg-green-500 hover:bg-green-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Publish</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                            <td class="p-3 px-5">
                                <form action="{{route('category_draft', ['category' => $category->id])}}" class="inline-block">
                                    <button type="submit" name="draft" formmethod="POST" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Draft</button>
                                    {{ csrf_field() }}
                                </form>
                            </td>
                            <td class="p-3 px-5">
                                <a href="{{route('category_edit', ['category' => $category->id])}}" name="edit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
                            </td>
                            <td class="p-3 px-5">
                                <form action="{{route('category_delete', ['category' => $category->id])}}" class="inline-block">
                                    <button type="submit" name="delete" formmethod="POST" onclick="return confirm('Are you sure you want to delete this category?');" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
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
    {{ $categories->links() }}
</x-app-layout>
