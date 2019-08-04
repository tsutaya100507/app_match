<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Room extends Model
{
    protected $table = 'rooms';

    // senderユーザーとの紐付け
    public function senderUser() {
        return $this->hasOne('App\User', 'id', 'send_user_id');
    }
    
    // recipientユーザーとの紐付け
    public function recipientUser() {
        return $this->hasOne('App\User', 'id', 'recieve_user_id');
    }

    public function otherUser() {
        $user_id = Auth::id();
        \Log::info($user_id);
        $other_key = '';
        if ($user_id === $this->send_user_id) {
            $other_key = 'recieve_user_id';
        } else if ($user_id === $this->recieve_user_id) {
            $other_key = 'send_user_id';
        }
        return $this->hasOne('App\User', 'id', $other_key);
    }

    // メッセージとの紐付け
    public function messages() {
        return $this->hasMany('App\Models\DirectMessage');
    }
}
