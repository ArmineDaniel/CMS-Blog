<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> {{ $article->meta_title }} </title>
    <meta name="description" content="{{ $article->meta_description }}" />
    </head>
    <div>
        <div class="max-w-4xl mx-auto py-20 prose lg:prose-xl">
            <h1>{{ $article->title }}</h1>
            <img src={{asset('/'.$article->image)}} width="700" height="500">
            <p>{!! $article->text !!}</p>
            <p class="card-text">{{ $article->hashtags }}</p>
        </div>
    </div>

