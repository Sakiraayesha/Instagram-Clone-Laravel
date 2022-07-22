@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-6 d-flex flex-column">
            @if($posts->count() < 1) 
            <div class="d-flex justify-content-center mt-5">
                <h5>
                    Follow people to see their posts!
                </h5>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <div>Go to your profile 
                    <a href="/profile/{{ auth()->user()->id }}" class="text-decoration-none">
                        <span class="text-dark font-weight-bold">
                            {{ auth()->user()->username }}
                        </span>
                    </a>
                </div>
            </div>       
            @else
                @foreach ($posts as $post)
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center border border-gray bg-white p-2">
                            <div class="mr-2">
                                <a href="/profile/{{ $post->user_id }}" class="text-decoration-none">
                                    <img src="{{  $post->user->profile->profileImage() }}" 
                                        class="rounded-circle w-100" alt="" style="max-width:45px">
                                </a>
                            </div>
                            <div>
                                <a href="/profile/{{ $post->user_id }}" class="text-decoration-none">
                                    <span class="text-dark font-weight-bold">
                                        {{ $post->user->username }}
                                    </span>
                                </a>
                            </div>
                            <div style="width: 20px" class="ml-auto">
                                <img src="/icons/icons8-more-32.png" class="w-100">
                            </div>
                        </div>
                        <div>
                            <a href="/p/{{ $post->id }}">
                                <img src="/storage/{{ $post->image }}" class="w-100" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="d-flex mt-2 mb-5">
                        <div>
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
        @if($suggestions->count() > 0)
            <div class="border border-gray bg-white col-3 p-3" style="height: fit-content">
                <div class="text-muted">Suggestions For You</div>
                @foreach ($suggestions as $suggestion)
                    <div class="d-flex align-items-center mt-3">
                        <div class="mr-2">
                            <a href="/profile/{{ $suggestion->id }}" class="text-decoration-none">
                                <img src="{{  $suggestion->profile->profileImage() }}" 
                                    class="rounded-circle w-100" alt="" style="max-width:45px">
                            </a>
                        </div>
                        <div>
                            <a href="/profile/{{ $suggestion->id }}" class="text-decoration-none">
                                <span class="text-dark font-weight-bold">
                                    {{$suggestion->username}}
                                </span>
                            </a>
                        </div>
                        <div class="ml-auto"><follow-button user-id="{{ $suggestion->id }}" follows="" postview=true></follow-button></div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
