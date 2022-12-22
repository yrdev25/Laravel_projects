@extends('layouts.app')

@section('header')
Dashboard
@endsection

@section('content')
{{ Auth::id() }}
@endsection
