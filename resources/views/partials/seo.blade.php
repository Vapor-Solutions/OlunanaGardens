{{--
    Search and social metadata for the public layout.

    Defaults come from config/seo.php, keyed by route name. A page can override
    any value by passing it to its layout (see App\Livewire\BlogPost):
    title, metaDescription, ogImage, ogType.
--}}
@php
    $seoPage = config('seo.pages.' . (request()->route()?->getName() ?? ''), []);
    $seoTitle = $title ?? ($seoPage['title'] ?? config('seo.title_default'));
    $seoDescription = $metaDescription ?? ($seoPage['description'] ?? config('seo.description_default'));
    $seoPath = '/' . ltrim(request()->path(), '/');
    $seoCanonical = config('seo.canonical_base') . ($seoPath === '/' ? '/' : rtrim($seoPath, '/'));
    $seoImage = $ogImage ?? (config('seo.canonical_base') . '/' . ltrim(config('seo.default_image'), '/'));
    $seoType = $ogType ?? 'website';
@endphp
<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<link rel="canonical" href="{{ $seoCanonical }}">

<meta property="og:site_name" content="{{ config('seo.site_name') }}">
<meta property="og:type" content="{{ $seoType }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoCanonical }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">
