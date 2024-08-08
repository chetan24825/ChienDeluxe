<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url("/") }}</loc>
        <lastmod>{{get_setting('sitmapdate')}}</lastmod>
        <priority>1</priority>
    </url>
    
    <url>
        <loc>{{ url('/user/login') }}</loc>
        <lastmod>{{get_setting('sitmapdate')}}</lastmod>
        <priority>0.80</priority>
    </url>
    
    <url>
        <loc>{{ route('register') }}</loc>
        <lastmod>{{get_setting('sitmapdate')}}</lastmod>
        <priority>0.80</priority>
    </url>
    
     <url>
        <loc>{{ route('cart.view') }}</loc>
        <lastmod>{{get_setting('sitmapdate')}}</lastmod>
        <priority>0.80</priority>
    </url>

    <url>
        <loc>{{ route('contactus') }}</loc>
        <lastmod>{{get_setting('sitmapdate')}}</lastmod>
        <priority>0.80</priority>
    </url>

    <url>
        <loc>{{ route('wishlist') }}</loc>
        <lastmod>{{get_setting('sitmapdate')}}</lastmod>
        <priority>0.80</priority>
    </url>

    @foreach ($categories->unique() as $category)
        <url>
            <loc>{{ route('category.detail', $category->slug) }}</loc>
            <lastmod>{{get_setting('sitmapdate')}}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach
    
    <url>
        <loc>{{ route('product.view') }}</loc>
        <lastmod>{{get_setting('sitmapdate')}}</lastmod>
        <priority>0.80</priority>
    </url>

    @foreach ($products->unique() as $product)
        <url>
            <loc>{{ route('product.detail', $product->product_slug) }}</loc>
            <lastmod>{{get_setting('sitmapdate')}}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach

    @foreach ($pages as $page)
        <url>
            <loc>{{ route('custom.page', $page->slug) }}</loc>
            <lastmod>{{get_setting('sitmapdate')}}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach


</urlset>
