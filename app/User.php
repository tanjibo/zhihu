<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password','avatar','confirmation_token','questions_count'
    ];

    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * @param $question
     *
     * @return bool 判断问题发布者和登陆是不是同一个人
     */
    public function owner($question){
         return $question->user_id == $this->id;
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function sendPasswordResetNotification($token){
        // 模板变量
        $data = [ 'url' =>url('password/reset', $token),

        ];

        $template = new SendCloudTemplate( 'zhihu_app_register', $data );

        Mail::raw( $template, function ( $message )  {
            $message->from( '1533954229@qq.com', 'jibo' );

            $message->to( $this->email);
        } );
    }
}
