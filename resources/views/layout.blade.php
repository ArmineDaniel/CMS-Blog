<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial;
            padding: 20px;
            background: #f1f1f1;
        }
        .header {
            padding: 30px;
            font-size: 40px;
            text-align: center;
            background: white;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        .search {
            width: 25%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .navbar a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }


        .subnav .subnavbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .navbar a:hover, .subnav:hover .subnavbtn {
            background-color: red;
        }

        .subnav-content a {
            float: left;
            color: white;
            text-decoration: none;
        }

        .subnav-content a:hover {
            background-color: #eee;
            color: black;
        }

        .subnav:hover .subnav-content {
            display: block;
        }

        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font: inherit;
            margin: 0;
        }

        .navbar a:hover, .dropdown:hover .dropbtn {
            background-color: red;
        }

        .dropdown-content .header {
            background: red;
            padding: 16px;
            color: white;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }


        .column a {
            float: none;
            color: black;
            padding: 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .column a:hover {
            background-color: #ddd;
        }
        ul.horizontal li{
            display:block;
            float:left;
            padding:0 10px;
        }

        .filter {
            flex-grow: 1;
            flex-shrink: 1;
            flex-basis: 100px;
        }


        @media screen and (max-width: 800px) {
            .column {
                width: 100%;
                height: auto;
            }
            .leftcolumn {
                width: 100%;
                padding: 0;
            }
        }
    </style>
</head>
<body>
<div class="header">
    <h2>  <a href="{{route('blog')}}">Blog</a> </h2>
</div>
<div class="filter">
<form action="{{route('blog')}}" method="GET">
    <input type="text" name="search" placeholder="Article's title or hashtag" class="search" required/>
    <button type="submit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Search</button>
</form>
<form action="{{route('sort_ascending')}}" method="GET">
        <button type="submit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Sort ascending</button>
</form>
<form action="{{route('sort_descending')}}" method="GET">
    <button type="submit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Sort descending</button>
</form>
</div>
    <table class="w-10 text-md rounded mb-4">
        <thead>
        <tr class="border-b">
            <th class="text-left p-3 px-5">Categories</th>
            <th></th>
        </tr>
        </thead>
        <tbody  style="overflow-y:scroll; height:200px; width:200px; display:block;">
        @foreach($categories as $category)
            <tr class="border-b hover:bg-orange-100">
                            <td class="p-3 px-5">
                                <a href="{{route('filter', ['category' => $category->title])}}" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">{{$category->title}}</a>
                            @if(count($category->children))
                                    @include('category-partial',['subcategories' => $category->children])
                                @endif
                            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
<div id="main" class="row">
    @yield('content')
    {{ $articles->links() }}
</div>
</body>
</html>
