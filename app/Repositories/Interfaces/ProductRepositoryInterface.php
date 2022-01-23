<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function storeProduct($request);
    public function updateLogo($id ,$request);
    public function multiDelete($request);
}
