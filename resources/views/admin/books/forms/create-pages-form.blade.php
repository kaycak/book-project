{!! Form::open(['url' => '/book/'.$book->id.'/add-pages', 'method' => 'POST', 'files' => true, 'id' => 'form']) !!}
    <div>
        <div class="form_div">
            {!! Form::label('section_1', 'Add section') !!}
            <br/><br/>
            {!! Form::text('section_1', null) !!}
            <br/><br/>
            {!! Form::label('line_1_1', 'Add line') !!}
            <br/><br/>
            {!! Form::text('line_1_1', null) !!}
            <br/><br/>
            {!! Form::label('img_1', 'Upload image or set url') !!}
            <br/><br/>
            {!! Form::file('img_1', null) !!}
            {!!Form::text('url_1', null) !!}
            <br/><br/>
        </div> 
        <div class="buttons_div">
            <button type="button" class="add_element">Add line</button>
            <button type="button" class="add_section">Add section</button>
        </div>
        
    </div>

    <br/><br/>
    {!! Form::submit('Save Page') !!}

{!! Form::close() !!}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    var add_element_click = 1;
    var add_section_click = 1;
    $('.add_element').on('click', function() {
        add_element_click ++;
        var form = document.getElementById("form");
        var input = document.createElement("INPUT");
        input.setAttribute("type", "text");
        input.setAttribute("name", "line_" + add_section_click + "_" + add_element_click);
        var label = document.createElement("label");
        label.innerHTML = 'Add line';
        $('.form_div').append(label);
        $('.form_div').append(document.createElement("br"));
        $('.form_div').append(document.createElement("br"));
        $('.form_div').append(input);
        $('.form_div').append(document.createElement("br"));
        $('.form_div').append(document.createElement("br"));
    })

    $('.add_section').on('click', function() {
        $('.form_div').append(document.createElement("hr"));
        add_section_click ++;
        add_element_click = 0;

        var div = document.createElement("div");
        div.setAttribute("class", "form_div_" + add_section_click);
        $('.form_div').append(div);

        var form = document.getElementById("form");
        var input = document.createElement("INPUT");
        input.setAttribute("type", "text");
        input.setAttribute("name", "section_" + add_section_click);
        var label = document.createElement("label");
        label.innerHTML = 'Add Section';
        $('.form_div_' + add_section_click).append(label);
        $('.form_div_' + add_section_click).append(document.createElement("br"));
        $('.form_div_' + add_section_click).append(document.createElement("br"));
        $('.form_div_' + add_section_click).append(input);
        $('.form_div_' + add_section_click).append(document.createElement("br"));
        $('.form_div_' + add_section_click).append(document.createElement("br"));

        var label = document.createElement("label");
        label.innerHTML = 'Upload image or set url';
        $('.form_div_' + add_section_click).append(label);
        $('.form_div_' + add_section_click).append(document.createElement("br"));
        $('.form_div_' + add_section_click).append(document.createElement("br"));

        var img = document.createElement("input");
        img.setAttribute("type", "file");
        img.setAttribute("name", "img_" + add_section_click);
        var url = document.createElement("input");
        url.setAttribute("name", "url_" + add_section_click);
        $('.form_div_' + add_section_click).append(img);
        $('.form_div_' + add_section_click).append(url);
        $('.form_div_' + add_section_click).append(document.createElement("br"));
        $('.form_div_' + add_section_click).append(document.createElement("br"));
        
    })
</script>