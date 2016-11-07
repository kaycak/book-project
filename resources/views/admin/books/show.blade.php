<h1>{{$book->name}}</h1>
<br/>
<hr/>
@if($book->logo != '')
    <img src="/images/book_images/{{$book->logo}}" height="200">
@else
    <img src="/images/book_images/default.jpg" height="200">
@endif
<hr/>