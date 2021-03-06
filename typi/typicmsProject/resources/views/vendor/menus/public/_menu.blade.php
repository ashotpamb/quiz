@if ($menu = Menus::getMenu($name))

    @if ($menu->menulinks->count() > 0)
    <ul class="{{ $name }}-nav-list {{ $menu->class }}" role="menu">
        @foreach ($menu->menulinks as $menulink)
            @include('menus::public._item')
        @endforeach
    </ul>
    @endif

@endif
