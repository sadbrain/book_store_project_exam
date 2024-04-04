<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;
// use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Repository\IRepository\IUnitOfWork;
use App\Repository\UnitOfWork;

class UserController extends AdminController
{  
   
    public function register(){
        if(Auth::user()->role->name != config("constants.role.user_admin") && Auth::user()->role->name != config("constants.role.user_employee")){
            abort(403, 'Unauthorized action.');
        }

        $companies = $this->_unitOfWork->company()->get_all()->get()->all();
        $roles = $this->_unitOfWork->role()->get_all()->get()->all();
        return view('/admin/user/create', compact('companies', 'roles'));
    }
    public function registerPost(Request $request){
        if(Auth::user()->role->name != config("constants.role.user_admin") || Auth::user()->role->name != config("constants.role.user_employee")){
            abort(403, 'Unauthorized action.');
        }

        $role = config("constants.role");
        $customer_role_db = $this->_unitOfWork->role()->get("name = "."'".$role["user_cust"]."'");
        $company_role_db = $this->_unitOfWork->role()->get("name = "."'".$role["user_comp"]."'");
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

        if($request->role_id == $company_role_db->id) $user_input['company_id'] = $request->company_id;
   
        $user = User::create($user_input);
        session()->flash('message.success', 'User created successfully');
        return redirect("/admin/user/create");
    }

    public function index(){
        return view('admin/user/listUsers');
    }

    public function getAll(){
        $users = $this->_unitOfWork->user()->get_all();
        $users = $users
        ->with('company')
        ->with('role')
        ->get()->all();
        return response()->json(["data" => $users]);
    }

    
    public function show($id){
        $roles = $this->_unitOfWork->role()->get_all();
        $roles = $roles->get()->all();
        $user = $this->_unitOfWork->user()->get("id = $id");
         return view ('admin/user/update', compact(['user', 'roles']));
    }

    // public function update (Request $request){

    //     $user = $request->input('user');
    //     $user = $this->_unitOfWork->user()->get("id = {$user['id']}");
    //     $user->fill($user);
    //     $this->_unitOfWork->user()->update($user);
    //     session()->flash('message.success', 'Update use to cart successful');
    //     return back();
    // }

    public function update(Request $request)
    {
        $userData = $request->input('user');
        $user = $this->_unitOfWork->user()->get("id = {$userData['id']}");
        $user->fill($userData);
        $this->_unitOfWork->user()->update($user);
        
        session()->flash('message.success', 'Update user cart successful');
        return back();
    }
   
}
