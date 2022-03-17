{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $cat->title }}",
    "description": "{{ $cat->summary !== '' ? $cat->summary : strip_tags($cat->body) }}",
    "image": [
        "{{ $cat->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $cat->uri() }}"
    }
}
</script>
--}}
