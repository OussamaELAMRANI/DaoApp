<?php


namespace App\Services\Api;


use App\Inventory;
use Illuminate\Http\Request;

class InventoryService
{

    //
    public function insertOne(Request $req)
    {
        Inventory::create($req->only(['designation','codaentrege']));
    }
}
