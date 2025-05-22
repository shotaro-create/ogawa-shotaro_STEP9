<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'description', 'img_path', 'price', 'stock', 'user_id', 'company_id'];

    // ユーザーIDとの紐づけ
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 会社IDとの紐づけ
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // いいねとのリレーションを定義
    public function likes()
    {
        // 1つの商品に対して複数のいいねが存在する
        return $this->hasMany(Like::class);
    }

    // 特定のユーザーがその商品に「いいね」をしているかどうかを確認
    public function likedBy(User $user)
    {
        // 特定のユーザーが現在の投稿に対して「いいね」しているか確認し、
        // 現在の商品に関する「いいね」のリレーションを返却する
        return $this->likes()->where('user_id', $user->id)->exists();
    }
    
    public function getOwnProduct($user_id)
    {
        // productsテーブルのデータで$user_id(ログインユーザーID)とイコールのデータを取得
        $products = $this->where('user_id', $user_id)->get();

        return $products;
    }

    // ログインユーザー以外の商品情報を取得
    public function getOtherProduct($user_id)
    {
        // productsテーブルのデータで$user_id(ログインユーザーID)と異なるデータを取得
        $products = Product::where('user_id', '!=', $user_id) // ログインユーザー以外の商品情報を取得
        ->with('user') // usersテーブルのデータをリレーションで取得
        ->get();

        // 取得した商品情報を返却
        return $products;
    }

    // 商品の購入処理
    // 在庫が足りているかチェック
    public function hasSufficientStock(int $quantity): bool
    {
        return $this->stock >= $quantity;
    }

    // 在庫を減らす
    public function reduceStock(int $quantity): void
    {
        $this->decrement('stock', $quantity);
    }
}
