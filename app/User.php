<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

      public function passwordSecurity() {
        return $this->hasOne('App\PasswordSecurity');
      }


      public function isConfirmed(){
        return !! $this->is_confirmed;
      }

      public function getEmailConfirmationToken()
    {
        $this->update([
            'confirmation_token' => $token = Str::random(),
        ]);
        return $token;
    }

    public function confirm(){
        $this->update([
            'is_confirmed' =>true,
            'confirmation_token' =>null,
        ]);
        return $this;
    }
}
