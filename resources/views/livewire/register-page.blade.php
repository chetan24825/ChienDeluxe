<div>
    @if (customUrl(request()->path()))
    @section('meta_title'){{ customUrl(request()->path())->meta_title }}@stop
    @section('meta_description'){{ customUrl(request()->path())->meta_description }}@stop
    @section('meta_keywords'){{ customUrl(request()->path())->meta_keywords }}@stop
@endif

    <div class="login-page">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form wire:submit.prevent="save">
                        <h3>Create Account</h3>

                        <div class="form-group">
                            <input type="text" class="@error('name') is-invalid @enderror" placeholder="Full Name"
                                required wire:model="name">
                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" class="@error('email') is-invalid @enderror" wire:model="email"
                                placeholder="Email*">
                            @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" class="@error('phone') is-invalid @enderror " wire:model="phone"
                                placeholder="Phone*" required aria-required="true">
                            @error('phone')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class=" @error('password') is-invalid @enderror" name="password"
                                placeholder="Password*" wire:model="password" required>

                            @error('password')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="@error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirm Password*" wire:model="password_confirmation" required
                                aria-required="true">
                            @error('password_confirmation')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>


                        <button type="submit">Sign up</button>


                        <p>Already have a account? <a href="{{ route('user.login') }}">login</a></p>

                    </form>

                </div>

            </div>

        </div>
    </div>


</div>
