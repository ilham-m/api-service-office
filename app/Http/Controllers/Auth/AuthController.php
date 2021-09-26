<?php

namespace App\Http\Controllers\Auth;

use App\Http\Traits\ApiResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Models\User;


class AuthController extends Controller
{
    use ApiResponse;
    public function register(Request $request)
    {
      $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password'=> 'required|confirmed',
      ]);
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->save();
      // return response()->json();
      return $this->success(['user' => $user, 'token' => $user->createToken($user->name)->plainTextToken],'succesfully register new user');
    }
    public function login(Request $request)
    {
      $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        // 'device_name' => 'required'
      ]);

      $user = User::where('email', $request->email)->first();
      if (! $user || ! Hash::check($request->password, $user->password)) {
          throw ValidationException::withMessages([
              'message' => ['The provided credentials are incorrect.'],
          ]);
      }
      $token = $user->createToken($request->email)->plainTextToken;
      // $permission = $user->getPermissionsViaRoles()->pluck('name');
      // $menu = Menu::select('s_menus.id','s_menus.name','s_menus.type','s_menus.path','s_menus.icon')
      //             ->where('type', 'Parent')
      //             ->get();
      // foreach ($menu as $key) {
      //     $child = Menu::select('s_menus.id','s_menus.name','s_menus.type','s_menus.path')
      //                 ->where('type', 'Child')
      //                 ->where('parent_id', $key->id)
      //                 ->get();
      //     $key->child = $child;
      // }

      $response = [
          'user' => $user,
          'token' => $token,
          // 'permission' => $permission,
          // 'menu' => $menu
      ];
      return $this->success(['user' => $response], "login succesfully");
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        // return response('logged out', 200);
        return $this->success(null,'Logout Out success');
    }

    public function profile(Request $request){
    // return $request->user();

    return $this->success(['user' => $request->user()], 'Data user profile');
    }

    public function refresh(Request $request)
    {
    $user = $request->user();
    $user->tokens()->delete();
    // return response()->json(['token' => $user->createToken($user->name)->plainTextToken]);
    return $this->success(['data' => ['user' => $user, 'token' => $user->createToken($user->name)->plainTextToken] ]);
    }

    public function check(){
        return $this->success(['User Still Has access'], 'Data user profile');
    }
}
