Add book

{!! Form::open(['url' => '/books', 'method' => 'POST', 'files' => 'true']) !!}
	{!! Form::label('name', 'Book Name') !!}
	<br>
	{!! Form::text('name', null) !!}
	<br>
	{!! Form::label('logo', 'Book Logo Image') !!}
	<br>
	{!! Form::file('logo', null) !!}
	<br>
	<br>
	{!! Form::submit('Add Book') !!}
{!! Form::close() !!}