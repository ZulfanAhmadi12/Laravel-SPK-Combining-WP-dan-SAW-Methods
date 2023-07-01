<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class AdminController extends Controller
{
    //
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User has Successfully Logout',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }
    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'username'=>'required',
            'password'=>'required'
        ]);
        if(auth()->attempt(['username'=>$input["username"], 'password'=>$input["password"]])){
            if(auth()->user()->role == 'admin'){
                return redirect()->route('dashboard');
            }
            else if(auth()->user()->role == 'user'){
                return redirect()->route('dashboard');
            }
        }else{
            return redirect()->route('login')->with("error", 'Incorrect email or password');
        }
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function Profile(){

        // Get user details which user is logged in, 
        // by accessing the id of the user that has logged in
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));

    }// End method

    public function EditProfile(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));

    }// End Method

    public function StoreProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name; // because the name="name" $request->name then
        $data->email = $request->email;
        $data->username = $request->username;

        // Handling storing image
        if($request->file('profile_image')){
            $file = $request->file('profile_image');

            $filename = date('YmdHi').$file->getClientOriginalName(); // Setting the name of file store into database. the Date of the file added + original filename
            $file->move(public_path('upload/admin_image'), $filename);
            $data['profile_image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);

    }// End Method

    public function ChangePassword(){

        return view('admin.admin_change_password');
    }// End Method

    public function UpdatePassword(Request $request){

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;
        // Check whether the old password user is the same or not
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message', 'Password Updated Successfully');
            return redirect()->back();
        }else{
            session()->flash('message', 'Old password is not match');
            return redirect()->back();
        }

    }// End Method

}