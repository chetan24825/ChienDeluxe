<div class="testimonails py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="newsletter col-md-6 text-center">
                <h3>Subscribe to the Newsletter</h3>
                <form method="post" action="{{ route('subscribes.user') }}">
                    @csrf
                    <input type="text" placeholder="Email Address" value="{{ old('email') }}" name="email" />
                    @error('email')
                        <em class="text-danger">{{ $message }}</em>
                    @enderror
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
