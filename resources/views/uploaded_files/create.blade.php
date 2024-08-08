@extends('admin.layouts.app')
@section('admin-content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3"></h1>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="{{ route('uploaded-files.index') }}" class="btn btn-primary text-white">
                                    <i class="las la-angle-left"></i>
                                    <span>Back to uploaded files</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0 ">Drag & Drop Your Files</h3>
                        </div>
                        <div class="card-body">
                            <div id="aiz-upload-files" class="h-420px" style="min-height: 65vh">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
@section('admin-style')
    {{-- POP UP MEDIA LIBRARY --}}
    <link href="{{ asset('aizfiles/vendor.css') }}" rel="stylesheet">
    <script src="{{ asset('aizfiles/vendors.js') }}"></script>
@endsection

@section('admin-script')
    <script type="text/javascript">
        $(document).ready(function() {
            AIZ.plugins.aizUppy();
        });
    </script>
@endsection
