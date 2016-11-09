<h1>{{$book->name}}</h1>
<br/>
<hr/>
@if($book->logo != '')
    <img src="/images/book_images/{{$book->logo}}" height="50">
@else
    <img src="/images/book_images/default.jpg" height="50">
@endif
<hr/>

{{--<table>--}}
    {{--<thead>--}}
    {{--<th>line number</th>--}}
    {{--<th>line image</th>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach($lines as $line)--}}
        {{--<tr>--}}
            {{--<td></td>--}}
            {{--<td></td>--}}
        {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
{{--</table>--}}