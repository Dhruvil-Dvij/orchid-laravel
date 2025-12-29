<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Models\Role;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|string|max:15|unique:users,mobile_number',
            'password' => 'required|confirmed|min:8',
            'referral_code' => 'nullable|string|max:255',
        ]);

        // Create user
        if ($request->referral_code) {
            $referrer = User::where('referral_code', $request->referral_code)->first();
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
            'referral_code' => (new User)->generateReferralCode(),
            'referred_by' => $request->referral_code ? $referrer->id : null,
        ]);

        // Optionally handle referral code here

        $defaultRole = Role::where('slug', 'user')->first();
        if ($defaultRole) {
            // Attach the role using the pivot table
            $user->roles()->attach($defaultRole->id);
        }

        if ($request->referral_code && $referrer) {
            Referral::create([
                'referrer_user_id' => $referrer->id,
                'referred_user_id' => $user->id,
                'referral_code'    => $request->referral_code,
                'used_at'          => now(),
            ]);
        }

        // Log the user in
        Auth::login($user);

        // Redirect to dashboard or home
        // return redirect()->route('platform.index');
        return redirect()->route('platform.user.kyc');
    }
}
