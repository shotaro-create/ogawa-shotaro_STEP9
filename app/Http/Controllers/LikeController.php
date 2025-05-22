<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // ①いいねを追加する処理
    public function likeProduct(Request $request, Product $product)
    {
        $user = Auth::user(); // 現在ログインしているユーザーを取得

        // ユーザーがすでにこの商品に「いいね」しているか確認
        if (!$product->likedBy($user)) {
            // 「いいね」していなければ、likesテーブルに新しいレコードを作成
            Like::create([
                'product_id' => $product->id, // この商品のID
                'user_id' => $user->id, // ログインしているユーザーのID
            ]);
        }

        // その商品に対する現在の「いいね」の数を取得
        return response()->json([
            'likes_count' => $product->likes()->count(),
        ]);
    }

    // ②いいねを削除する処理
    public function unlikeProduct(Request $request, Product $product)
    {
        $user = Auth::user(); // 現在ログインしているユーザーを取得
        // ユーザーがこのブログに「いいね」しているか確認
        if ($product->likedBy($user)) {
            // 「いいね」していれば、likesテーブルから該当のレコードを削除
            Like::where('product_id', $product->id)
                ->where('user_id', $user->id)
                ->delete();
        }

        // その商品に対する現在の「いいね」の数を返す
        return response()->json([
            'likes_count' => $product->likes()->count(),
        ]);
    }
}
