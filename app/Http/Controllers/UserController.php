<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/user/register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validators = [
            'name' => 'required|max:100|regex:/^[A-Za-z\'\s]+$/',
            'address' => 'required|max:256',
            'email' => 'required|max:50|email|unique:users,email',
            'pass' => 'required|max:100|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            're-pass' => 'required|same:pass'
        ];

        $errMsgs = [
            'name.required' => 'Name should not be empty.',
            'name.max' => 'Name should only be 100 characters long.',
            'name.regex' => 'Name should contains alphabets, hyphens, apostrophes and spaces only.',
            'address.required' => 'Address should not be empty.',
            'address.max' => 'Address should only be 100 characters long.',
            'email.required' => 'Email should not be empty.',
            'email.max' => 'Email should only be 50 characters long.',
            'email.regex' => 'Email should follow the pattern : [...@example.com].',
            'email.unique' => 'Email is already registered.',
            'pass.required' => 'Password should not be empty.',
            'pass.max' => 'Password should only be 100 characters long.',
            'pass.min' => 'Password should be at least 8 characters long.',
            'pass.regex' => 'Password should contains at least 1 uppercase, 1 lowercase, 1 digit and 1 special character.',
            're-pass.required' => 'Re-enter password should not be empty.',
            're-pass.same' => 'Re-enter password should be same with Password.',
        ];

        $validated = $request->validate($validators, $errMsgs);

        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->address = $request->address;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->pass);
        $newUser->point = 0;
        $newUser->rank = "Classic";
        $newUser->is_email_verified = 0;
        $newUser->save();

        $userID = $newUser->user_id;

        // Log for success user creation
        $log = new Log();
        $log->user_id = $userID;
        $log->description = "You have created a account using email " . $request->email . ".";
        $log->save();

        // Send email verification
        MailController::verifyEmail($request->email, $userID);

        return view('user.pendingEmailVerify')->with([
            'email' => $newUser->email,
            'userID' => $userID
        ]);
    }

    // Verify Email
    public function updateEmailVerification($userID)
    {
        // Logic to update the database based on the $id
        User::where('user_id', $userID)->update(['is_email_verified' => 1]);

        // Log for success email verification
        $log = new Log();
        $log->user_id = $userID;
        $log->description = "You have successfully verify your email.";
        $log->save();

        // Redirect to a thank you page or any other relevant page
        return redirect('/users/successEmailVerify');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        // Log for success logout
        $log = new Log();
        $log->user_id = $request->session()->get('userID');
        $log->description = "You have successfully logged out from your account.";
        $log->save();

        $request->session()->invalidate();

        return redirect('/');
    }

    /**
     * Display login page.
     */
    public function loginPage()
    {
        return view('/user/login');
    }

    /**
     * Login (set session).
     */
    public function login(Request $request)
    {
        $validators = [
            'email' => 'required|max:50|email',
            'pass' => 'required|max:100|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ];

        $errMsgs = [
            'email.required' => 'Email should not be empty.',
            'email.max' => 'Email should only be 50 characters long.',
            'email.regex' => 'Email should follow the pattern : [...@example.com].',
            'pass.required' => 'Password should not be empty.',
            'pass.max' => 'Password should only be 100 characters long.',
            'pass.min' => 'Password should be at least 8 characters long.',
            'pass.regex' => 'Password should contains at least 1 uppercase, 1 lowercase, 1 digit and 1 special character.'
        ];

        $validated = $request->validate($validators, $errMsgs);

        // To check if user already registered
        $user = User::where('email', $request->email)->first();

        if ($user == null) {      // User not registered 
            return redirect()->back()->withErrors(['email' => 'Email not found inside system.'])->withInput();
        } else if ($user->is_email_verified == '0') {      // User not yet verify email
            return view('user.pendingEmailVerify')->with([
                'email' => $user->email,
                'userID' => $user->user_id
            ]);
        } else {
            if (Hash::check($request->pass, $user->password)) {
                // Regenerate session ID & remove all session
                $request->session()->invalidate();

                // Set session
                $request->session()->put('userID', $user->user_id);
                $request->session()->put('userRank', $user->rank);
                $request->session()->put('userName', $user->name);

                // Log for success log in
                $log = new Log();
                $log->user_id = $user->user_id;
                $log->description = "You have logged in.";
                $log->save();

                return redirect('/products/index');
            } else {        // Wrong password
                return redirect()->back()->withErrors(['pass' => 'Incorrect password.'])->withInput();
            }
        }
    }
}
