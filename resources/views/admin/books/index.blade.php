@include('alerts.messages')
@foreach($books as $book)
	<div>
		<a href="{{url('books/'.$book->id.'/edit')}}">{{$book->id}}</a>
		<p>{{$book->name}}</p>
		@if($book->logo != '')
			<img src="/images/book_images/{{$book->logo}}" height="50">
		@else
			<img src="/images/book_images/default.jpg" height="50">
		@endif
	</div>
	<br>
	<hr>
	
@endforeach