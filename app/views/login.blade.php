@extends('layouts.login')

@section('content')
    <div class="login">
        <h2>Login</h2>
        <div class="body">
            @foreach ($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach

            {{ Form::open() }}
                <div class="field_list">
                    <input type="email" name="email" placeholder="email" class="field">
                    <input type="password" name="password" placeholder="Password" class="field">
                    <div style="display: none;"><input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label></div>
                </div>
                <div class="button_list">
                    <a href="{{ URL::route('rega') }}" class="reg">Registration</a>
                    <input type="submit" value="Sign in">
                </div>

            {{ Form::close() }}
        </div>
    </div>

@stop