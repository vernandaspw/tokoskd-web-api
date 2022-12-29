<div>
    <div class="hold-transition d-flex justify-content-center mt-5">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ url('/') }}" class="h1"><b>TOKO </b>SKD</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form wire:submit.prevent='login'>
                        <div class="input-group mb-3">
                            <input wire:model='phone' type="tel" class="form-control" placeholder="Phone">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input wire:model='password' type="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <div class="col-12 mt-2">
                                <a href="{{ url('customer', []) }}" class="btn btn-light btn-block">Customer View</a>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
{{--
                    <div class="social-auth-links text-center mt-2 mb-3">
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                        </a>
                    </div> --}}
                    <!-- /.social-auth-links -->

                    {{-- <p class="mb-4">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p> --}}

                    <div class="mt-4 mb-2 text-center">
                       ~     Create by Vernanda ~
                    </div>
                    <center>
                        {{ $phone }}
                    </center>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
</div>


<style>
    body{
        background-color: rgb(102, 235, 129);
    }
</style>
