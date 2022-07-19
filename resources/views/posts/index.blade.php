@extends('layouts.app')

@section('content')
<div class="container">
    @if($posts->count() < 1) 
        <div class="row d-flex justify-content-center">
            <h5 class="col-5">
                Follow people to see their posts!
            </h5>
        </div>
        <div class="row d-flex justify-content-center mt-2">
            <div class="col-4">Go to your profile 
                <a href="/profile/{{ auth()->user()->id }}" class="text-decoration-none">
                    <span class="text-dark font-weight-bold">
                        {{ auth()->user()->username }}
                    </span>
                </a>
            </div>
        </div>       
    @else
        @foreach ($posts as $post)
            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <img src="/storage/{{ $post->image }}" class="w-100" alt="">
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2 mb-5">
                <div class="col-6">
                    <a href="/profile/{{ $post->user_id }}" class="text-decoration-none">
                        <span class="text-dark font-weight-bold">
                            {{ $post->user->username }}
                        </span>
                    </a>
                    <span>{{ $post->caption }}</span>  
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
</div>
@endsection
