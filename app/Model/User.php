<?php

namespace App\Model;

// use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

// class User extends Model implements JWTSubject
class User extends Model
{
    use Notifiable;
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $tablename = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',  'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        
        return [];
    }

    private $user = [];
    /**
     * 验证用户
     */
    static public function checkUser(String $name)
    {
        return self::where('name', $name)->value('id');
    }
    /**
     * 注册账号
     *
     * @param  array  $data
     * @return Illuminate\Support\Facades\DB
     */
    static public function register(array $data)
    {
        $result = self::insert([
            'name' => $data['username'],
            'password' => $data['password'],
            'remember_token' => Str::random(10),
        ]);
        return $result;
    }
}
