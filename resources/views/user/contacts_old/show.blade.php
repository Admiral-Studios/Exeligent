@extends('layouts.user')

@section('title', 'Networking Plan - Contact Info | ' . config('app.name'))

@section('content')

    @include('user.contacts.includes.show')

@endsection
