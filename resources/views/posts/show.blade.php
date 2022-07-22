@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-8 col-md-7 col-lg-5 border-top border-bottom border-left border-gray p-0">
            <img src="/storage/{{ $post->image }}" class="w-100" alt="">
        </div>
        <div class="col-4 col-lg-3 border-top border-bottom border-right border-gray p-0 bg-white">
            <div class="d-flex flex-column h-100">
                <div class="d-flex align-items-center border-bottom border-gray pb-3 pt-3">
                    <div class="mr-2 ml-3">
                        <img src="{{ $post->user->profile->profileImage() }}" 
                        class="rounded-circle w-100" alt="" style="max-width:40px">
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="/profile/{{ $post->user_id }}" class="text-decoration-none mr-1">
                            <span class="text-dark font-weight-bold">
                                {{ $post->user->username }}
                            </span>
                        </a>
                        @cannot ('update', $post->user->profile)
                            &bull;
                            <follow-button user-id="{{ $post->user_id }}" follows="{{ $follows }}" postview=true></follow-button>
                        @endcannot
                    </div>
                </div>
                <div class="border-bottom border-gray pb-3 pt-3">
                    <a href="/profile/{{ $post->user_id }}" class="text-decoration-none ml-3">
                        <span class="text-dark font-weight-bold">
                            {{ $post->user->username }}
                        </span>
                    </a>
                    <span>{{ $post->caption }}</span>
                </div>
                <div class="pb-2 pt-3" id="commentbox">
                    @foreach ($comments->take(3) as $comment)
                        <div class="mb-1 ml-3 commentclass">
                            <img src="{{ $comment->user->profile->profileImage() }}" 
                                class="rounded-circle w-100" alt="" style="max-width:25px">
                            <a href="/profile/{{ $comment->user_id }}" class="text-decoration-none">
                                <span class="text-dark font-weight-bold">
                                    {{ $comment->user->username }}
                                </span>
                            </a>
                            <span> {{ $comment->comment }}</span>    
                        </div>
                    @endforeach
                    @if($loadmoreComments > 0)
                    <div class="text-center">
                        <span class="fs-8 text-muted">
                            Load {{ $loadmoreComments }} 
                            {{ $loadmoreComments > 1 ? "more comments" : "more comment" }}
                        </span>
                    </div>
                    @endif
                </div>
                <div class="border-top border-gray pt-2 pb-3 mt-auto d-flex flex-column">
                    <div class="border-bottom border-gray pb-2 pl-3">
                        <post-buttons post-id="{{ $post->id }}" likes="{{ $likes }}"></post-buttons>
                        @if($likesCount > 0)
                            <div class="mt-1">
                                <span class="fs-8 fw-bold">{{ $likesCount }} {{$likesCount > 1 ? "likes" : "like" }}</span>    
                            </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 pl-3">
                        <div>
                            <img src="{{ Auth::user()->profile->profileImage() }}" 
                                class="rounded-circle w-100" alt="" style="max-width:25px">
                            <input id="comment" type="text" name="comment" required
                                class ="fs-7" style="outline: none; border: none" placeholder="Add a comment...">    
                        </div>
                        <add-comment post-id="{{ $post->id }}" user-id="{{ Auth::user()->id }}" image="{{Auth::user()->profile->profileImage()}}" username="{{Auth::user()->username}}"></add-comment>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
@endsection
