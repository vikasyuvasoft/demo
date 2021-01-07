<?php

namespace App\Http\Controllers;
use Socialite;
use Illuminate\Http\Request;
use Auth;
use App\User;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
    		// echo $provider; die;
     	return Socialite::driver($provider)->redirect();
    }

	public function Callback($provider)
	{
		if(isset($provider))
		{
			$userSocial =   Socialite::driver($provider)->stateless()->user();
			if(!empty($userSocial))
			{
				$users       =   User::where(['email' => $userSocial->getEmail()])->first();
				if($users)
				{
					Auth::login($users);
					return redirect('/login');
				}
				else
				{
					// $user = User::create(
					// 	[
					// 		'name'          => $userSocial->getName(),
					// 		'email'         => $userSocial->getEmail(),
					// 		'category_id'  =>'1',
					// 		'provider_id'   => $userSocial->getId(),
					// 		'provider'      => $provider,
					// 	]);

					$user = new User;
					$user->name=$userSocial->getName();
					$user->email=$userSocial->getEmail();
					$user->category_id=1;
					$user->provider_id=$userSocial->$userSocial->getId();
					$user->provider=$provider;
					$user->save();

					$role = Role::find('2');
					$user->role()->attach($role);

					return redirect('manager/dashboard');
				}
			}	
		}
	}

}
