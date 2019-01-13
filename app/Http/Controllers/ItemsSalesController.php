<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ItemSale;
use App\Item;
use Illuminate\Support\Facades\File;

class ItemsSalesController extends Controller
{
    /**
     * PAGE: Admin/Items-Sales/Create
     * GET: /admin/items-sales/create
     * This method handles the creation view of Items Images
     * @param Items $items
     * @return
     */
    public function admin_createShow(Item $items){
        $meta = array(
            'title' => 'Items Images Index',
            'description' => 'Items Images index',
            'section' => 'Item',
            'subSection' => 'Item'
        );

        return view('items_sales/admin/create', compact('meta', 'items'));
    }

    /**
     * PAGE: Admin/Items-Sales/Create
     * POST: /admin/items-sales/create
     * This method handles the creation of Items Images
     * @param Request $request Items $items
     * @return
     */
    public function admin_create(Item $items, Request $request){
        $this->validate($request, [
            'price' => 'required|numeric',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date'
        ]);

        //need to delete previous sale
        ItemSale::where('item_id', '=', $items->id)->delete();

        //saving our data
        ItemSale::create($request->except(array('save', 'updated_at', 'created_at')));

        return redirect('/admin/items')->with('status', 'Items Sale added successfully.');
    }
}
