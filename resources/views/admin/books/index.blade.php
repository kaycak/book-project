<h2><a href="{{url('/logout')}}">Logout</a></h2>

@include('alerts.messages')

@forelse($books as $book)
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
        <p><a href="{{url('book/'.$book->id.'/add-pages')}}">Add pages for this book</a></p>
	</div>
	<br>
	<hr>
	
@empty
    <a href="{{url('books/create')}}">Add book</a>
@endforelse