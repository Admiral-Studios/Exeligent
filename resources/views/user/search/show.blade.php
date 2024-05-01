@extends('layouts.user')

@section('title', $executive->full_name . ' | ' . config('app.name'))
@section('content')

    @include('user.search.includes.show')

@endsection

