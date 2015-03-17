@extends('layouts.login')

@section('content')

<div class="login register">
    <h2>Registration</h2>
    @foreach ($errors->all() as $error)
        <p class="error">{{ $error }}</p>
    @endforeach

    {{ Form::open( array('autocomplete' => 'off', ) ) }}
        <div class="field_list">
            <input type="text" name="username" placeholder="Username" class="field">
            <input type="email" name="email" placeholder="email" class="field">
            <input type="password" name="password" placeholder="Password" class="field">
        </div>
        <div class="button_list">
            <input type="submit" value="Sing Up">
        </div>

    {{ Form::close() }}

</div>

@stop