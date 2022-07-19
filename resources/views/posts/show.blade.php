@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-5">
            <img src="/storage/{{ $post->image }}" class="w-100" alt="">
        </div>
        <div class="col-3">
            <div>
                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        <img src="{{ $post->user->profile->profileImage() }}" 
                        class="rounded-circle w-100" alt="" style="max-width:40px">
                    </div>
                    <div>
                        <a href="/profile/{{ $post->user_id }}" class="text-decoration-none">
                            <span class="text-dark font-weight-bold">
                                {{ $post->user->username }}
                            </span>
                        </a>
                        &bull;
                        <a href="#">Follow</a>
                    </div>
                </div>
                <hr>
                <div>
                    <a href="/profile/{{ $post->user_id }}" class="text-decoration-none">
                        <span class="text-dark font-weight-bold">
                            {{ $post->user->username }}
                        </span>
                    </a>
                    <span>{{ $post->caption }}</span>
                </div>
            </div>    
        </div>
    </div>
</div>
@endsection
