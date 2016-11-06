@if(isset($book))
	<h3>Edit book</h3>
	{!! Form::model($book, ['url' => '/books/'.$book->id, 'method' => 'PUT', 'files' => 'true']) !!}
@else
	<h3>Add book</h3>
{!! Form::open(['url' => '/books', 'method' => 'POST', 'files' => 'true']) !!}
@endif

<p>
	{!! Form::label('name', 'Book Name') !!}
</p>
{!! Form::text('name', null) !!}

<p>
	{!! Form::label('logo', 'Book Logo Image') !!}
</p>

{!! Form::file('logo', null) !!}
<br>
@if(isset($book))
	@if($book->logo != '')
		<img src="/images/book_images/{{$book->logo}}" height="50">
	@else
		<img src="/images/book_images/default.jpg" height="50">
	@endif
@endif
<br>
<br>
{!! Form::submit('Add Book') !!}
{!! Form::close() !!}