@php
    use App\Models\SubCategory;
    $subCategories = SubCategory::where('sub_category_status', 1)->where('banner', 1)->get()->take(2);
    $chunkedSubCategories = $subCategories->chunk(2);
@endphp

@if ($chunkedSubCategories->count() > 0)
    <div class="container-fluid wow fadeInUp animated">
        @foreach ($chunkedSubCategories as $chunk)
            <div class="row align-items-center mt-5 mb-3">
                @foreach ($chunk as $subCategory)
                    <div class="col-md-{{ $chunk->count() == 1 ? '12' : '6' }} p-0">
                        <a href="#" class="category-box">
                            <div class="category-img">
                                <img src="{{ uploaded_asset($subCategory->sub_category_image) }}" class="img-fluid"
                                    width="100%">
                            </div>
                            <div class="category-title">
                                <span class="category-mame">{{ $subCategory->sub_category_name }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endif
