@extends('layout')

@section('content')
<div class="row">
    <div class="col-8">
        @if($post->image)
        {{-- storage_path('app/public') . '/' . $post->image->path --}}
            <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px;
            color: white; text-align: center; background-attachment: fixed;">
                <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
        @else
            <h1>
        @endif
                {{ $post->title }}

                @badge(['show' => now()->diffInMinutes($post->created_at) < 30])
                {{ __('New Post!') }}
                @endbadge
        @if($post->image)
                </h1>
            </div> 
        @else
            </h1>
        @endif
        
        <p>{{ $post->content }}</p>

        {{-- <p>Added: {{ $post->created_at->diffForHumans() }}</p> --}}
        @updated(['date' => $post->created_at, 'name' => $post->user->name])
        @endupdated
        @updated(['date' => $post->updated_at])
            {{ __('Updated') }}
        @endupdated

        @tags(['tags' => $post->tags])
        @endtags

        <p>{{ trans_choice('messages.people.reading', $counter) }}</p>

        <h3>{{ __('Comments') }}</h3>

        @commentForm(['route' => route('posts.comments.store', ['post' => $post->id])])
        @endcommentForm

        @commentList(['comments' => $post->comments])
        @endcommentList
    </div>
    <div class="col-4">
        @include('posts._activity')
    </div>
</div>
@endsection