@extends('chat.app')

@section('title', 'Chat Users')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white text-center fs-4 rounded-top-4">
                    Chat Users
                </div>

                <div class="list-group list-group-flush">
                    <!-- Chatted users first -->
                    @forelse($chattedUsers as $user)
                        <a href="{{ route('chat.user', ['userId' => $user->id]) }}" 
                           class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 position-relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=40" 
                                 alt="{{ $user->name }}" class="rounded-circle" width="50" height="50">

                            <div class="flex-grow-1">
                                <div class="fw-bold">{{ $user->name }}</div>
                                <div class="fw-bold">{{ $user->role }}</div>
                                <small class="text-muted">Recent chat</small>
                            </div>

                        
                        </a>
                    @empty
                        <div class="list-group-item text-center text-muted py-4">
                            No recent chats.
                        </div>
                    @endforelse

                    <!-- Divider -->
                    @if($chattedUsers->count() && $otherUsers->count())
                        <div class="text-center text-muted small py-2 border-top">
                            Other Users
                        </div>
                    @endif

                    <!-- Other users -->
                    @forelse($otherUsers as $user)
                        <a href="{{ route('chat.user', ['userId' => $user->id]) }}" 
                           class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=40" 
                                 alt="{{ $user->name }}" class="rounded-circle" width="50" height="50">

                            <div class="flex-grow-1 fw-semibold">{{ $user->name }}</div>
                            <div class="flex-grow-1 fw-semibold">{{ $user->role }}</div>
                        </a>
                    @empty
                        <div class="list-group-item text-center text-muted py-4">
                            No other users.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
