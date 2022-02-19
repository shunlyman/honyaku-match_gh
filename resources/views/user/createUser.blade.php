@extends('layouts.layout')

@section('title','ユーザー登録')

@section('content')



<section class="p-md-5">
    <form method="post" action="{{ url('/create_user_finish') }}" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="exampleInputName">ユーザー名 *公開</label>
            <input type="name" class="form-control" name="name"  placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email"  placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password"  placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">プロフィール画像</label>
                <div class="input-group">
                <input type="file" class="from-control"  name="test_gazou" style="width:400px">
                </div>
        </div>
        <br></br>
        <div class="form-group">    
        <button type="submit" class="btn btn-primary">送信</button>
        </div>
    </form>
</section>

@endsection