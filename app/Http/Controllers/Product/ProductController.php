<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureAdminIsSuper;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductLogoRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\File;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->middleware(EnsureAdminIsSuper::class)->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('files')->orderBy('id', 'desc')->get();

        return response($products, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

        $this->productRepository->storeProduct($request);

        return response('Product Added successfully', 201);
    }

    public function show()
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        Product::whereId($id)->update($request->validated());


        return response('Product updated successfully', 201);
    }

    public function update_logo(UpdateProductLogoRequest $request, $id)
    {
        $this->productRepository->updateLogo($id, $request);
        return response('Logo updated Successfully', 201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        Storage::disk('public')->deleteDirectory('/products/files/' . $id);
        Storage::disk('public')->deleteDirectory('/products/logos/' . $id);
        File::where('product_id', $id)->delete();
        $product->delete();
        return response('Product deleted successfully', 200);
    }


    public function multi_delete(Request $request)
    {
        $this->productRepository->multiDelete($request);

        return response("Checked Rows deleted successfully", 200);
    }
}
