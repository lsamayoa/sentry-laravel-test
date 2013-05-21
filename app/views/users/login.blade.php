@extends('layouts.scaffold')

@section('main')

{{ Form::open( array('route' => 'users.authenticate' )) }}
    <ul>
        <li>
            {{ Form::label('email', 'Email:') }}
            {{ Form::text('email') }}
        </li>

        <li>
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password') }}
        </li>

        <li>
            {{ Form::submit('Login', array('class' => 'btn btn-info')) }}
        </li>
    </ul>
{{ Form::close() }}
@stop