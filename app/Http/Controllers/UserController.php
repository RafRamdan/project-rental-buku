<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $countData = User::with('role')->where('role_id','!=', 1)->where('status', 'active')->count();

        if($request->has('search')) {
            $users = User::with('role')->where('role_id' ,'!=', 1)->where('status', 'active')
                         ->where('username','like','%'.$request->search.'%')
                         ->orwhere('phone','like','%'.$request->search.'%')
                         ->paginate(10);
        }else{
            $users = User::with('role')->where('role_id','!=', 1)->where('status', 'active')->paginate(10);
        }
        
        return view('users.user', ['users' => $users, 'count_data' => $countData]);
    }

    public function registeredUser()
    {
        $countData = User::where('status', 'inactive')->count();

        $registeredUsers = User::where('status', 'inactive')->where('role_id', 2)->paginate(10);
        return view ('registered-user', ['registered_users' => $registeredUsers, 'count_data' => $countData]);
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $rentlogs = RentLogs::with(['user', 'book'])
            ->where('user_id', $user->id)
            ->whereRelation('book', 'deleted_at', '=', null)
            ->whereRelation('user', 'deleted_at', '=', null)
            ->paginate(10);
        return view('users.user-detail', ['user' => $user, 'rent_logs' => $rentlogs]);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();

        return redirect('/user/detail/'.$slug)->with('status', 'User Approved Success');
    }

    public function edit($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('users.user-edit', ['user' => $user]);
    }

    public function update(Request $request,$slug)
    {
        // dd(request()->all());
        $validated = $request->validate([
            'username' => 'required|max:100',
            'nis' => 'required|max:100',
        ]);
        $user = User::where('slug', $slug)->first();
        $user->slug = null;

        $user->update([
            'username' => $request->username,
            'nis' => $request->nis,
            'phone' => $request->phone,
            'address' => $request->address,
            'role_id' => $request->role_id,
        ]);
        
        
        return redirect('/user')->with('status', 'User Updated Success');
    }

    public function delete($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('users.user-delete', ['user' => $user]);
    }

    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();

        return redirect('/user')->with('status', 'User Deleted Success');
    }

    public function bannedUser()
    {
        $bannedUsers = User::onlyTrashed()->paginate(10);

        $countData = User::onlyTrashed()->count();
        return view('users.user-banned', ['bannedUsers' => $bannedUsers, 'count_data' => $countData]);
    }

    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();
        return redirect('/user/banned')->with('status', 'User Restore Success');
    }

}
