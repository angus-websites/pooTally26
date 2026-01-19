@extends('layouts.master')

@section('title', $title ?? null)

@section('master-content')
    <div class="min-h-screen flex flex-col">
        <x-public.header/>
        <div class="flex-1 flex">
            @yield('content')
        </div>
        <x-public.footer/>
    </div>
@endsection
