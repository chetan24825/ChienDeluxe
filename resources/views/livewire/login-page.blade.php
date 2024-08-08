@if (customUrl(request()->path()))
    @section('meta_title'){{ customUrl(request()->path())->meta_title }}@stop
    @section('meta_description'){{ customUrl(request()->path())->meta_description }}@stop
    @section('meta_keywords'){{ customUrl(request()->path())->meta_keywords }}@stop
    @endif
    <div class="login-page">

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @if (session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                </div>
                <div class="col-md-5">
                    <form method="post" action="#" wire:submit.prevent="login">
                        <h3>Sign in</h3>
                        <div class="form-group">

                            <input type="text" class="@error('email') is-invalid @enderror" name="email"
                                placeholder="Email" value="{{ old('email') }}" wire:model.lazy="email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="@error('password') is-invalid @enderror" wire:model="password"
                                placeholder="Password" required autocomplete="current-password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit">Login</button>
                        <p><a href="{{ route('password.request') }}">Forgot Password?</a></p>

                        <p>Don't have an account? <a href="{{ route('register') }}">Create Account</a></p>

                    </form>

                </div>

            </div>

        </div>
    </div>
