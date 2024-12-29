<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ModelHasRole;
use App\Models\OwnRefferal;
use App\Models\Saldo;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'reff_code' => ['required', 'string', 'exists:own_refferals,reff_code'],
        ]);

        try {
            $referral = OwnRefferal::where('reff_code', $request->reff_code)->first();

            if ($referral->user->deleted_at) {
                return back()->with([
                    'title' => 'Gagal',
                    'text' => 'Kode referral tidak dapat digunakan!',
                    'icon' => 'error',
                ])->withInput();
            }

            if (!$referral->user->hasRole(['admin', 'super admin'])) {
                return back()->with([])->withInput();
            }

            if (!$referral->user->hasRole(['admin', 'super admin'])) {
                return back()->with([
                    'title' => 'Gagal',
                    'text' => 'Kode referral tidak valid!',
                    'icon' => 'error',
                ])->withInput();
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('member');

            $user->saldo()->create([
                'saldo' => 0,
                'point' => 0,
            ]);

            $user->ownReff()->create([
                'reff_code' => $this->generateRandomString()
            ]);

            $user->reffBy()->create([
                'own_refferal_id' => $referral->id
            ]);

            auth()->login($user);

            return redirect()->route('landing')->with([

                'title' => 'Berhasil',
                'text' => 'Selamat bergabung ' . $user->name . '!',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'title' => 'Gagal',
                'text' => 'Pendaftaran gagal, silahkan coba lagi!',
                'icon' => 'error',
            ])->withInput();
        }
    }

    function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
