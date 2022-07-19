@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-3 p-5">
            <img 
            src="{{ $user->profile->profileImage() }}" 
            class="rounded-circle w-100"
            />
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline mb-1">
                <div class="d-flex align-items-center">
                    <div class="h5 m-0">{{ $user->username }}</div>                        
                    @cannot ('update', $user->profile)
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    @endcannot
                </div>
                @can ('update', $user->profile)
                    <a href="/p/create" class="text-decoration-none">Add New Post</a>
                @endcan
            </div>
            @can ('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit" class="text-decoration-none">Edit Profile</a>
            @endcan
            <div class="d-flex mt-3">
                <div class="pr-5"><strong>{{ $postsCount }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-3 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#" class="text-decoration-none">{{ $user->profile->url }}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" class="w-100"/>
                </a>
            </div>
        @endforeach    
    </div>
</div>
@endsection
