@extends('main') 
@section('content') 
@foreach($users as $user)
<p>
	{{ $user->first_name }} : {{ $user->last_name }} : {{
	$user->email }} : {{ $user->birthday }} 
	{{ Form::button( 'Delete',
	array('class' => 'delete-button', 'data-userid' => $user->id )) }}
	{{ HTML::link(URL::to('user/'.$user->id.'/edit'), 'Edit') }}	
</p>
@endforeach
{{ HTML::link(URL::to('user/create'), 'Add user') }} 
@stop
 @section('jquery')
<script type="text/javascript">
jQuery(document).ready( function( $ ) {
	 
    $( '.delete-button' ).on( 'click', function() {
        
    	var userid = $(this).data('userid');
    	$.ajax({
            url: 'user/'+userid,
            type: 'DELETE',
            success: function(result) {
            	$('#content').empty();
         		$('#content').append(result)	;
            }
        });
    } );
	/*$( '.edit-button' ).on( 'click', function() {
        
    	var userid = $(this).data('userid');
    	$.ajax({
            url: 'users/'+userid,
            type: 'get',
            success: function(result) {
            	$('#content').empty();
         		$('#content').append(result)	;
            },
        	error: function(result, status, error) {
            	alert(result);d
        	}
        });
    } );	
	    $( '#update-form' ).submit(function(e) {
	        e.preventDefault();
	    	$.post(
	                $(this).prop( 'action' ),
	                {
	                    "_token": $( this ).find( 'input[name=_token]' ).val(),
	                },
	                function( data ) {
	                	$('#content').empty();
	             		$('#content').append(result)	;
	                }
	            );
	    } );*/
} );
</script>
@stop
