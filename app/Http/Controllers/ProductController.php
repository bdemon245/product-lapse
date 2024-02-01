<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Select;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('features.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Select::of('product')->type('category')->get();
        $stages     = Select::of('product')->type('stage')->get();
        return view('features.product.partials.create', compact('categories', 'stages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request->logo);
        $product = Product::create([
            'owner_id'    => auth()->id(),
            'name'        => $request->name,
            'url'         => $request->url,
            'stage'       => $request->stage,
            'description' => $request->description,
         ]);
        $image = $product->storeImage($request->logo);
        notify()->success(__('notify/success.create'));
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Set Cookie for the selected product
        $cookie   = Cookie::forever('product_id', $id);
        $product  = Product::find($id);
        $products = Product::get();
        $features = $this->getFeatureList();
        return response(view('features.product.home', compact('product', 'features', 'products')))->withCookie($cookie);
    }
    /**
     * Display the specified resource.
     */
    public function filter(Request $request)
    {
        // Set Cookie for the selected product
        $cookie   = Cookie::forever('product_id', $request->product_id);
        $product  = Product::find($request->product_id);
        $products = Product::get();
        $features = $this->getFeatureList();
        return response(view('features.product.home', compact('product', 'features', 'products')))->withCookie($cookie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('features.product.partials.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update([
            'name'        => $request->name,
            'url'         => $request->url,
            'stage'       => $request->stage,
            'description' => $request->description,
         ]);
        $image = $product->updateImage($request->logo, $product->image);
        notify()->success(__('notify/success.update'));
        return redirect()->route('product.index')->with([ 'success', 'Update Success!' ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $data = $product->delete();
        notify()->success(__('notify/success.delete'));
        return redirect()->route('product.index');
    }

    protected function getFeatureList(): array
    {
        return [
            'innovate'              => [
                'name'    => @__('productHome.innovate'),
                'counter' => 5,
                'icon'    => 'img/solution.png',
                'route'   => route('idea.index'),
             ],
            'product-planning'      => [
                'name'    => @__('productHome.product-planning'),
                'counter' => 0,
                'icon'    => 'img/plan.png',
                'route'   => route('task.index'),
             ],
            'product-support'       => [
                'name'    => @__('productHome.product-support'),
                'counter' => 0,
                'icon'    => 'img/technical-support.png',
                'route'   => route('support.index'),
             ],
            'change-management'     => [
                'name'    => @__('productHome.change-management'),
                'counter' => 0,
                'icon'    => 'img/cycle.png',
                'route'   => route('change.index'),
             ],
            'product-documentation' => [
                'name'    => @__('productHome.documentation'),
                'counter' => 0,
                'icon'    => 'img/checklist.png',
                'route'   => route('document.index'),
             ],
            'product-team'          => [
                'name'    => @__('productHome.product-team'),
                'counter' => 0,
                'icon'    => 'img/help.png',
                'route'   => route('team.index'),
             ],
            'product-reporting'     => [
                'name'    => @__('productHome.reporting'),
                'counter' => 0,
                'icon'    => 'img/dashboard.png',
                'route'   => route('report.index'),
             ],
            'product-info'          => [
                'name'    => @__('productHome.product-info'),
                'counter' => 0,
                'icon'    => 'img/website.png',
                'route'   => '',
             ],
            'product-history'       => [
                'name'    => @__('productHome.product-history'),
                'counter' => 0,
                'icon'    => 'img/bank-account.png',
                'route'   => route('release.index'),
             ],
            'historical-images'     => [
                'name'    => @__('productHome.historical-image'),
                'counter' => 0,
                'icon'    => 'img/photo.png',
                'route'   => route('product-history.index'),
             ],
            'product-delivery'      => [
                'name'    => @__('productHome.product-delivery'),
                'counter' => 0,
                'icon'    => 'img/delivered.png',
                'route'   => route('delivery.index'),
             ],
            'certificate'           => [
                'name'    => @__('productHome.certificate'),
                'counter' => 0,
                'icon'    => 'img/delivered.png',
                'route'   => route('certificate.index'),
             ],
         ];
    }


     /**
     * For Search Feature.
     */
    public function search(SearchRequest $request)
    {
        $products = SearchService::items($request);
        return view('features.product.index', compact('products'));
    }


    /**
     * Display the specified individual resource.
     */
    public function info(string $id)
    {
        // Set Cookie for the selected product
        $cookie   = Cookie::forever('product_id', $id);
        $product  = Product::find($id);
        $products = Product::get();
        $features = $this->getFeatureList();
        return response(view('features.product.home', compact('product', 'features', 'products')))->withCookie($cookie);
    }
}
