@extends('main') 
@section('content') 
<p>
{{ Form::model($user, array('id' => 'upate-form', 'action' => array('UserController@updateUser', $user->id))) }}
	{{ Form::label('first_name', 'First Name') }}
	{{ Form::text('first_name') }} 
	<br> 
	{{ Form::label('last_name', 'Last Name') }}
	{{ Form::text('last_name') }}
	<br>
	{{ Form::label('email', 'Email') }}
	{{ Form::text('email'); }}
	<br>
	{{ Form::label('birthday', 'Birthday') }}
	{{ Form::text('birthday') }}
	<br>
	{{ Form::submit('Update') }}
{{ Form::close() }}
@stop
