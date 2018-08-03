@extends('layout')




@section('content')

		<div class="container text-center">
			<h4>Get confirmation link</h4>
			
			<form action="{{ route('send-confirmation-email', $user) }}" method="POST">
				{{ csrf_field() }}
				<input type="hidden" value="{{$user->email}}" name="email">
				<button type="submit" class="btn">Send!</button>

			</form>

				
		</div>				

@endsection
