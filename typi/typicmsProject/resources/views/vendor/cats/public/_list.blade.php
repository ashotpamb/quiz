<ul class="cat-list-list">
    @foreach ($items as $cat)
    @include('cats::public._list-item')
    @endforeach
</ul>
