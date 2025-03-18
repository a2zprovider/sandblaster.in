<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <!-- Home -->
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>2022-04-12T10:53:05+00:00</lastmod>
        <priority>1.00</priority>
    </url>

    <!-- About -->
    <url>
        <loc>{{ route('about') }}</loc>
        <lastmod>2022-04-12T10:53:05+00:00</lastmod>
        <priority>0.80</priority>
    </url>

    <!-- Blog List -->
    <url>
        <loc>{{ route('blog') }}</loc>
        <lastmod>2022-04-12T10:53:05+00:00</lastmod>
        <priority>0.80</priority>
    </url>

    <!-- Application List -->
    <url>
        <loc>{{ route('apl.list') }}</loc>
        <lastmod>2022-04-12T10:53:05+00:00</lastmod>
        <priority>0.80</priority>
    </url>

    <!-- Product List -->
    <url>
        <loc>{{ route('page.list') }}</loc>
        <lastmod>2022-04-12T10:53:05+00:00</lastmod>
        <priority>0.80</priority>
    </url>

    <!-- Products -->
    @foreach($products as $product)
    <url>
        <loc>{{ url($product->slug) }}</loc>
        <lastmod>{{ $product->created_at->tz('UTC')->toAtomString() }}</lastmod>
        <priority>0.80</priority>
    </url>
    @endforeach

    <!-- Application -->
    @foreach($applications as $app)
    <url>
        <loc>{{ url('application',$app->slug) }}</loc>
        <lastmod>{{ $app->created_at->tz('UTC')->toAtomString() }}</lastmod>
        <priority>0.80</priority>
    </url>
    @endforeach

    <!-- Blogs -->
    @foreach($blogs as $blog)
    <url>
        <loc>{{ url('blog',$blog->slug) }}</loc>
        <lastmod>{{ $blog->created_at->tz('UTC')->toAtomString() }}</lastmod>
        <priority>0.80</priority>
    </url>
    @endforeach

    <!-- Contact -->
    <url>
        <loc>{{ route('contact') }}</loc>
        <lastmod>2022-04-12T10:53:05+00:00</lastmod>
        <priority>0.80</priority>
    </url>

</urlset>