<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 't_user';


    /**
     * The primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'UserID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['FirstName','LastName','Phone','Cell', 'email', 'Password', 'Adresse'];  // All field of user table here    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['Password', 'remember_token'];

    // public function getAuthIdentifier()
    // {
    //     return $this->getKey();
    // }
    // public function getAuthPassword()
    // {
    //     //return $this->Password;
    //     return $this->attributes['Password'];
    // }

    /*public function getPasswordAttribute()
    {
        return $this->Password;
    }

    public function setPasswordAttribute($password)
    {
        $this->Password = $password;
    }*/

    public function getAuthPassword()
    {
         return $this->attributes['Password'];//change the 'passwordFieldinYourTable' with the name of your field in the table
    }

}