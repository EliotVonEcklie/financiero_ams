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

        if (!Hash::check($password, $user->password)) {
            return to_route('login')->withErrors(['password' => 'Contraseña incorrecta']);
        }

        $user->last_login_at = now();
        $user->save();
        Auth::login($user);

        return $next($request);
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
