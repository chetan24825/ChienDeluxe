@if (App\Models\Testimonial::where('status', 1)->get()->count() > 0)
    <div class="testimonails wow fadeInUp animated">
        <div class="container">
            <div class="row">
                <div class="title mb-2">
                    <h3>Testimonials</h3>
                </div>
            </div>



            <div class="row mt-4 mb-4">
                <div class="container">

                    <div class="accordion d-flex justify-content-center align-items-center height" id="accordionExample">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="p-3">

                                    <ul class="testimonial-list">
                                        @foreach (App\Models\Testimonial::where('status', 1)->get() as $key => $test)
                                            <li>
                                                <div class="card p-3" data-toggle="collapse"
                                                    data-target="#collapse{{ $key }}"
                                                    aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $key }}">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <img src="{{ uploaded_asset($test->image) }}" width="150"
                                                            class="rounded-circle">
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>


                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="p-3 testimonials-margin">
                                        @foreach (App\Models\Testimonial::where('status', 1)->get() as $key => $test)
                                            <div id="collapse{{ $key }}"
                                                class="collapse {{ $key == 0 ? 'show' : '' }}"
                                                aria-labelledby="heading{{ $key }}"
                                                data-parent="#accordionExample">
                                                <div class="card-body p-0">
                                                    <h4>{{ $test->user_name }}</h4>
                                                    <div class="ratings">
                                                        @for ($i = 0; $i < $test->rate; $i++)
                                                            <i class="las la-star"></i>
                                                        @endfor
                                                    </div>
                                                    <p>{!! $test->content !!}</p>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>


        @include('fronts.inc.subscribe')


    </div>
@endif
