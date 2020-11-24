@extends('layouts.default')
@section('title', '注册')

@section('content')
  <div class="offset-md-2 col-md-8">
    <div class="card">
      <div class="card-header">
        <h5>注册</h5>
      </div>
    </div>

    <div class="card-body">
      <form action="{{ route('users.store') }}" method="post">
        <div class="form-group">
          <label for="name">名称：</label>
          <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
          <label for="email">邮箱：</label>
          <input type="email" class="form-control" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
          <label for="password">密码：</label>
          <input type="password" class="form-control" name="pasword" value="{{ old('pasword') }}">
        </div>

        <div class="form-group">
          <label for="password_confirmation">确认密码：</label>
          <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
        </div>

        <button class="btn btn-primary" type="submit">注册</button>

      </form>
    </div>
  </div>
@endsection
