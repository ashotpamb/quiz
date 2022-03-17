<form action="{{route(app()->getLocale().'::add')}}" method="POST">
    @csrf
    <input type="text" name="title"/>
    <input type="text"/>
    <input type="text"/>
    <input type="text"/>
    <button type="submit">Submit</button>
</form>
