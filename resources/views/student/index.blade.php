@extends('layout.app')

@section('title')
    Home
@endsection

@section('content')
    <a href="{{ route('student.create') }}">Add student</a>

    @if (session()->has('success'))
        <b>{{ session()->get('success') }}</b>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $dt)
                <tr>
                    <th scope="row"> {{ $dt->id }} </th>
                    <td> {{ $dt->firstname }} </td>
                    <td> {{ $dt->lastname }} </td>
                    <td>
                        <a href="{{ route('student.show', $dt->id) }}">Show</a>
                        <a href="{{ route('student.edit', $dt->id) }}">Edit</a>

                        <form action="{{ route('student.destroy', $dt->id) }}" method="post" style="display: inline"
                            onsubmit="confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')

                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
