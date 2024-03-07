{{-- <x-guest-layout> --}}
    @extends("shared/_layout")
    @section("content")
        <x-auth-card>
        <div class="card shadow border-0 my-5">
            <div class="card-header bg-secondary bg-gradient ml-0 py-4">
                <div class="row">
                    <div class="col-12 text-center">
                            <h1 class="py-2 text-white">Register - ADMIN PORTAL</h1>
                    </div>
                </div>
            </div>
    
            <x-slot name="logo">
                <a href="/">
                    {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                </a>
            </x-slot>
        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="card-body p-4">
                <div class="row pt-3">
                    <div class="col-md-12">
                        <form id="registerForm" class="row" method="POST" action="/admin/user/create">
                            @csrf
                            <h2 class="border-bottom pb-3 mb-4 text-secondary text-center">Create a new account.</h2>
                            <!-- Email Address -->
                            <div class="form-floating mb-3 col-md-12">
                                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                                <x-label class="ms-2 text-muted" for="email" :value="__('Email')" />
                            </div>
        
                            <!-- Password -->
                            <div class="form-floating mb-3 col-md-6">
                                <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                                 <x-label class="ms-2 text-muted" for="password" :value="__('Password')" />
                            </div>
                    
                            <!-- Confirm Password -->
                            <div class="form-floating mb-3 col-md-6">
                                <x-input id="password_confirmation" class="form-control"
                                type="password"
                                name="password_confirmation" required />
                                <x-label class="ms-2 text-muted" for="password_confirmation" :value="__('Confirm Password')" />
                            </div>
                            <!-- Name -->
                            <div class="form-floating mb-3 col-md-6">
                                <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
                                <x-label class="ms-2 text-muted" for="name" :value="__('Name')" />
                            </div>
        
                            <div class="form-floating mb-3 col-md-6">
                                <x-input id="phone" class="form-control" type="text" name="phone" :value="old('name')" required autofocus />
                                <x-label class="ms-2 text-muted" for="phone" :value="__('Phone')" />
                            </div>
        
                            <div class="form-floating mb-3 col-md-6">
                                <x-input id="street_address" class="form-control" type="text" name="street_address" :value="old('name')" required autofocus />
                                <x-label class="ms-2 text-muted" for="street address" :value="__('street address')" />
                            </div>
        
                            <div class="form-floating mb-3 col-md-6">
                                <x-input id="district_address" class="form-control" type="text" name="district_address" :value="old('name')" required autofocus />
                                <x-label class="ms-2 text-muted" for="district address" :value="__('district address')" />
                            </div>
        
                            <div class="form-floating mb-3 col-md-6">
                                <x-input id="city" class="form-control" type="text" name="city" :value="old('name')" required autofocus />
                                <x-label class="ms-2 text-muted" for="city" :value="__('city')" />
                            </div>
                            @if(Auth::user() && (Auth::user()->role->name == config("constants.role.user_admin") || Auth::user()->role->name == config("constants.role.user_employee")))
                                <div class="form-floating mb-3 col-md-6">
                                    <select id="role_id" class="form-select" type="text" name="role_id" :value="old('role')" required autofocus>
                                        <option disabled selected>-Select role-</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach   
                                    </select>
                                    <x-label class="ms-2 text-muted" for="roles" :value="__('roles')" />
                                </div>
                                <div class="form-floating mb-3 col-md-6" id="company_id_container" style="display: none;">
                                    <select id="company_id" class="form-select" type="text" name="company_id" :value="old('role')" required autofocus>
                                        <option disabled selected>-Select company-</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach   
                                    </select>
                                    <x-label class="ms-2 text-muted" for="companies" :value="__('companies')" />
                                </div>
                            @endif
    
                            <div class="col-12">
                    
                                <x-button class="w-100 btn btn-lg btn-primary">
                                    {{ __('Create new User') }}
                                </x-button>
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
    @section('content-scripts')
        <script>
            $(document).ready(() => {
                $("#role_id").change(() => {
                    var selection = $("#role_id option:selected").text();
                    if (selection == "Company") {
                        $("#company_id_container").show();
                    } else {
                        $("#company_id_container").hide();
                    }
                });
            });
        </script>
    @endsection
    
    {{-- </x-guest-layout> --}}
    