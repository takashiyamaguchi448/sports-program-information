<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')->withTimestamps();
    }
    
    public function favorite($postId)
    {
        // 既にお気に入りにしているかの確認
        $exist = $this->is_favorite($postId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $micropostId;
    
        if ($exist) {
            // 既にお気に入りにしていれば何もしない
            return false;
        } else {
            // お気に入りにしてなければ追加する
            $this->favorites()->attach($postId);
            return true;
        }
    }
    
    public function unfavorite($postId)
    {
        // 既にお気に入りにしているかの確認
        $exist = $this->is_favorite($postId);
        // 相手が自分自身ではないかの確認
        //$its_me = $this->id == $micropostId;
    
        if ($exist) {
            // 既にお気に入りにしていれば外す
            $this->favorites()->detach($postId);
            return true;
        } else {
            // お気に入りにしてなければ何もしない
            return false;
        }
    }
    
    public function is_favorite($postId)
    {
        return $this->favorites()->where('post_id',$postId)->exists();
    }
}