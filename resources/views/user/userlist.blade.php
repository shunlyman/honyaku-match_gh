@extends('layouts.layout')

@section('title','ユーザーリスト')

@section('content')

<table class="table">
    <thead>
    <tr>
        <th scope="col">ユーザーID</th>
        <th scope="col">名前</th>
        <th scope="col">メール</th>
        <th scope="col">登録日</th>
        <th scope="col">更新日</th>
    </tr>
    </thead>
    <tbody>
        @for($i = 0; $i < count($users); $i++)
        <tr>
            <th scope="row">{{ $users[$i]->id }}</th>
            <td>{{ $users[$i]->name }}</td>
            <td>{{ $users[$i]->email }}</td>
            <td>{{ $users[$i]->created_at }}</td>
            <td>{{ $users[$i]->updated_at }}</td>
        </tr>
        @endfor
    </tbody>
</table>    






@endsection