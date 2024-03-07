<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Repository\IRepository\IUnitOfWork;
use App\Repository\UnitOfWork;

class RegisteredUserController extends Controller
{
    protected IUnitOfWork $_unitOfWork;
    public function __construct(UnitOfWork $unitOfWork) {
        $this -> _unitOfWork = $unitOfWork;
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $companies = $this->_unitOfWork->company()->get_all();
        $roles = $this->_unitOfWork->role()->get_all();
        return view('auth.register', compact('companies', 'roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);
        $role = config("constants.role");
        $customer_role_db = $this->_unitOfWork->role()->get("name = "."'".$role["user_cust"]."'");
        // $company_role_db = $this->_unitOfWork->role()->get("name = "."'".$role["user_comp"]."'");
        $user_input = ['name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'phone' => $request->phone,
                        'street_address' => $request->street_address,
                        'district_address' => $request->district_address,
                        'city' => $request->city,
                        'avatar' => "https://i.pinimg.com/564x/24/21/85/242185eaef43192fc3f9646932fe3b46.jpg",
                        'role_id' => $request->role_id != null ? $request->role_id : $customer_role_db["id"],
        ];

        // if($request->role_id == $company_role_db->id) $user_input['company_id'] = $request->company_id;
   
        $user = User::create($user_input);

        event(new Registered($user));

        Auth::login($user); 
        session()->flash('message.success', 'User registered successfully');
        return redirect("/");
    }
}
