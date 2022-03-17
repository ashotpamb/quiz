<ul class="cat-list-results-list">
    @foreach ($items as $cat)
    <li class="cat-list-results-item">
        <a class="cat-list-results-item-link" href="{{ $cat->uri() }}" title="{{ $cat->title }}">
            <span class="cat-list-results-item-title">{{ $cat->title }}</span>
        </a>
    </li>
    @endforeach
</ul>
