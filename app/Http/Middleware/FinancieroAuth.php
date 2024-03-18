<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class FinancieroAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            return $next($request);
        }

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if ($user === null) {
            $user = $this->createUser($username, $password);

            if ($user === null) {
                return to_route('login')->withErrors(['username' => 'Usuario no encontrado']);
            }
        }

        if (! Hash::check($password, $user->password)) {
            if (($user = $this->updatePassword($user, $password)) === null) {
                return to_route('login')->withErrors(['password' => 'Contraseña incorrecta']);
            }
        }

        $user->update(['last_login_at' => now()]);

        Auth::login($user);

        return $next($request);
    }

    protected function updatePassword($user, $password)
    {
        $financieroUser = DB::table('usuarios')
            ->select(['nom_usu', 'pass_usu'])
            ->where('usu_usu', $user->username)
            ->where('pass_usu', $password)
            ->first();

        if ($financieroUser === null) {
            return null;
        }

        $user->update(['password' => Hash::make($password)]);

        return $user;
    }

    protected function createUser($username, $password)
    {
        $financieroUser = DB::table('usuarios')
            ->select(['nom_usu', 'pass_usu'])
            ->where('usu_usu', $username)
            ->where('pass_usu', $password)
            ->first();

        if ($financieroUser === null) {
            return null;
        }

        return User::create([
            'name' => $financieroUser->nom_usu,
            'username' => $username,
            'password' => Hash::make($password),
        ]);
    }
}
