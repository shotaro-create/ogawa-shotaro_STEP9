<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductSearchRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Sale;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditProductRequest;

class ProductController extends Controller
{
    // 商品の一覧表示
    public function index ()
    {
        // ログインユーザーのIDを取得
        $user_id = Auth::id();
        // ログインユーザーの商品一覧を取得
        $products = $this->product->getOtherProduct($user_id);

        // 商品データをビューに渡す
        return view('index', compact('products'));
    }

    // 商品新規登録画面の表示
    public function create ()
    {
        return view('create');
    }
    // 商品新規登録処理
    public function store (ProductRequest $request)
    {
        // バリデーションを通過したデータを取得
        $validated = $request->validated();

    if ($request->hasFile('img_path')) {
        $imagePath = $request->file('img_path')->store('images', 'public');
        $validated['img_path'] = $imagePath;
    }

    $validated['user_id'] = auth()->id();
    $validated['company_id'] = auth()->user()->company_id;

    Product::create($validated);

        // 商品一覧画面にリダイレクト
        return redirect()->route('mypage')->with('success', '商品を登録しました');
        
    }
    // 出品商品の詳細画面を表示
    public function show ($id)
    {
        $product = Product::findOrFail($id);
        return view ('listing_detail', compact('product'));
    }

    // 出品商品の編集画面を表示
    public function listing_edit ($id)
    {
        $product = Product::findOrFail($id);
        return view('listing_edit', compact('product'));
    }

    // 商品の更新処理
    public function update (EditProductRequest $request, $id)
    {
        // バリデーションを通過したデータを取得
        $validated = $request->validated();

        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        // 画像がアップロードされた場合
        if ($request->hasFile('img_path')) {
            // 既存の画像ファイルを削除
            if ($product->img_path) {
                Storage::delete('public/' . $product->img_path);
            } 
            // 画像を保存
            $imagePath = $request->file('img_path')->store('images', 'public');
            $product->img_path = $imagePath;
        }

        $product->save();

        return redirect()->route('listing.detail', $product->id)
        ->with('success', '商品を更新しました。');
    }

    // 商品の検索処理
    public function search (ProductSearchRequest $request)
    {
        $user_id = Auth::id();
        // 自分以外の商品のみを取得
        $query = Product::where('user_id', '!=', $user_id);
        // バリデーションを通過したデータを取得
        $validated = $request->validated();
        // 商品名に入力された値を変数に代入
        $productName = $request->input('product_name');
        // 最低価格に入力された値を変数に代入
        $priceMin = $request->input('price_min');
        // 最高価格に入力された値を変数に代入
        $priceMax = $request->input('price_max');

        // 検索する商品名が入力された場合
        if ($request->filled('product_name')) {
            // 部分一致条件追加して検索
            $query->where('product_name', 'like', '%' . $productName . '%');
        }

        // 最低価格に入力された値がある場合
        if ($request->filled('price_min')) {
            // 最低価格の条件を追加して検索
            $query->where('price', '>=', $priceMin);
        }
        // 最高価格に入力された値がある場合
        if ($request->filled('price_max')) {
            // 最高価格の条件を追加して検索
            $query->where('price', '<=', $priceMax);
        }

        $products = $query->get();
        return view('index', compact('products'));
    }

    // コンストラクタ
    public function __construct(
        private Product $product = new Product,
    ) {}

    // マイページ画面表示
    public function mypage()
    {
        // ログインユーザーのIDを取得
        $user_id = Auth::id();
        // ログインユーザーの商品一覧を取得
        $products = $this->product->getOwnProduct($user_id);

        // ログインユーザーの購入履歴を取得
        $purchases = Sale::with('product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // マイページにデータを渡す
        return view('mypage', compact('products', 'purchases'));
    }

    // 商品の削除処理
    public function destroy ($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('mypage')
            ->with('success', '商品を削除しました');
    }

    // 商品詳細を表示
    public function product_detail ($id)
    {
        $product = Product::findOrFail($id);
        return view('product_detail', compact('product'));
    }

    // 商品購入画面の表示
    public function showPurchase($id)
    {
        $product = Product::findOrFail($id);
        return view('purchase', compact('product'));
    }

    // 商品購入画面の処理
    public function purchase(PurchaseRequest $request)
    {
        $product_id = $request->input('id');
        $quantity = $request->input('quantity');

        $product = Product::find($product_id);
        
        // 在庫が不足している場合はエラーをビューに返す
        if (!$product || !$product->hasSufficientStock($quantity)) {
            return redirect()->back()
                ->withErrors(['quantity' => '在庫が不足しています。'])
                ->withInput();
        }

        DB::beginTransaction();
        try {
            Sale::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);

            $product->reduceStock($quantity);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors(['error' => '購入に失敗しました。'])
                ->withInput();
        }

        return redirect()->route('index')
            ->with('success', '購入が完了しました。');
    }

}
