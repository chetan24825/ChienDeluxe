<div class="category-section wow fadeInUp animated ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="title-bar">
                    <h1>Product Categories</h1>
                    <a href="{{route('product.view')}}" title="View all products">View All</a>
                </div>
            </div>
        </div>


        <div class="row">
            <ul class="cat-box">
                @forelse (App\Models\Category::where('status',1)->get() as $category)
                    <li>
                        <a wire:navigate href="{{ route('category.detail', $category->slug) }}" title="View {{ $category->category_name }}">
                            <img loading="lazy" src="{{ uploaded_asset($category->image) }}" alt="{{ $category->category_name }} image" class="img-fluid">
                            <span>{{ $category->category_name }}</span>
                        </a>
                        
                    </li>
                @empty
                    <li><strong>Category Not Found </strong></li>
                @endforelse
            </ul>
        </div>


    </div>
</div>
