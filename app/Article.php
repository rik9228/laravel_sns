<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    public function user(): BelongsTo //戻り値の型の宣言
    {
        return $this->belongsTo('App\User'); //userモデルと紐づいた状態
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps(); //第二引数に中間テーブル;
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
            // bool ▶︎ 型キャスト
            ? (bool)$this->likes->where('id', $user->id)->count()
            // この記事をいいねしたユーザーの中に、引数として渡された$userがいるかどうかを調べています
            // 記事モデルからlikesテーブル経由で紐付くユーザーモデルが、コレクション(配列を拡張したもの)で返ります。
            // count() ： コレクションの要素数を数えて、数値を返す
            : false;
    }

    public function getCountLikesAttribute(): int //アクセサ
    {
        return $this->likes->count();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}

// $article->user;         //-- Userモデルのインスタンスが返る
// $article->user->name;   //-- Userモデルのインスタンスのnameプロパティの値が返る
// $article->user->hoge(); //-- Userモデルのインスタンスのhogeメソッドの戻り値が返る
// $article->user();       //-- BelongsToクラスのインスタンスが返る
