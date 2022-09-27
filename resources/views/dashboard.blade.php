<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('articles')}}" class="inline-block">
                        <button type="submit" name="articles" class="text-sm bg-red-500 hover:bg-red-700 text-white py-2 px-3 rounded focus:outline-none focus:shadow-outline">Articles</button>
                        {{ csrf_field() }}
                    </form>

                    <form action="{{route('categories')}}" class="inline-block">
                        <button type="submit" name="categories" class="text-sm bg-red-500 hover:bg-red-700 text-white py-2 px-3 rounded focus:outline-none focus:shadow-outline">Categories</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
