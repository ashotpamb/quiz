{{--
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "",
    "name": "{{ $quiz->title }}",
    "description": "{{ $quiz->summary !== '' ? $quiz->summary : strip_tags($quiz->body) }}",
    "image": [
        "{{ $quiz->present()->image() }}"
    ],
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $quiz->uri() }}"
    }
}
</script>
--}}
