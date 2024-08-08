<div class="template-left-box">
    <h3>Category</h3>
    <ul>
        @forelse (App\Models\Category::where('status',1)->get() as $category)
            <li><a wire:navigate href="{{ route('category.detail',$category->slug) }}">{{ $category->category_name }}</a>
                <span>{{ App\Models\Product::where('category_id', $category->id)->get()->count() }}</span>
            </li>
        @empty
            <li><a href="#">Grocery</a> <span>2</span></li>
        @endforelse
    </ul>
</div>
