@extends('admin.layouts.app')
@section('admin-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">
        <form action="{{ route('admin.product') }}" method="POST" novalidate enctype="multipart/form-data" id="choice_form">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Collection Section</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputStatus">Category</label>
                                <select id="category" name="category" required
                                    class="select2 form-control custom-select">
                                    <option value="">--Select--</option>
                                    @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">


                                <div class="form-group">
                                    <label for="subcategory">Sub Category</label>
                                    <select id="subcategory" name="sub_category_id"
                                        class="select2 form-control custom-select">

                                    </select>
                                    @error('sub_category_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="attribute_id">Attribute Collection</label>
                                    <select id="attribute_id" name="attribute_id[]" multiple required
                                        class="select2 form-control custom-select">
                                        @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}">{{ $attribute->attribute_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('attribute_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Product General</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="inputName">Product Name</label>
                                    <input type="text" id="inputName" class="form-control" name="product_name"
                                        value="{{ old('product_name') }}" required>
                                    @error('product_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="signinSrEmail">Select The Main Image </label>

                                    <div class="input-group" data-toggle="aizuploader" data-type="image"
                                        data-multiple="false">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                Browse
                                            </div>
                                        </div>
                                        <div class="form-control file-amount">Choose File</div>
                                        <input type="hidden" name="thumbphotos" value="{{ old('thumbphotos') }}"
                                            class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">

                                    </div>
                                    <small class="text-muted">
                                        Use 600x600 sizes images.</small>
                                    <br>
                                    @error('thumbphotos')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                    @enderror

                                </div>


                                <div class="form-group">
                                    <label for="signinSrEmail">Select The Images </label>

                                    <div class="input-group" data-toggle="aizuploader" data-type="image"
                                        data-multiple="true">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                Browse
                                            </div>
                                        </div>
                                        <div class="form-control file-amount">Choose File</div>
                                        <input type="hidden" name="photos" value="{{ old('photos') }}"
                                            class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">

                                    </div>
                                    <small class="text-muted">
                                        Use 600x600 sizes images.</small>
                                    <br>
                                    @error('photos')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="inputDescription">Product Description</label>
                                    <textarea id="ckeditor" class="form-control" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Status</label>
                                    <select id="inputStatus" name="status" class="form-control custom-select" required>
                                        <option value="">Select</option>
                                        <option value="1" selected>Publish</option>
                                        <option value="0">Draft</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="inputEstimatedDuration">YouTube Video Link </label>
                                    <input type="text" id="inputEstimatedDuration" class="form-control"
                                        value="{{ old('video_link') }}" name="video_link" step="0.1">
                                    @error('video_link')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                    @enderror
                                </div>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>



                    <div class="col-md-12">


                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Price Section</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="inputEstimatedBudget">Market Price (MRP)</label>
                                            <input type="number" id="mrp" name="market_price"
                                                class="form-control" value="{{ old('market_price') }}" step="1"
                                                required>
                                            @error('market_price')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ ucwords($message) }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="inputSpentBudget">Purchase Cost</label>
                                            <input type="number" id="purchase" name="purchase_cost"
                                                class="form-control" value="{{ old('purchase_cost') }}" step="1"
                                                required>

                                            @error('purchase_cost')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ ucwords($message) }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="inputEstimatedDuration">GST <small
                                                    class="text-danger">(%)</small></label>
                                            <input type="number" id="gst" value="{{ old('gst') }}"
                                                class="form-control" name="gst" step="0.1" required>

                                            @error('gst')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ ucwords($message) }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="netcost">Net Cost</label>
                                            <input type="number" id="netcost" name="net_cost" class="form-control"
                                                value="{{ old('net_cost') }}" step="0.1" required>

                                            @error('net_cost')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ ucwords($message) }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="saleprice">Sale Price <small>(After Discount
                                                    )</small></label>
                                            <input type="number" id="saleprice" name="sale_price" class="form-control"
                                                value="{{ old('sale_price') }}" step="0.1" required>
                                            @error('sale_price')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ ucwords($message) }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>




                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="inputEstimatedDuration">Stock</label>
                                            <input type="number" id="inputEstimatedDuration" name="stock"
                                                class="form-control" value="{{ old('stock') }}" step="0.1"
                                                required>
                                            @error('stock')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ ucwords($message) }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="inputStatus">Stock Status</label>
                                            <select id="inputStatus" name="in_stock" class="form-control custom-select"
                                                required>
                                                <option value="1">In Stock</option>
                                                <option value="0">Out Of Stock</option>
                                            </select>
                                            @error('in_stock')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ ucwords($message) }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Product Variation</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" value="colors" disabled>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="colorPicker" name="colors[]" required
                                            class="select2 form-control custom-select" multiple disabled>

                                            @foreach (App\Models\Color::orderBy('name', 'asc')->get() as $key => $color)
                                            <option value="{{ $color->code }}" data-name="{{ $color->name }}">
                                                {{ $color->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input value="1" id="variaction" type="checkbox" name="colors_active">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" value="Attributes" disabled>
                                    </div>
                                    <div class="col-md-8">

                                        <select id="choice_attributes" name="choice_attributes[]" required
                                            class="select2 form-control custom-select" multiple disabled>
                                            @foreach (App\Models\AttributeVariable::where('status', 1)->get() as $key => $attribute)
                                            <option value="{{ $attribute->id }}" data-name="{{ $attribute->name }}">
                                                {{ $attribute->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="customer_choice_options" id="customer_choice_options">

                                </div>
                                <div id="color-fields-container"></div>
                                <div id="attribute-fields-container"></div>
                                <br>
                                <div class="sku_combination" id="sku_combination">

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>



                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Seo Section</h3>

                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="inputName">Product Meta Title</label>
                                    <input type="text" id="inputName" name="meta_title"
                                        value="{{ old('meta_title') }}" class="form-control">
                                    @error('meta_title')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Product Meta Keywords</label>
                                    <input type="text" id="inputName" name="meta_keyword"
                                        value="{{ old('meta_keyword') }}" class="form-control">
                                    @error('meta_keyword')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Product Meta Description</label>
                                    <textarea id="inputDescription" name="meta_description" class="form-control" rows="4">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ ucwords($message) }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Save Changes" class="btn btn-success float-right">
                    </div>
                </div>
        </form>
    </section>
    <!-- /.content -->
</div>
@endsection

@section('admin-style')
<link href="{{ asset('aizfiles/vendor.css') }}" rel="stylesheet">
<script src="{{ asset('aizfiles/vendors.js') }}"></script>
<link href="{{ asset('aizfiles/aiz-core.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
@endsection

@section('admin-script')
<script src=" {{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    $("[name=shipping_type]").on("change", function (){
        $(".product_wise_shipping_div").hide();
        $(".flat_rate_shipping_div").hide();
        if($(this).val() == 'product_wise'){
            $(".product_wise_shipping_div").show();
        }
        if($(this).val() == 'flat_rate'){
            $(".flat_rate_shipping_div").show();
        }

    });

    function add_more_customer_choice_option(i, name){
        $('#customer_choice_options').append('<div class="form-group row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="Choice Title" readonly></div><div class="col-md-8"><input type="text" class="form-control aiz-tag-input" name="choice_options_'+i+'[]" placeholder="Enter choice values" data-on-change="update_sku"></div></div>');

    	AIZ.plugins.tagify();
    }

	$('input[name="colors_active"]').on('change', function() {
	    if(!$('input[name="colors_active"]').is(':checked')) {
		$('#colors').prop('disabled', true);
                AIZ.plugins.bootstrapSelect('refresh');
            }
            else{
                $('#colors').prop('disabled', false);
                AIZ.plugins.bootstrapSelect('refresh');
            }
            update_sku();
	});

	$('#colors').on('change', function() {
	    update_sku();
	});

	$('input[name="unit_price"]').on('keyup', function() {
	    update_sku();
	});

	$('input[name="name"]').on('keyup', function() {
	    update_sku();
	});

	function delete_row(em){
		$(em).closest('.form-group row').remove();
		update_sku();
	}

    function delete_variant(em){
		$(em).closest('.variant').remove();
	}

	function update_sku() {
        $.ajax({
            type: "POST",
            url: '{{route('admin.product.sku_combination')}}',
            data: $('#choice_form').serialize(), // Serialize form data
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token in headers
            },
            success: function(data) {
                $('#sku_combination').html(data); // Update the SKU combination section with response data
                AIZ.plugins.fooTable(); // Call the fooTable plugin

                // Show or hide the quantity based on the length of the response data
                if (data.length > 1) {
                    $('#quantity').hide();
                } else {
                    $('#quantity').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('An error occurred:', error); // Handle errors
            }
        });
    }
	$('#choice_attributes').on('change', function() {
		$('#customer_choice_options').html(null);
		$.each($("#choice_attributes option:selected"), function(){
            add_more_customer_choice_option($(this).val(), $(this).text());
        });
		update_sku();
	});


</script>
<script>
    $('#variaction').on('change', function() {
        if ($(this).is(':checked')) {
            $('#colorPicker').prop('disabled', false);
            $('#choice_attributes').prop('disabled', false);
        } else {
            $('#colorPicker').prop('disabled', true);
            $('#choice_attributes').prop('disabled', true);
            $('#color-fields-container').empty();
            $('#colorPicker').val([]).trigger('change');
            $('#choice_attributes').val([]).trigger('change');
        }
    });



    $(document).ready(function() {
        $('#colorPicker').change(function() {
            $('#color-fields-container').empty(); // Clear existing fields
            var selectedOptions = $(this).find('option:selected'); // Get selected options
            selectedOptions.each(function() {
                var color = $(this).val(); // Get color code
                var colorName = $(this).data('name'); // Get color name from data attribute

                var colorFieldsHtml = `
                <div class="color-fields" data-color="${color}">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" value="${colorName}" disabled>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="colors[${color}][price]" placeholder="Price">
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="colors[${color}][quantity]" placeholder="Quantity">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            Browse
                                        </div>
                                    </div>
                                    <div class="form-control file-amount">Choose File</div>
                                    <input type="hidden" name="colors[${color}][image]" value="" class="selected-files">
                                </div>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                $('#color-fields-container').append(colorFieldsHtml);
            });
        });
    });


</script>
@endsection