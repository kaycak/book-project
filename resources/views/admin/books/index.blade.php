@include('alerts.messages')
@foreach($books as $book)
	<div>
		{!! Form::open([ 'url' => url('books/'.$book->id), 'method' => 'DELETE' ]) !!}
			<a href="{{url('books/create')}}">Add book</a>
            <br>
            <br>
            <a href="{{url('books/'.$book->id)}}">Show book</a>
            <br>
            <br>
            <a href="{{url('books/'.$book->id.'/edit')}}">Edit book</a>
            <br>
            <br>
            {!! Form::submit('Delete book') !!}
        {!! Form::close() !!}
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