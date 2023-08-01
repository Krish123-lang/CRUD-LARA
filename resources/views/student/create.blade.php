@extends('layout.app')

@section('title')
    Create
@endsection

@section('content')
    <form action="{{route('student.store')}}" method="post">
        @csrf

        <input type="text" name="firstname" placeholder="First Name"><br><br>
        <input type="text" name="lastname" placeholder="Last Name"><br><br>
        <input type="submit" value="Submit">
    </form>
@endsection
