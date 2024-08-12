@extends('admin.layouts.app')
@section('admin-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="choice_form">
            @csrf
            <input name="_method" type="hidden" value="POST">
                <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="inputStatus">Category</label>
                                <select id="inputStatus" name="category" required class="form-control custom-select">
                                    <option value="">--Select--</option>
                                    @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
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



                            <div class="form-group">
                                <label for="inputName">Product Name</label>
                                <input type="text" id="inputName" class="form-control" name="product_name"
                                    value="{{ $product->product_name }}" required>
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
                                    <input type="hidden" name="thumbphotos" value="{{ $product->thumbphotos }}"
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
                                    <input type="hidden" name="photos" value="{{ $product->photos }}"
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
                                <textarea id="ckeditor" class="form-control" name="description" rows="4" required>{{ $product->description }}</textarea>
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
                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Publish
                                    </option>
                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Draft</option>
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
                                    value="{{ $product->video_link }}" name="video_link" step="0.1">
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
                                        <input type="number" id="inputEstimatedBudget" name="market_price"
                                            class="form-control" value="{{ $product->market_price }}" step="1"
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
                                        <label for="purchase">Purchase Cost</label>
                                        <input type="number" id="purchase" name="purchase_cost"
                                            class="form-control" value="{{ $product->purchase_cost }}"
                                            step="1" required>

                                        @error('purchase_cost')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="gst">GST <small class="text-danger">(%)</small></label>
                                        <input type="number" id="gst" value="{{ $product->gst }}"
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
                                            value="{{ $product->net_cost }}" step="0.1" required>

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
                                            value="{{ $product->sale_price }}" step="0.1" required>
                                        @error('sale_price')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ ucwords($message) }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inputEstimatedDuration">Company Profit</label>
                                        <input type="number" id="company_profit" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="inputEstimatedDuration">Stock</label>
                                        <input type="number" id="inputEstimatedDuration" name="stock"
                                            class="form-control" value="{{ $product->stock }}" step="0.1">
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
                                            <option value="1" {{ $product->in_stock == 1 ? 'selected' : '' }}>In
                                                Stock</option>
                                            <option value="0" {{ $product->in_stock == 0 ? 'selected' : '' }}>Out
                                                Of Stock</option>
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
                                    <select id="colors" name="colors[]" required
                                        class="select2 form-control custom-select" multiple disabled>

                                        @foreach (App\Models\Color::orderBy('name', 'asc')->get() as $key => $color)
                                        <option value="{{ $color->code }}" data-name="{{ $color->name }}">
                                            {{ $color->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-1">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input value="1" type="checkbox" name="colors_active" <?php if (count(json_decode($product->colors)) > 0) echo "checked"; ?> >
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="Attributes" disabled>
                                </div>
                                <div class="col-md-8">

                                    <select id="choice_attributes" name="choice_attributes[]" data-selected-text-format="count" class="select2 form-control custom-select" data-live-search="true" class="form-control aiz-selectpicker" multiple data-placeholder="Choose Attributes">
                                        @foreach (\App\Models\AttributeVariable::all() as $key => $attribute)
                                        <option value="{{ $attribute->id }}" @if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="customer_choice_options" id="customer_choice_options">
                            @foreach (json_decode($product->choice_options) as $key => $choice_option)
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">
                                    <input type="text" class="form-control" name="choice[]" value="{{ App\Models\AttributeVariable::find($choice_option->attribute_id)->name }}" placeholder="Choice Title" disabled>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control aiz-tag-input" name="choice_options_{{ $choice_option->attribute_id }}[]" placeholder="Enter choice values" value="{{ implode(',', $choice_option->values) }}" data-on-change="update_sku">
                                </div>
                            </div>
                            @endforeach
                        </div>
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
                                    value="{{ $product->meta_title }}" class="form-control">
                                @error('meta_title')
                                <span class="text-danger" role="alert">
                                    <strong>{{ ucwords($message) }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputName">Product Meta Keywords</label>
                                <input type="text" id="inputName" name="meta_keyword"
                                    value="{{ $product->meta_keyword }}" class="form-control">
                                @error('meta_keyword')
                                <span class="text-danger" role="alert">
                                    <strong>{{ ucwords($message) }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Product Meta Description</label>
                                <textarea id="inputDescription" name="meta_description" class="form-control" rows="4">{{ $product->meta_description }}</textarea>
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
{{-- POP UP MEDIA LIBRARY --}}
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
    

    $(document).ready(function (){
        show_hide_shipping_div();
    });

    $("[name=shipping_type]").on("change", function (){
        show_hide_shipping_div();
    });

    function show_hide_shipping_div() {
        var shipping_val = $("[name=shipping_type]:checked").val();

        $(".product_wise_shipping_div").hide();
        $(".flat_rate_shipping_div").hide();
        if(shipping_val == 'product_wise'){
            $(".product_wise_shipping_div").show();
        }
        if(shipping_val == 'flat_rate'){
            $(".flat_rate_shipping_div").show();
        }
    }

    function add_more_customer_choice_option(i, name){
        $('#customer_choice_options').append('<div class="form-group row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="Choice Title" readonly></div><div class="col-md-8"><input type="text" class="form-control aiz-tag-input" name="choice_options_'+i+'[]" placeholder="Enter choice values" data-on-change="update_sku"></div></div>');

    	AIZ.plugins.tagify();
    }   

    $('input[name="colors_active"]').on('change', function() {
        if(!$('input[name="colors_active"]').is(':checked')){
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

    function delete_row(em){
        $(em).closest('.form-group').remove();
        update_sku();
    }

    function delete_variant(em){
        $(em).closest('.variant').remove();
    }

    function update_sku(){
        $.ajax({
           type:"POST",
           url:'{{ route('admin.product.sku_combination_edit') }}',
           data:$('#choice_form').serialize(),
           headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token in headers
            },
           success: function(data){
                $('#sku_combination').html(data);
                AIZ.uploader.previewGenerate();
                AIZ.plugins.fooTable();
                if (data.length > 1) {
                    $('#quantity').hide();
                }
                else {
                    $('#quantity').show();
                }
           }
        });
    }

    AIZ.plugins.tagify();

	$(document).ready(function(){
		update_sku();

		$('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
	});

	$('#choice_attributes').on('change', function() {
		$.each($("#choice_attributes option:selected"), function(j, attribute){
			flag = false;
			$('input[name="choice_no[]"]').each(function(i, choice_no) {
				if($(attribute).val() == $(choice_no).val()){
					flag = true;
				}
			});
            if(!flag){
				add_more_customer_choice_option($(attribute).val(), $(attribute).text());
			}
        });

		var str = @php echo $product->attributes @endphp;

		$.each(str, function(index, value){
			flag = false;
			$.each($("#choice_attributes option:selected"), function(j, attribute){
				if(value == $(attribute).val()){
					flag = true;
				}
			});
            if(!flag){
				$('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
			}
		});

		update_sku();
	});

</script>
<script>
    $(document).ready(function() {
        $('#gst, #purchase').on('keyup', function() {
            var gstValue = parseFloat($('#gst').val());
            var purchase = $('#purchase').val();
            if (!purchase) {
                $('#netcost').val('');
                return;
            }
            purchase = parseFloat(purchase);
            var netcostValue = purchase + (purchase * gstValue / 100);
            $('#netcost').val(netcostValue.toFixed(2));
        });


        $('#saleprice, #disper').on('keyup', function() {
            var distribute_percentage = parseFloat($('#disper').val());
            var saleprice = $('#saleprice').val();

            if (!distribute_percentage) {
                $('#disamount').text('');
                return;
            }
            if (!saleprice) {
                $('#disamount').text('');
                return;
            }

            saleprice = parseFloat(saleprice);
            var netcostValue = saleprice - (saleprice * distribute_percentage / 100);
            var percentageAmount = (saleprice * distribute_percentage / 100).toFixed(
                2);
            $('#disamount').text(percentageAmount);
            var netcost = $('#netcost').val();
            var profit = (saleprice - (parseFloat(percentageAmount) + parseFloat(netcost))).toFixed(2);
            $('#company_profit').val(profit);
        }).trigger('keyup');;


    });
</script>
@endsection