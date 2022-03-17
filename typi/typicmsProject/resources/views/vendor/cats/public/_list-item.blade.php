<li class="cat-list-item">
    <a class="cat-list-item-link" href="{{ $cat->uri() }}" title="{{ $cat->title }}">
        <div class="cat-list-item-title">{{ $cat->title }}</div>
        <div class="cat-list-item-image-wrapper">
            @empty (!$cat->image)
            <img class="cat-list-item-image" src="{{ $cat->present()->image(null, 200) }}" width="{{ $cat->image->width }}" height="{{ $cat->image->height }}" alt="{{ $cat->image->alt_attribute }}">
            @endempty
        </div>
    </a>
</li>
