{{-- <x-guest-layout> --}}
@extends("shared/_layout")
@section("content")
<x-auth-card>
    <div class="card shadow border-0 my-5">
        <div class="card-header bg-secondary bg-gradient ml-0 py-4">
            <div class="row">
                <div class="col-12 text-center">
                    {{-- @if (User.IsInRole(SD.Role_User_Admin))
                    { --}}
                        {{-- <h1 class="py-2 text-white">Register - ADMIN PORTAL</h1> --}}
                    {{-- } --}}
                    {{-- else --}}
                    {{-- { --}}
                        <h1 class="py-2 text-white">Login</h1>
                    {{-- } --}}
                </div>
            </div>
        </div>

        <x-slot name="logo">
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
            </a>
        </x-slot>
    
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="card-body p-4">
            <div class="row pt-3">
                <div class="col-md-12">
                    <form id="loginForm" class="row" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h2 class="border-bottom pb-3 mb-4 text-secondary text-center">Use a local account to log in.</h2>
                            <!-- Email Address -->
                            <div class="form-floating mb-3">
                                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                                <x-label class="ms-2 text-muted" for="email" :value="__('Email')" />
                            </div>
        
                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                                <x-label class="ms-2 text-muted" for="password" :value="__('Password')" />
                            </div>

                                    <!-- Remember Me -->
                            <div class="checkbox mb-3">
                                <label for="remember_me" class="form-label">
                                    <input id="remember_me" type="checkbox"   class="form-check-input"  name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div>
                                <x-button class="w-100 btn btn-lg btn-primary">
                                    {{ __('Log in') }}
                                </x-button>
                            </div>

                            <div class="d-flex justify-content-between pt-2">
                                <p>
                                    @if (Route::has('password.request'))
                                        <a id="forgot-password" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                     @endif
                                </p>
                                <p>
                                    <a href={{route("register")}}>Register as a new user</a>
                                </p>
                                <p>
                                    <a href={{route("register")}}>Resend email confirmation</a>
                                </p>
                            </div>


                    </form>
                </div>
            </div>

            <div class="col-md-12 p-3 text-center">
                <section>
                    <p class="divider-text d-flex pt-3">or</p>
                    {{-- @{
                        if ((Model.ExternalLogins?.Count ?? 0) == 0)
                        { --}}
                            <div>
                                <p>
                                    There are no external authentication services configured. See this <a href="https://go.microsoft.com/fwlink/?LinkID=532715">
                                        article
                                        about setting up this ASP.NET application to support logging in via external services
                                    </a>.
                                </p>
                            </div>
                        {{-- }
                        else
                        { --}}
                            <form id="external-account" asp-page="./ExternalLogin" asp-route-returnUrl="@Model.ReturnUrl" method="post" class="form-horizontal">
                                <div>
                                    <p>
                                        {{-- @foreach (var provider in Model.ExternalLogins!)
                                        {
                                            <button type="submit" class="btn btn-primary" name="provider" value="@provider.Name" title="Log in using your @provider.DisplayName account">@provider.DisplayName</button>
                                        } --}}
                                    </p>
                                </div>
                            </form>
                        {{-- }
                    } --}}
                </section>
            </div>

        </div>

    </div>





</x-auth-card>
@endsection
{{-- </x-guest-layout> --}}
