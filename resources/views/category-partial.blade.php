@foreach($subcategories as $subcategory)
    <ul>
        <li><a href="{{route('filter', ['category' => $subcategory->title])}}" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">{{$subcategory->title}}</a></li>
        @if(count($subcategory->children))
            @include('category-partial',['subcategories' => $subcategory->children])
        @endif
    </ul>
@endforeach
