@extends('admin.layouts.app')
@section('admin-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Leads</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Leads</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


        <!-- Main content -->
        <section class="content">
            <form action="{{ route('admin.leads.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">User Lead Detail</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <input type="hidden" name="id" value="{{$leads->id}}">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="contact_name">Contact User Name</label>
                                            <input type="text" id="contact_name" class="form-control" name="contact_name"
                                                value="{{ $leads->contact_name }}" >
                                            @error('contact_name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="contact_email">Contact User Email </label>
                                            <input type="text" id="contact_email" class="form-control" name="contact_email"
                                                value="{{ $leads->contact_email }}" required>
                                            @error('contact_email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="contact_phone">Contact User Phone</label>
                                            <input type="text" id="contact_phone" class="form-control" name="contact_phone"
                                                value="{{ $leads->contact_phone }}" required>
                                            @error('contact_phone')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>




                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="contact_subject">Contact User Subject</label>
                                            <input type="text" id="contact_subject" class="form-control" name="contact_subject"
                                                value="{{ $leads->contact_subject }}" required>
                                            @error('contact_subject')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact_message">Contact User Message</label>
                                            <textarea class="form-control" name="contact_message" rows="4">{{ $leads->contact_message }}</textarea>
                                            @error('contact_message')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Edit Admin Changes</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="inputDescription">Admin Summery</label>
                                            <textarea class="form-control" name="admin_summery" rows="4" >{{ $leads->admin_summery }}</textarea>
                                            @error('admin_summery')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="inputStatus">Read Status</label>
                                            <select id="inputStatus" name="read_status" class="form-control custom-select"
                                                required>
                                                <option value="0"{{ $leads->read_status == 0 ? 'selected' : '' }}>
                                                    UnRead
                                                </option>
                                                <option
                                                    value="1"{{ $leads->read_status == 1 ? 'selected' : '' }}>
                                                    Read</option>
                                            </select>
                                            @error('read_status')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="inputStatus">Status</label>
                                            <select id="inputStatus" name="status" class="form-control custom-select">
                                                <option value="1"{{ $leads->status == 1 ? 'selected' : '' }}>Interested</option>
                                                <option value="2"{{ $leads->status == 2 ? 'selected' : '' }}>Follow Up</option>
                                                <option value="3"{{ $leads->status == 3 ? 'selected' : '' }}>Denied</option>
                                                <option value="4"{{ $leads->status == 4 ? 'selected' : '' }}>Not-Decided</option>
                                                <option value="5"{{ $leads->status == 5 ? 'selected' : '' }}>Converted</option>

                                            </select>
                                            @error('status')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ ucwords($message) }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="submit" value="Submit" class="btn btn-success float-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
