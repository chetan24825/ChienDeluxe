<div class="modal fade" style="top: 122px;" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Login In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form action="{{ route('popuplogin') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                name="email" placeholder="Email/Username" value="{{ old('email') }}" required
                                autocomplete="email" autofocus>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="hidden" name="userdetail"
                            value="{{ isset($userdetail) ? json_encode($userdetail) : '' }}">
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                required autocomplete="current-password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                            <button type="submit" class="chekout-btn-chetan">Login </button>
                        </div>
                    </div>
                </form>
                <p class="text-center crete-line">Don't have a Account yet ? <a href='{{ route('register') }}'>Create a
                        Account</a>
                </p>
                <!--<p class="text-center crete-line"> <a href='{{ route('password.request') }}'>Reset Password</a>-->
                <!--</p>-->
            </div>
        </div>
    </div>
</div>


