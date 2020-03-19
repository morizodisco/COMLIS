@extends('common.layout')
@include('common.header')
@section('content')
    <table>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
        </tr>
        @foreach($data as $val)
        <tr>
            <td>{{ $val->id }}</td>
            <td>{{ $val->member_name }}</td>
            <td>{{ $val->email }}</td>
        </tr>
        @endforeach
    </table>
@stop
@include('common.footer')
