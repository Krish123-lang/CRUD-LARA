@extends('layout.app')

@section('title')
    Edit
@endsection

@section('content')
    <form action="{{ route('student.update', $data->id) }}" method="post">
        @csrf
        @method('PUT')

        <input type="text" name="firstname" value=" {{ $data->firstname }} "><br><br>
        <input type="text" name="lastname" value=" {{ $data->lastname }} "><br><br>
        <input type="submit" value="Submit">
    </form>
@endsection
