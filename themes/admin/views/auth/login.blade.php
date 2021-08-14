<x-app-layout>
<div class="wrapper">
<div class="login-container">
  
<div class="login-card">
<div class="image-container" style="margin:auto">
    <img class="img" src="https://firebasestorage.googleapis.com/v0/b/tradekunj.appspot.com/o/58d13329-6f7b-420a-ad0f-2937c6a93a2c-225835407_110499844660397_3299088769491264290_n.png?alt=media&token=991baa7a-2041-483e-838d-e476b344fb14" alt="">
</div>
<div class="header-title">{{ __('Login') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <div class="group">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="custom-textbox @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="group">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="custom-textbox @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="group">
            <div class="group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="mb-0 form-group row" style="text-align:center">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="login-button">
                    {{ __('Login') }}
                </button>

                <!-- @if (Route::has('password.request'))
                    <a class="btn btn-link" style="padding:10px"  href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif -->
            </div>
        </div>
    </form>
</div>
</div>                  
</div>
</div>

</x-app-layout>
