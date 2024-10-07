@extends('layouts.chat')
@section('side-content')
    @livewire('sidebar')
@endsection

@section('main-content')
    {{-- @isset($user)
        @livewire('main-chat-area', ['user' => $user, 'group' => null, 'messages' => $messages])
    @endisset

    @isset($group)
        @livewire('main-chat-area', ['user' => null, 'group' => $group, 'messages' => $messages])
    @endisset --}}

    @if (isset($user) || isset($group))
        @livewire('main-chat-area', ['user' => $user, 'group' => $group, 'messages' => $messages])
    @endif

    @if (!isset($user) && !isset($group))
        <h2> Huy tobi a ne chats </h2>
    @endif
@endsection
