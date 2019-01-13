<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use DB;
use Illuminate\Support\Facades\Cookie;

class ItemsController extends Controller
{
    /**
     * PAGE: Admin/Item/
     * GET: /admin/Item/
     * This method handles the index view of Item
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'Item Index',
            'description' => 'Item index',
            'section' => 'Item',
            'subSection' => 'Item'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $items = Item::where('title', 'like', '%'.$_GET['keywords'].'%')
                ->orderBy('sort', 'ASC')
                ->paginate(20);
        }else{
            $items = Item::with('ItemSales')->orderBy('sort', 'ASC')->paginate(20);
        }

        return view('items/admin/index', compact('items', 'meta'));
    }

    /**
     * PAGE: Admin/Item/Create
     * GET: /admin/Item/create
     * This method handles the creation view of Item
     * @param
     * @return
     */
    public function admin_createShow(){
        $meta = array(
            'title' => 'Item Index',
            'description' => 'Item index',
            'section' => 'Item',
            'subSection' => 'Item'
        );

        $categories = DB::table('food_categories')->where('is_active', 1)->pluck('name', 'id');
        return view('items/admin/create', compact('meta', 'categories'));
    }

    /**
     * PAGE: Admin/Item/Create
     * POST: /admin/Item/create
     * This method handles the creation of Item
     * @param Request $request
     * @return
     */
    public function admin_create(Request $request){
        $this->validate($request, [
            'stock' => array('required', 'Integer'),
            'title' => array('required','unique:items', 'max:255'),
            'category_id' => 'Integer',
            'text' => 'required',
            'price' => array('required', 'numeric'),
            'subscription' => 'Integer',
            'is_order' => 'Integer',
            'is_active' => 'Integer',
            'is_gift' => 'Integer',
            'is_featured' => 'Integer',
            'sat_fat' => 'numeric',
            'tran_fat' => 'numeric',
            'cholesterol' => 'numeric',
            'salt' => 'numeric',
            'sugar' => 'numeric',
            'polyol' => 'numeric',
        ]);

        $items = Item::create($request->except(['categories', 'save']));


        if($request->has('categories')) {
            $items->FoodCategory()->sync($request->categories);
        }

        return redirect('/admin/items/')->with('status', 'Item added successfully.');
    }

    /**
     * PAGE: Admin/Item/Delete
     * GET: /admin/Item/delete
     * This method handles the deletion view of Item
     * @param Item $Item
     * @return
     */
    public function admin_deleteShow(Item $items){
        $meta = array(
            'title' => 'Item Delete',
            'description' => 'Item Delete',
            'section' => 'Item',
            'subSection' => 'Item'
        );

        return view('items/admin/delete', compact('meta', 'items'));
    }

    /**
     * PAGE: Admin/Item/Delete
     * POST: /admin/Item/delete
     * This method handles the deletion view of Item
     * @param Item $Item
     * @return
     */
    public function admin_delete(Item $items){
        $items->delete();

        return redirect('/admin/items/')->with('status', 'Item deleted successfully.');
    }

    /**
     * PAGE: Admin/Item/edit
     * GET: /admin/Item/edit
     * This method handles the edit view of Item
     * @param Item $Item
     * @return
     */
    public function admin_editShow(Item $items){
        $meta = array(
            'title' => 'Item Edit',
            'description' => 'Item edit',
            'section' => 'Item',
            'subSection' => 'Item'
        );

        if(isset($items->FoodCategory[0]) && !empty($items->FoodCategory[0])) {
            foreach ($items->FoodCategory as $category) {
                $temp['categories'][] = $category->pivot->food_category_id;
            }
            $items->append($temp);
        }

        $categories = DB::table('food_categories')->where('is_active', 1)->pluck('name', 'id');
        return view('items/admin/create', compact('meta', 'items', 'categories'));
    }

    /**
     * PAGE: Admin/Item/edit
     * POST: /admin/Item/edit
     * This method handles the editing of Item
     * @param Request $request Item $Item
     * @return
     */
    public function admin_edit(Request $request, Item $items){
        $this->validate($request, [
            'stock' => array('required', 'Integer'),
            'title' => array('required','unique:items,title,'.$items->id, 'max:255'),
            'category_id' => 'Integer',
            'text' => 'required',
            'price' => array('required', 'numeric'),
            'subscription' => 'Integer',
            'is_order' => 'Integer',
            'is_active' => 'Integer',
            'is_gift' => 'Integer',
            'is_featured' => 'Integer',
            'sat_fat' => 'numeric',
            'tran_fat' => 'numeric',
            'cholesterol' => 'numeric',
            'salt' => 'numeric',
            'sugar' => 'numeric',
            'polyol' => 'numeric',
        ]);

        $items->update(array(
            'stock' => $request->stock,
            'title' => $request->title,
            'text' => $request->text,
            'price' => $request->price,
            'protein' => $request->protein,
            'carbs' => $request->carbs,
            'fat' => $request->fat,
            'fibre' => $request->fibre,
            'cals' => $request->cals,
            'serving' => $request->serving,
            'subscription' => $request->subscription,
            'is_order' => $request->is_order,
            'is_active' => $request->is_active,
            'is_gift' => $request->is_gift,
            'is_featured' => $request->is_featured,
            'sat_fat' => $request->sat_fat,
            'tran_fat' => $request->tran_fat,
            'cholesterol' => $request->cholesterol,
            'salt' => $request->salt,
            'sugar' => $request->sugar,
            'polyol' => $request->polyol,
            'weight' => $request->weight
            )
        );

        if($request->has('categories')) {
            $items->FoodCategory()->sync($request->categories);
        }
        return redirect('/admin/items/')->with('status', 'Item Edited successfully.');
    }

    /**
     * PAGE: Item
     * GET: /Item
     * This method handles the index view of Item
     * @param
     * @return
     */
    public function index(){
        $meta = array(
            'title' => 'ComfyStudio Website Development Belfast Item',
            'description' => 'ComfyStudio Website Development, Website Design, Belfast, Item',
            'section' => 'Item',
            'subSection' => 'Item'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])) {
            $Item = Item::where('title', 'like', '%' . $_GET['keywords'] . '%')
                ->where('publish_date', '<', 'CURDATE()')
                ->orderBy('sort', 'ASC')
                ->paginate(5);
        }elseif(isset($_GET['category']) && !empty($_GET['category'])){
            $Item = Item::whereHas('category', function($q){
                $q->where('name', '=', $_GET['category']);
            })
                ->orderBy('sort', 'ASC')
                ->paginate(5);
        }else{
            $Item = Item::orderBy('sort', 'ASC')->where('is_active', '=', '1')->paginate(5);
        }

        $categories = DB::table('categories')->where('is_active', 1)->pluck('name', 'id');
        return view('Item/index', compact('Item', 'meta', 'categories'));
    }

    /**
     * PAGE: Item/{{slug}}
     * GET: /Item/{{slug}}
     * This method handles the view of Item
     * @param Item $item
     * @return
     */
    public function view(Item $item){
        $meta = array(
            'title' => 'Ketogram UK',
            'description' => 'ketogram UK shop for low carb and ketosis foods',
            'section' => 'Order',
            'subSection' => 'Item View'
        );
        $item = Item::where('id', $item->id)->where('is_active', 1)->with('FoodCategory')->first();
        if(isset($item->id) && !empty($item->id)) {
            if(isset($item->ItemImages[0])) {
                $facebook = array(
                    'og:title' => $item->title,
                    'og:url' => env('APP_URL') . '/' . $item->id,
                    'og:type' => 'Website',
                    'og:description' => $meta['description'],
                    'og:image' => env('APP_URL') . '/' . $item->ItemImages[0]['image']
                );
            }else{
                $facebook = array(
                    'og:title' => $item->title,
                    'og:url' => env('APP_URL') . '/' . $item->id,
                    'og:type' => 'Website',
                    'og:description' => $meta['description'],
                    'og:image' => env('APP_URL') . '/images/no-image.png'
                );
            }


            $categories = DB::table('items_categories')->where('item_id', $item->id)->pluck('food_category_id');

            $relatedItems = Item::where('is_active', 1)
                ->where('id', '<>', $item->id)
                ->whereHas('FoodCategory', function ($q) use ($categories) {
                    $q->whereIn('food_categories.id', $categories);
                })
                ->orderBy('created_at', 'ASC')
                ->limit(3)
                ->get();

            $tags = DB::table('categories')->where('is_active', 1)->pluck('name', 'id');

            //setting our stock level based on db minus the cart value
            if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])){
                $cookie = json_decode($_COOKIE['cart'], true);
                if(isset($cookie[$item->id]) && !empty($cookie[$item->id])) {
                    $item->stock =  $item->stock - $cookie[$item->id];
                }

                //doing the same for relatedItems now
                foreach($relatedItems as $key => $relatedItem){
                    if(isset($cookie[$relatedItem->id]) && !empty($cookie[$relatedItem->id])) {
                        $relatedItems[$key]->stock = $relatedItems[$key]->stock - $cookie[$relatedItem->id];
                    }
                }
            }

            return view('items/view', compact('item', 'facebook', 'meta', 'tags', 'relatedItems', 'cookie'));
        }else{
            return redirect()->back()->withErrors(['Item does not exist']);
        }
    }

    /**
     * PAGE: Cart
     * GET: /Cart
     * This method handles the Cart
     * @param
     * @return
     */
    public function cart(){
        $meta = array(
            'title' => 'Ketogram UK',
            'description' => 'ketogram UK shop for low carb and ketosis foods',
            'section' => 'Order',
            'subSection' => 'Cart'
        );
        if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])){
            $cookie = json_decode($_COOKIE['cart'], true);
            $cookieArray = array();
            foreach($cookie as $key => $cook){
                $cookieArray[] = $key;
            }
            //pr($cookieArray);die;
            $items = Item::whereIn('id', $cookieArray)->where(array('is_active' => '1', 'is_order' => '1'))->get();

            $totalCount = 0;
            $totalPrice = 0;
            foreach($items as $key => $item){
                if(isset($cookie[$item->id]) && !empty($cookie[$item->id])) {
                    $totalCount += $cookie[$item->id];
                    $items[$key]->stock = $items[$key]->stock - $cookie[$item->id];
                    $items[$key]->quantity = $cookie[$item->id];

                    if(isset($items[$key]->itemSales[0]) && !empty($items[$key]->itemSales[0])) {
                        $totalPrice += ($cookie[$item->id] * $items[$key]->itemSales[0]->price);
                    }else{
                        $totalPrice += ($cookie[$item->id] * $items[$key]->price);
                    }
                }
            }
            $items->totalCount = $totalCount;
            $items->totalPrice = $totalPrice;

            return view('items/cart', compact('items', 'meta', 'cookie'));
        }else{
            return redirect()->back()->withErrors(['No items in cart']);
        }
    }

    /**
     * PAGE: /Items/update-cart/{item}/$quantity/$type
     * GET: /Items/update-cart/{item}/$quantity/$type
     * This method handles creates / updates cookie for cart and returns updated cart html
     * @param Item $items, Int $quantity, String $type
     * @return
     */
    public function ajax_update_cart(Item $item, $quantity, $set){
        if(isset($item->id) && !empty($item->id)){
            //if we have cookie cart already
            if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])){
                $data = $this->update_cart($item, $_COOKIE['cart'], $quantity, $set);
                return response()->json(json_encode($data));
            }else{
                setcookie('cart', json_encode(array($item->id => 1)), time()+600000, '/');
                $cookie = json_encode(array($item->id => 1));
                $data = $this->update_cart($item, $cookie, $quantity, $set);
                return response()->json(json_encode($data));

            }
        }else{
            return redirect()->back()->withErrors(['Item does not exist']);
        }
    }

    /**
     * PAGE: /Items/remove-cart-items/{item}
     * GET: /Items/uremove-cart-items/{item}
     * This method removes items from cookie and returns results.
     * @param Item $items
     * @return
     */
    public function ajax_remove_cart_items(Item $item){
        if(isset($item->id) && !empty($item->id)){
            $items = json_decode($_COOKIE['cart'], true);
            unset($items[$item->id]);
            setcookie('cart', json_encode($items), time()+600000, '/');
            $data = $this->buildCartData($items);
            return response()->json(json_encode($data));
        }else{
            return redirect()->back()->withErrors(['Item does not exist']);
        }
    }

    /**
     * This method handles creating and updating cart cookie as well as returning cart data we need
     * @param Item $items
     * @return $data object of cart info
     */
    public function update_cart(Item $item, $cookie = null, $quantity, $set){
        $items = json_decode($cookie, true);
        //if the item is already in cart array increment
        if(array_key_exists($item->id, $items) && isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])){
            //if $set = set then the quantity is not being incremented but rather set.
            if($set == 'set'){
                $items[$item->id] = $quantity;
            }else{
                $items[$item->id] = $items[$item->id] + $quantity;
            }
            setcookie('cart', json_encode($items), time()+600000, '/');
        }else{
            //else we append the item to the array.
            $items[$item->id] = $quantity;
            setcookie('cart', json_encode($items), time()+600000, '/');
        }
        return $this->buildCartData($items);
    }

    public function buildCartData($items){
        //potato move but I need to create an array of the keys to pass into the below database call.
        $tempItems = array();
        foreach($items as $key => $temp){
            $tempItems[] = $key;
        }

        $data = Item::with('itemImages')->with('itemSales')->where(array('items.is_active' => 1, 'items.is_order' => 1))
            ->whereIn('items.id', $tempItems)
            ->get();

        //we need to append a quantity to our fields
        $totalCount = 0;
        $totalPrice = 0;
        foreach($data as $key => $dat){
            if(array_key_exists($dat->id, $items)){
                $totalCount += $items[$dat->id];

                if(isset($data[$key]->itemSales[0]) && !empty($data[$key]->itemSales[0])) {
                    $totalPrice += ($items[$dat->id] * $data[$key]->itemSales[0]->price);
                }else{
                    $totalPrice += ($items[$dat->id] * $data[$key]->price);
                }

                $data[$key]->quantity = $items[$dat->id];
            }
        }
        $data['totalCount'] = $totalCount;
        $data['totalPrice'] = $totalPrice;
        return $data;
    }

    /**
     * PAGE: /Items/update-custom/{item}/$type
     * GET: /Items/update-custom/{item}/$type
     * This method handles creates / updates cookie for custom and returns custom cookie response
     * @param Item $items, String $type
     * @return
     */
    public function ajax_update_custom(Item $item, $set){
        if(isset($item->id) && !empty($item->id)){
            //if we have cookie cart already
            if(isset($_COOKIE['custom']) && !empty($_COOKIE['custom'])){
                $data = $this->update_custom($item, $_COOKIE['custom'], false, $set);
                return response()->json(json_encode($data));
            }else{
                setcookie('custom', json_encode(array($item->id => 1)), time()+600000, '/');
                $cookie = json_encode(array($item->id => 1));
                $data = $this->update_custom($item, $cookie, false, $set);
                return response()->json(json_encode($data));

            }
        }else{
            return redirect()->back()->withErrors(['Item does not exist']);
        }
    }

    /**
     * This method handles creating and updating custom cookie as well as returning cart data we need
     * @param Item $items
     * @return $data object of cart info
     */
    public function update_custom(Item $item, $cookie = null, $quantity, $set){
        $items = json_decode($cookie, true);
        //if the item is already in cart array increment
        if(array_key_exists($item->id, $items) && isset($_COOKIE['custom']) && !empty($_COOKIE['custom'])){
            //if $set = set then the quantity is not being incremented but rather set.
            if($set == 'set'){
                $items[$item->id] = 1;
            }else{
                $items[$item->id] = $items[$item->id] + 1;
            }
            setcookie('custom', json_encode($items), time()+600000, '/');
        }else{
            //else we append the item to the array.
            $items[$item->id] = 1;
            setcookie('custom', json_encode($items), time()+600000, '/');
        }
        return $this->buildCustomData($items);
    }

    public function buildCustomData($items){
        //potato move but I need to create an array of the keys to pass into the below database call.
        $tempItems = array();
        foreach($items as $key => $temp){
            $tempItems[] = $key;
        }

        $data = Item::with('itemImages')->where(array('items.is_active' => 1, 'items.subscription' => 1))
            ->whereIn('items.id', $tempItems)
            ->get();

        //we need to append a quantity to our fields
        $totalCount = 0;
        $totalPrice = 0;
        foreach($data as $key => $dat){
            if(array_key_exists($dat->id, $items)){
                $totalCount += $items[$dat->id];

                if(isset($data[$key]->itemSales[0]) && !empty($data[$key]->itemSales[0])) {
                    $totalPrice += ($items[$dat->id] * $data[$key]->itemSales[0]->price);
                }else{
                    $totalPrice += ($items[$dat->id] * $data[$key]->price);
                }

                $data[$key]->quantity = $items[$dat->id];
            }
        }
        $data['totalCount'] = $totalCount;
        $data['totalPrice'] = $totalPrice;
        return $data;
    }

    /**
     * PAGE: items types sort
     * GET: /admin/items/{items}/sort/:direction/{items}
     * This method handles the sorting of items
     * @param string $direction, int $id
     */
    public function admin_sort(Item $items, $direction = null, $sort){
        if(!empty($items->id)){
            if($direction == 'up'){
                $order = $sort-1;
                // Make sure we don't move below 0
                if($order < 0){
                    $order = 0;
                }

                // Update the previous item with the new order and add one to it.
                DB::table('items')->where([
                    ['sort', $order],
                ])
                    ->update(['sort' => ($order+1)]);


                // Update the selected item sort order.
                DB::table('items')->where('id', $items->id)->update(['sort' => $order]);


            }elseif($direction == 'down'){
                $order = $sort+1;

                // Update the previous item with the new order and add one to it.
                DB::table('items')->where([
                    ['sort', $order],
                ])
                    ->update(['sort' => ($order-1)]);

                // Update the selected item sort order.
                DB::table('items')->where('id', $items->id)->update(['sort' => $order]);

            }
            //Url::redirect('backoffice/trainer-images/index/'.$parent_id);
            return redirect()->back()->with('status', 'Items sorted successfully.');

        }else{
            //Url::redirect('backoffice/trainer-images/index/'.$parent_id);
            return redirect()->back()->withErrors('Items sort failed');
        }
    }
}
