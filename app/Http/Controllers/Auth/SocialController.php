<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    /**
     * SocialController constructor.
     * On autorise la route seulement pour les utilisateurs non connectés
     */
    public function __construct(){
        $this->middleware(['guest']);
    }

    /**
     * @param $provider
     * @return mixed
     * Fonction qui va se charger de rediriger notre application vers l'url du provider
     */
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return mixed
     * @throws \Exception
     * Fonction de callback ou le provider nous redirige en passant l'utilisateur
     */
    public function callback($provider){

        //Récupération de l'utilisateur renvoyé
        try{
            $providerUser = Socialite::driver($provider)->user();
        }catch(\Exception $e){
            throw $e;
        }

        //Si j'ai déjà le provider_id dans la base de donnée, je connecte directement l'utilisateur
        $user = $this->checkIfProviderIdExists($provider, $providerUser->id);

        if($user){
            Auth::guard()->login($user, true);
            return redirect('/');
        }

        //Je vérifie si j'ai un email
        if($providerUser->email !== null){
            //Je rajoute le provider_id a l'utilisateur dont le mail correspond et je redirige vers la page appelé
            $user = User::where('email', $providerUser->email)->first();
            if($user){
                $field = $provider.'_id';
                $user->$field = $providerUser->id;
                $user->save();
                Auth::guard()->login($user, true);
                return redirect('/');
            }
        }

        //Je crée l'utilisateur si j'arrive jusque là ;)
        $user = User::create([
            'name' => $providerUser->name,
            'email' => $providerUser->email,
            $provider.'_id' => $providerUser->id,
        ]);

        if($user) Auth::guard()->login($user, true);
        return redirect('/');

    }

    /**
     * @param $provider
     * @param $providerId
     * @return mixed
     * Fonction qui vérifie si l'utilisateur à déjà un identifiant
     * venant d'un réseau social
     */
    public function checkIfProviderIdExists($provider, $providerId){

        $field = $provider."_id";

        $user = User::where($field, "=", $providerId)->first();

        return $user;

    }
}
