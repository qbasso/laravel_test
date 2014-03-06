@extends('main') 
@section('content') 
<p>
{{ Form::model($user, array('id' => 'update-form', 'data-userid' => $user->id, 'action' => array('UserController2@update', $user->id), 'method' => 'put')) }}
	{{ Form::hidden('id') }}
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
@section('jquery')
<script type="text/javascript">
jQuery(document).ready( function( $ ) {
	 
    $( '#update-form' ).on( 'submit', function(e) {
        e.preventDefault();
    	$.ajax({
            url: $(this).prop('action'),
            type: 'PUT',
            data: $('form').serialize(),
            success: function(result) {
            	window.location = 'http://laravel-test/user';
            }
        });
    } );
});
</script>
@stop
