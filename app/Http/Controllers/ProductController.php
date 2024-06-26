<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Select;
use App\Models\User;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['check.limit'], ['only' => [
            'create',
            'store',
        ]]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = User::find(auth()->id())->myProducts()->latest()->paginate();
        $categories = Select::of('product')->type('category')->get();

        return view('features.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Select::of('product')->type('category')->get();
        $stages = Select::of('product')->type('stage')->get();

        return view('features.product.partials.create', compact('categories', 'stages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request->logo);
        $product = Product::create([
            'creator_id' => auth()->id(),
            'name' => $request->name,
            'url' => $request->url,
            'category' => $request->category,
            'stage' => $request->stage,
            'description' => $request->description,
        ]);
        $product->users()->attach(auth()->id());
        if ($request->logo) {
            $image = $product->storeImage($request->logo);
        }
        notify()->success(__('notify/success.create'));

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        setActiveProduct($id);
        $product = Product::find($id);
        $products = User::find(auth()->id())->myProducts;
        $features = $this->getFeatureList($id);

        return response(view('features.product.home', compact('product', 'features', 'products')));
    }

    /**
     * Display the specified resource.
     */
    public function filter(Request $request)
    {
        // Set Cookie for the selected product
        setActiveProduct($request->product_id);
        $product = Product::find($request->product_id);
        $products = User::find(auth()->id())->myProducts()->paginate(10);
        $features = $this->getFeatureList($request->product_id);

        return response(view('features.product.home', compact('product', 'features', 'products')));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Select::of('product')->type('category')->get();
        $stages = Select::of('product')->type('stage')->get();

        return view('features.product.partials.edit', compact('product', 'categories', 'stages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'url' => $request->url,
            'category' => $request->category,
            'stage' => $request->stage,
            'description' => $request->description,
        ]);
        if ($request->logo) {
            $image = $product->updateImage($request->logo);
        }
        notify()->success(__('notify/success.update'));

        return redirect()->route('product.index')->with(['success', 'Update Success!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->deleteImage();
        $data = $product->delete();
        notify()->success(__('notify/success.delete'));

        return redirect()->route('product.index');
    }

    protected function getFeatureList(?int $id = null): array
    {
        $product = Product::withCount([
            'ideas',
            'tasks',
            'supports',
            'changes',
            'documents',
            'users',
            'reports',
            'releases',
            'deliveries',
        ])->find($id);

        return [
            'innovate' => [
                'name' => 'Innovate',
                'counter' => $product ? $product->ideas_count : 0,
                'icon' => 'img/solution.png',
                'route' => route('idea.index'),
            ],
            'product-planning' => [
                'name' => @__('productHome.product-planning'),
                'counter' => $product ? $product->tasks_count : 0,
                'icon' => 'img/plan.png',
                'route' => route('task.index'),
            ],
            'product-support' => [
                'name' => @__('productHome.product-support'),
                'counter' => $product ? $product->supports_count : 0,
                'icon' => 'img/technical-support.png',
                'route' => route('support.index'),
            ],
            'change-management' => [
                'name' => @__('productHome.change-management'),
                'counter' => $product ? $product->changes_count : 0,
                'icon' => 'img/cycle.png',
                'route' => route('change.index'),
            ],
            'product-documentation' => [
                'name' => @__('productHome.documentation'),
                'counter' => $product ? $product->documents_count : 0,
                'icon' => 'img/checklist.png',
                'route' => route('document.index'),
            ],
            'product-team' => [
                'name' => @__('productHome.product-team'),
                'counter' => $product ? $product->users_count : 0,
                'icon' => 'img/help.png',
                'route' => route('team.index'),
            ],
            'product-reporting' => [
                'name' => @__('productHome.reporting'),
                'counter' => $product ? $product->reports_count : 0,
                'icon' => 'img/dashboard.png',
                'route' => route('report.index'),
            ],
            'product-info' => [
                'name' => @__('productHome.product-info'),
                'counter' => null,
                'icon' => 'img/website.png',
                'route' => route('product.info', $product),
            ],
            'product-history' => [
                'name' => @__('productHome.product-history'),
                'counter' => $product ? $product->releases_count : 0,
                'icon' => 'img/bank-account.png',
                'route' => route('release.index'),
            ],
            'historical-images' => [
                'name' => @__('productHome.historical-image'),
                'counter' => null,
                'icon' => 'img/photo.png',
                'route' => route('product-history.index'),
            ],
            'product-delivery' => [
                'name' => @__('productHome.product-delivery'),
                'counter' => $product ? $product->deliveries_count : 0,
                'icon' => 'img/delivered.png',
                'route' => route('delivery.index'),
            ],
        ];
    }

    /**
     * For Search Feature.
     */
    public function search(SearchRequest $request)
    {
        $products = SearchService::items($request);
        $categories = Select::of('product')->type('category')->get();

        return view('features.product.index', compact('products', 'categories'));
    }

    /**
     * Display the specified individual resource.
     */
    public function info(Product $product)
    {

        $data = Product::with('owner')->find(productId());
        $owner = $data->owner;
        $product->loadComments();
        $comments = $product->comments;

        return view('features.product.partials.show', compact('data', 'owner', 'product', 'comments'));
    }
}
