<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('categories')}}" class="mr-3 text-sm bg-orange-500 hover:bg-orange-700 text-white py-5 px-10 rounded focus:outline-none focus:shadow-outline">Categories</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <form action="{{route('category_store')}}" method="POST" enctype="multipart/form-data">
                    <table class="w-full text-md rounded mb-4">
                        <thead>
                        <tr class="border-b">
                            <th class="text-left p-3 px-5">
                                <label for="categoryTitle">Title</label>
                            </th>
                            <th class="text-left p-3 px-5">
                                <label for="categoryImage">Image</label>
                            </th>
                            <th class="text-left p-3 px-5">
                                <label for="categoryMeta_title">Meta title</label>
                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                <input type="text"  name="categoryTitle" />
                                @if ($errors->has('categoryTitle'))
                                    <span class="text-danger">{{ $errors->first('categoryTitle') }}</span>
                                @endif
                            </td>
                            <td class="p-3 px-5">
                                <input type="file"  name="categoryImage" placeholder="Image" required/>
                            </td>
                            <td class="p-3 px-5">
                                <input type="text"  name="categoryMeta_title" />
                                @if ($errors->has('categoryMeta_title'))
                                    <span class="text-danger">{{ $errors->first('categoryMeta_title') }}</span>
                                @endif
                            </td>
                        </tr>
                        </tbody>

                        <table class="w-10 text-md rounded mb-4">
                            <thead>
                            <tr class="border-b">
                                <th class="text-left p-3 px-5">Parent category</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody  style="overflow-y:scroll; height:300px; width:200px; display:block;">
                            @foreach($categories as $parentCategory)
                                <tr class="border-b hover:bg-orange-100">
                                    <td class="p-3 px-5">
                                        {{ $parentCategory->title }}
                                    </td>
                                    <td class="p-3 px-5">
                                        <input type="checkbox" name="checked[]" value="{{$parentCategory->id}}" />
                                    </td>
                                </tr>
                            @endforeach
                            @if ($errors->has('checked'))
                                <span class="text-danger">{{ $errors->first('checked') }}</span>
                            @endif
                            </tbody>
                        </table>
                        <div class="form-group">
                            <textarea name="categoryDescription" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Enter description' ></textarea>
                            @if ($errors->has('categoryDescription'))
                                <span class="text-danger">{{ $errors->first('categoryDescription') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea name="categoryMeta_description" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"  placeholder='Enter meta description' ></textarea>
                            @if ($errors->has('categoryMeta_description'))
                                <span class="text-danger">{{ $errors->first('categoryMeta_description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Category</button>
                        </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
