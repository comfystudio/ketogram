<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Item;
use Illuminate\Support\Facades\View;
use App\News;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->cartArray();

        $this->footerNews();
    }

    /** Format URL */
    public function FormatUrl($title){
        $url = preg_replace("/[^A-Za-z0-9 ]/", "", $title);
        $url = trim($url);
        $url = str_replace('  ', ' ', $url);
        $url = str_replace(' ', '-', $url);
        $url = strtolower($url);
        return $url;
    }

    public function cartArray(){
        $cartArray = array();
        if(isset($_COOKIE['cart']) && !empty($_COOKIE['cart'])) {
            $items = json_decode($_COOKIE['cart'], true);

            //potato move but I need to create an array of the keys to pass into the below database call.
            $tempItems = array();
            foreach ($items as $key => $temp) {
                $tempItems[] = $key;
            }

            $cartArray = Item::with('itemImages')->where(array('items.is_active' => 1, 'items.is_order' => 1))
                ->whereIn('items.id', $tempItems)
                ->get();

            //we need to append a quantity to our fields
            $totalCount = 0;
            $totalPrice = 0;
            foreach ($cartArray as $key => $dat) {
                if (array_key_exists($dat->id, $items)) {
                    $totalCount += $items[$dat->id];
                    if(isset($cartArray[$key]->itemSales[0]) && !empty($cartArray[$key]->itemSales[0])) {
                        $totalPrice += ($items[$dat->id] * $cartArray[$key]->itemSales[0]->price);
                    }else{
                        $totalPrice += ($items[$dat->id] * $cartArray[$key]->price);
                    }
                    $cartArray[$key]->quantity = $items[$dat->id];
                }
            }
            $cartArray['totalCount'] = $totalCount;
            $cartArray['totalPrice'] = $totalPrice;
            //pr($cartArray);die;
            return View::share('cartArray', $cartArray);
        }else{
            $cartArray['totalCount'] = 0;
            $cartArray['totalPrice'] = 0;
            //pr($cartArray);die;
            return View::share('cartArray', $cartArray);
        }
    }

    public function footerNews(){
        $footerNews = News::orderBy('publish_date', 'DESC')->where('publish_date', '<',  Carbon::now())->where('is_active', '=', 1)->limit(4)->get();
        return View::share('footerNews', $footerNews);
    }

    public function defaultMeta(){
        $meta = array(
            'title' => 'Ketogram Auth',
            'description' => 'Ketogram Auth',
            'section' => 'Login',
            'subSection' => 'Login'
        );
        return View::share('meta', $meta);
    }
}
