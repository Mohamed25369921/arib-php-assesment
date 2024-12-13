<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
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
        $user = $request->user();

        // Validate current password
        if (!Hash::check($request->current_password, $user->password)) {
            return Redirect::route('profile.edit')
                ->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update validated data (name, email)
        $user->fill($request->validated());

        // If email is changed, reset email verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // If a new password is provided, update it
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Return with success message
        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully.');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
