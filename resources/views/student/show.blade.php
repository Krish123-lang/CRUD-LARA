@extends('layout.app')

@section('title')
    Show
@endsection

@section('content')
    <a href="{{ route('student.index') }}">Home</a>
    <h1>Student Data</h1>

    <p><b>First Name: </b> {{ $data->firstname }} </p>
    <p><b>Last Name: </b> {{ $data->lastname }} </p>
@endsection
