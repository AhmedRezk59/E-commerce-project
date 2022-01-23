<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function storeProduct($request)
    {
        $this->product->create([
            'title' => $request->title,
            'content' => $request->content,
            'photo' => $request->photo->getClientOriginalName(),
            'department_id' => $request->department_id,
            'trademark_id' => $request->trademark_id,
            'color_id' => $request->color_id,
            'size' => $request->size,
            'size_id' => $request->size_id,
            'price' => $request->price,
            'start_at' => $request->start_at,
            'price_offer' => $request->price_offer,
            'start_offer_at' => $request->start_offer_at,
            'end_offer_at' => $request->end_offer_at,
            'weight' => $request->weight,
            'weight_id' => $request->weight_id,
            'stock' => $request->stock,
            'other_data' => $request->other_data,
        ]);
        $latest_product = $this->product->latest()->first();
        if ($request->hasFile('photo')) {
            $imageName = $request->photo->getClientOriginalName();
            $product_id = $latest_product->id;
            $request->file('photo')->storeAs("products/logos/$product_id", $imageName, 'public');
        }

    }

    public function updateLogo($id, $request)
    {
        Storage::disk('public')->deleteDirectory('products/logos/' . $id);
        $imageName = $request->photo->getClientOriginalName();
        $this->product->whereId($id)->update([
            'photo' => $imageName,
        ]);
        $request->photo->storeAs("products/logos/$id", $imageName, 'public');
    }

    public function multiDelete($request)
    {
        foreach ($request->checkedRows as $rowId) {
            $product = Product::find($rowId);
            Storage::disk('public')->deleteDirectory('/products/files/' . $rowId);
            Storage::disk('public')->deleteDirectory('/products/logos/' . $rowId);
            File::where('product_id', $rowId)->delete();
            $product->delete();
        }
    }
}
