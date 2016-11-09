<h1>{{$book->name}}</h1>
<br/>
<hr/>
@if($book->logo != '')
    <img src="/images/book_images/{{$book->logo}}" height="50">
@else
    <img src="/images/book_images/default.jpg" height="50">
@endif
<hr/>

<table>
    <thead>
        <th>page number</th>
        <th>page image</th>
    </thead>
    <tbody>
        @foreach($pages as $page)
            <tr>
                <td><a href="{{url('/pages/'.$page->id)}}">{{$page->page_number}}</a></td>
                <td><img src="/images/page_images/{{$page->image_path}}" alt="" width="20"/></td>
            </tr>
        @endforeach
    </tbody>
</table>