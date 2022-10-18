<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use App\Models\Peserta; 
use Mail; 
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
       return view('peserta.forgot_pass.lupa_password');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // dd($request->email);

        $token = Str::random(64);

        DB::table('forgot_pass_peserta')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        Mail::send('peserta.forgot_pass.mailForgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'Kami telah mengeirimkan link reset password ke email, silahkan cek kotak masuk atau spam email anda sekarang');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token) { 
       return view('peserta.forgot_pass.reset_password', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        // dd($request->all());
        $updatePassword = DB::table('forgot_pass_peserta')
                            ->where([
                              'token' => $request->token
                            ])
                            ->first();
        $email_get = $updatePassword->email;
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = Peserta::where('email', $email_get)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('forgot_pass_peserta')->where(['token' => $request->token])->delete();

        return redirect('/login')->with('message', 'Password berhasil diubah, silahkan coba login kembali');
    }
}
