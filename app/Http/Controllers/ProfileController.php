<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
          
        return view('profile.index', compact('users'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(User $users)
    {
        $users->delete();
           
        return redirect()->route('profile.index')
                        ->with('success','User deleted successfully');
    }

    /**
     * Approve the user's account.
     */

     public function approve($id)
     {
         $user = User::find($id);
         if ($user) {
             $user->is_approved = true;
             $user->save();
             return redirect()->back()->with('success', 'User approved successfully.');
         }
         return redirect()->back()->with('error', 'User not found.');
     }
 
     public function disapprove($id)
     {
         $user = User::find($id);
         if ($user) {
             $user->is_approved = false;
             $user->save();
             return redirect()->back()->with('success', 'User disapproved successfully.');
         }
         return redirect()->back()->with('error', 'User not found.');
     }
public function approveUsersView()
{
    $users = User::where('is_approved', false)->get();
    return view('approve_users', compact('users'));
}


  }