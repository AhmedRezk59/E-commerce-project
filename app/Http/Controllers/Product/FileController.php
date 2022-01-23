<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload_file(Request $request)
    {
        $product_id = Product::latest()->first()->id;
        $imageName = $request->file->getClientOriginalName();
        File::create([
            'name' => $imageName,
            'size' => $request->file->getSize() / 1000000,
            'type' => $request->file->getMimeType(),
            'product_id' => $product_id
        ]);
        if ($request->hasFile('file')) {
            $request->file('file')->storeAs("products/files/$product_id", $imageName, 'public');
        }
        return response('file uploaded successfully', 201);
    }
    public function upload_file_to_product(Request $request , $id)
    {
        $imageName = $request->file->getClientOriginalName();

        File::create([
            'name' => $imageName,
            'size' => $request->file->getSize() / 1000000,
            'type' => $request->file->getMimeType(),
            'product_id' => $id
        ]);
        if ($request->hasFile('file')) {
            $request->file('file')->storeAs("products/files/" . $id, $imageName, 'public');
        }
        return response('file uploaded successfully', 201);

    }

    public function delete_file($name, $id)
    {
        File::where('product_id', $id)->where('name', $name)->delete();
        Storage::disk('public')->delete("products/files/$id/$name");
        return response('File deleted Successfully');
    }
}
