@extends('layout')
    @section('content')
    <div class="leftcolumn">
        @foreach($articles as $article)
            <div class="card">
                <h2>{{$article->title}}</h2>
                <h5>{{date("Y-m-d H:i",strtotime("$article->published_at"))}}</h5>
                <div>
                    <img src={{asset('/'.$article->image)}} width="300" height="300">
                </div>
                <h5>{{$article->description}}</h5>
                @php
                $hashtagsArray = explode(",",$article->hashtags)
                    @endphp
                @foreach($hashtagsArray as $hashtag)
                    <a href="{{route('search_hashtag', ['hashtag' => $hashtag])}}" name="hashtag" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">{{$hashtag}}</a>
                @endforeach
                <br>
            <a href="{{route('read_article', ['article' => $article->id])}}" name="read" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Read more</a>
            </div>
                @endforeach
    </div>
@endsection

