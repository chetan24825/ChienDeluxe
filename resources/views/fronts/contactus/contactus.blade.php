@extends('fronts.layouts.app')
@section('content')
@if (customUrl(request()->path()))
    @section('meta_title'){{ customUrl(request()->path())->meta_title }}@stop
    @section('meta_description'){{ customUrl(request()->path())->meta_description }}@stop
    @section('meta_keywords'){{ customUrl(request()->path())->meta_keywords }}@stop
@endif
    <div class="breadcum-area">
        <div class="container-fluid">
            <div class="row">
                <ul>
                    <li><a wire:navigate href="{{ url('/') }}">Home</a></li>
                    <li><a wire:navigate href="{{ url()->current() }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="login-page bg-white">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="single-adderss-block">
                        <h3 class="mb-4">Contact Information</h3>
                        <ul class="info-list clearfix">
                            @if (get_setting('comany_address'))
                                <li>
                                    <i class="las la-map-marker-alt"></i>
                                    <div class="add-info">
                                        <b>Visit Us:</b>
                                        <p class="grey-txt">
                                            {{ get_setting('comany_address') }}
                                        </p>
                                    </div>
                                </li>
                            @endif

                            @if (get_setting('comany_phone'))
                                <li>
                                    <i class="las la-phone"></i>
                                    <div class="add-info">
                                        <b>Call Us</b>
                                        <p class="grey-txt">Support team</p>
                                        <p><a
                                                href="tel:{{ explode(',', get_setting('comany_phone'))[0] }}">{{ get_setting('comany_phone') }}</a>
                                        </p>
                                    </div>
                                </li>
                            @endif

                            @if (get_setting('comany_email'))
                                <li>
                                    <i class="las la-envelope"></i>
                                    <div class="add-info">
                                        <b>Email Us</b>
                                        <p class="grey-txt">Our friendly team is here to help</p>
                                        <p><a
                                                href="mailto:{{ get_setting('comany_email') }}">{{ get_setting('comany_email') }}</a>
                                        </p>
                                    </div>
                                </li>
                            @endif

                        </ul>

                        <div class="line" style="background-color: #eee;"></div>

                        <h3 class="mb-3">Follow Us</h3>
                        <ul class="social-section">
                            @if (get_setting('facebook_link'))
                                <li><a href="{{ get_setting('facebook_link') }}" class="fb-color"><i
                                            class="lab la-facebook-f"></i></a></li>
                            @endif

                            @if (get_setting('instagram_link'))
                                <li><a href="{{ get_setting('instagram_link') }}" class="insta-color"><i
                                            class="lab la-instagram"></i></a></li>
                            @endif

                            @if (get_setting('youtube_link'))
                                <li><a href="{{ get_setting('youtube_link') }}" class="utube-color"><i
                                            class="lab la-youtube"></i></a></li>
                            @endif

                        </ul>
                    </div>
                </div>

                <div class="col-md-7">
                    {{-- @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <em class=" alert-danger">{{ $error }}</em>
                            <br>
                        @endforeach
                    @endif --}}

                    <form method="post" action="{{ route('contactus') }}" class="contact-page">
                        @csrf
                        <h3>Get in touch</h3>
                        <div class="form-group">
                            <input type="text" placeholder="Name" name="username" value="{{ old('username') }}" />
                            @error('username')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" placeholder="Email" value="{{ old('email') }}" name="email" />
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" />
                            @error('phone')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea placeholder="Message" name="message">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
@section('schema')
    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Contact Us",
      "item": "{{ url()->current() }}"
    }
  ]
}
</script>
@endsection
