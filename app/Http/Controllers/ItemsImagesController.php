<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ItemImage;
use App\Item;
use Illuminate\Support\Facades\File;

class ItemsImagesController extends Controller
{
    /**
     * PAGE: Admin/Items-Images/
     * GET: /admin/items-images/
     * This method handles the index view of Items Images
     * @param Items $items
     * @return
     */
    public function admin_index(Item $items){
        $meta = array(
            'title' => 'Items Images Index',
            'description' => 'Items Images index',
            'section' => 'Item',
            'subSection' => 'Item'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $images = $items->ItemImages()->where('image', 'like', '%'.$_GET['keywords'].'%')
                ->orWhere('title', 'like', '%'.$_GET['keywords'].'%')
                ->orderBy('sort', 'ASC')
                ->paginate(20);
        }else{
            $images = $items->ItemImages()->orderBy('sort', 'ASC')->paginate(20);
        }
        return view('items_images/admin/index', compact('images', 'meta', 'items'));
    }

    /**
     * PAGE: Admin/Items-Images/Create
     * GET: /admin/items-images/create
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

        return view('items_images/admin/create', compact('meta', 'items'));
    }

    /**
     * PAGE: Admin/Items-Images/Create
     * POST: /admin/items-images/create
     * This method handles the creation of Items Images
     * @param Request $request Items $items
     * @return
     */
    public function admin_create(Item $items, Request $request){
        $this->validate($request, [
            'title' => 'max:255',
            'image' => 'required',
            'is_active' => 'Integer'
        ]);

        //finding the largest sort value so we can increment this to the end
        $count = DB::table('item_images')->where('item_id', $items->id)->max('sort');
        if(!isset($count)){
            $count = 0;
        }else{
            $count++;
        }

        // storing the image
        if(isset($request->image) && !empty($request->image)){
            //$path = $request->image->store('images/uploads');
            $path = 'images/uploads/'.strtotime("now").'.png';

            if(isset($request->imagebase64)){
                $data = $request->imagebase64;
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $mimes = array('.jpg', '.gif', '.jpeg');
                $path = str_replace($mimes, '.png', $path);
                file_put_contents(''. $path, $data);
            }

        }
        ItemImage::create(array(
                'title' => $request->title,
                'sort' => $count,
                'item_id' => $items->id,
                'image' => $path,
                'is_active' => $request->is_active
            )
        );

        return redirect('/admin/items-images/'.$items->id)->with('status', 'Items Images added successfully.');
    }

    /**
     * PAGE: Admin/Items-Images/Delete
     * GET: /admin/items-images/delete
     * This method handles the deletion view of Items Images
     * @param Items $items Items Images $images
     * @return
     */
    public function admin_deleteShow(Item $items, ItemImage $images){
        $meta = array(
            'title' => 'Items Images Delete',
            'description' => 'Items Images Delete',
            'section' => 'Item',
            'subSection' => 'Item'
        );

        return view('items_images/admin/delete', compact('meta', 'images', 'items'));
    }

    /**
     * PAGE: Admin/Items-Images/Delete
     * POST: /admin/items-images/delete
     * This method handles the deletion view of Items Images
     * @param Items $items ItemsImage $images
     * @return
     */
    public function admin_delete(Item $items, ItemImage $images){
        $images->delete();
        File::delete($images->image);

        return redirect('/admin/items-images/'.$items->id)->with('status', 'Items Images deleted successfully.');
    }

    /**
     * PAGE: Admin/Items-Images/edit
     * GET: /admin/items-images/edit
     * This method handles the edit view of Items Images
     * @param Items $items, ItemsImage $images
     * @return
     */
    public function admin_editShow(Item $items, ItemImage $images){
        $meta = array(
            'title' => 'Items Images Edit',
            'description' => 'Items Images edit',
            'section' => 'Item',
            'subSection' => 'Item'
        );

        return view('items_images/admin/create', compact('meta', 'images', 'items'));
    }

    /**
     * PAGE: Admin/Items-Images/edit
     * POST: /admin/items-images/edit
     * This method handles the editing of Items Images
     * @param Request $request ItemsImage $images
     * @return
     */
    public function admin_edit(Item $items, Request $request, ItemImage $images){
        $this->validate($request, [
            'title' => 'max:255',
            'is_active' => 'Integer'
        ]);

        //checking if we have new image and do following else assign $path to previous image path
        if(isset($request->image) && !empty($request->image)){
//            $path = $request->image->store('images/uploads');
//            $file = $request->file('image');
//            File::delete($images->image);
//
//            $file->move('images/uploads',  $path);
            $path = $request->image->store('images/uploads');

            if(isset($request->imagebase64)){
                File::delete($images->image);

                $data = $_POST['imagebase64'];
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $mimes = array('.jpg', '.gif', '.jpeg');
                $path = str_replace($mimes, '.png', $path);
                file_put_contents(''. $path, $data);
            }
        }else{
            $path = $images->image;
        }

        $input = array(
            'title' => $request->title,
            'is_active' => $request->is_active,
            'image' => $path
        );

        $images->update($input);
        return redirect('/admin/items-images/'.$items->id)->with('status', 'Items Images Edited successfully.');
    }

    /**
     * PAGE: Admin/Items-Images/download
     * GET: /admin/items-images/download
     * This method handles the download of Items Images
     * @param Items $itemsItemsImage $images
     * @return
     */
    public function admin_download(Item $items, ItemImage $images){
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="'.basename($images->image).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Content-Transfer-Encoding: binary');
        header('Pragma: public');
        header('Content-Length: ' . filesize($images->image));
        readfile($images->image);
        exit;
    }

    /**
     * PAGE: items-images types sort
     * GET: /admin/items-images/{items}/sort/:direction/{items-images}
     * This method handles the sorting of items-images
     * @param string $direction, int $id
     */
    public function admin_sort(Item $items, $direction = null, ItemImage $images, $sort){
        if(!empty($images->id)){
            if($direction == 'up'){
                $order = $sort-1;
                // Make sure we don't move below 0
                if($order < 0){
                    $order = 0;
                }

                // Update the previous item with the new order and add one to it.
                DB::table('item_images')->where([
                    ['sort', $order],
                ])
                    ->update(['sort' => ($order+1)]);


                // Update the selected item sort order.
                DB::table('item_images')->where('id', $images->id)->update(['sort' => $order]);


            }elseif($direction == 'down'){
                $order = $sort+1;

                // Update the previous item with the new order and add one to it.
                DB::table('item_images')->where([
                    ['sort', $order],
                ])
                    ->update(['sort' => ($order-1)]);

                // Update the selected item sort order.
                DB::table('item_images')->where('id', $images->id)->update(['sort' => $order]);

            }
            //Url::redirect('backoffice/trainer-images/index/'.$parent_id);
            return redirect()->back()->with('status', 'Items Images sorted successfully.');

        }else{
            //Url::redirect('backoffice/trainer-images/index/'.$parent_id);
            return redirect()->back()->withErrors('Items Images sort failed');
        }
    }
}
