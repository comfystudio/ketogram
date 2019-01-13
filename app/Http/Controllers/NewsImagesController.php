<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\NewsImage;
use App\News;
use Illuminate\Support\Facades\File;

class NewsImagesController extends Controller
{
    /**
     * PAGE: Admin/News-Images/
     * GET: /admin/news-images/
     * This method handles the index view of News Images
     * @param News $news
     * @return
     */
    public function admin_index(News $news){
        $meta = array(
            'title' => 'News Images Index',
            'description' => 'News Images index',
            'section' => 'News',
            'subSection' => 'News'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $images = $news->newsImages()->where('image', 'like', '%'.$_GET['keywords'].'%')
                ->orWhere('title', 'like', '%'.$_GET['keywords'].'%')
                ->orderBy('sort', 'ASC')
                ->paginate(20);
        }else{
            $images = $news->newsImages()->orderBy('sort', 'ASC')->paginate(20);
        }
        return view('news_images/admin/index', compact('images', 'meta', 'news'));
    }

    /**
     * PAGE: Admin/News-Images/Create
     * GET: /admin/news-images/create
     * This method handles the creation view of News Images
     * @param News $news
     * @return
     */
    public function admin_createShow(News $news){
        $meta = array(
            'title' => 'News Images Index',
            'description' => 'News Images index',
            'section' => 'News',
            'subSection' => 'News'
        );

        return view('news_images/admin/create', compact('meta', 'news'));
    }

    /**
     * PAGE: Admin/News-Images/Create
     * POST: /admin/news-images/create
     * This method handles the creation of News Images
     * @param Request $request News $news
     * @return
     */
    public function admin_create(News $news, Request $request){
        $this->validate($request, [
            'title' => 'max:255',
            'image' => 'required',
            'is_active' => 'Integer'
        ]);

        //finding the largest sort value so we can increment this to the end
        $count = DB::table('news_images')->where('news_id', $news->id)->max('sort');
        if(!isset($count)){
            $count = 0;
        }else{
            $count++;
        }

        // storing the image
        if(isset($request->image) && !empty($request->image)){
            $path = $request->image->store('images/uploads');
            $file = $request->file('image');

            $file->move('images/uploads',  $path);
        }
        NewsImage::create(array(
                'title' => $request->title,
                'sort' => $count,
                'news_id' => $news->id,
                'image' => $path,
                'is_active' => $request->is_active
            )
        );

        return redirect('/admin/news-images/'.$news->id)->with('status', 'News Images added successfully.');
    }

    /**
     * PAGE: Admin/News-Images/Delete
     * GET: /admin/news-images/delete
     * This method handles the deletion view of News Images
     * @param News $news News Images $images
     * @return
     */
    public function admin_deleteShow(News $news, NewsImage $images){
        $meta = array(
            'title' => 'News Images Delete',
            'description' => 'News Images Delete',
            'section' => 'News',
            'subSection' => 'News'
        );

        return view('news_images/admin/delete', compact('meta', 'images', 'news'));
    }

    /**
     * PAGE: Admin/News-Images/Delete
     * POST: /admin/news-images/delete
     * This method handles the deletion view of News Images
     * @param News $news NewsImage $images
     * @return
     */
    public function admin_delete(News $news, NewsImage $images){
        $images->delete();
        File::delete($images->image);

        return redirect('/admin/news-images/'.$news->id)->with('status', 'News Images deleted successfully.');
    }

    /**
     * PAGE: Admin/News-Images/edit
     * GET: /admin/news-images/edit
     * This method handles the edit view of News Images
     * @param News $news, NewsImage $images
     * @return
     */
    public function admin_editShow(News $news, NewsImage $images){
        $meta = array(
            'title' => 'News Images Edit',
            'description' => 'News Images edit',
            'section' => 'News',
            'subSection' => 'News'
        );

        return view('news_images/admin/create', compact('meta', 'images', 'news'));
    }

    /**
     * PAGE: Admin/News-Images/edit
     * POST: /admin/news-images/edit
     * This method handles the editing of News Images
     * @param Request $request NewsImage $images
     * @return
     */
    public function admin_edit(News $news, Request $request, NewsImage $images){
        $this->validate($request, [
            'title' => 'max:255',
            'is_active' => 'Integer'
        ]);

        //checking if we have new image and do following else assign $path to previous image path
        if(isset($request->image) && !empty($request->image)){
            $path = $request->image->store('images/uploads');
            $file = $request->file('image');
            File::delete($images->image);

            $file->move('images/uploads',  $path);
        }else{
            $path = $images->image;
        }

        $input = array(
            'title' => $request->title,
            'is_active' => $request->is_active,
            'image' => $path
        );

        $images->update($input);
        return redirect('/admin/news-images/'.$news->id)->with('status', 'News Images Edited successfully.');
    }

    /**
     * PAGE: Admin/News-Images/download
     * GET: /admin/news-images/download
     * This method handles the download of News Images
     * @param News $newsNewsImage $images
     * @return
     */
    public function admin_download(News $news, NewsImage $images){
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
     * PAGE: news-images types sort
     * GET: /admin/news-images/{news}/sort/:direction/{news-images}
     * This method handles the sorting of news-images
     * @param string $direction, int $id
     */
    public function admin_sort(News $news, $direction = null, NewsImage $images, $sort){
        if(!empty($images->id)){
            if($direction == 'up'){
                $order = $sort-1;
                // Make sure we don't move below 0
                if($order < 0){
                    $order = 0;
                }

                // Update the previous item with the new order and add one to it.
                DB::table('news_images')->where([
                    ['sort', $order],
                ])
                    ->update(['sort' => ($order+1)]);


                // Update the selected item sort order.
                DB::table('news_images')->where('id', $images->id)->update(['sort' => $order]);


            }elseif($direction == 'down'){
                $order = $sort+1;

                // Update the previous item with the new order and add one to it.
                DB::table('news_images')->where([
                    ['sort', $order],
                ])
                    ->update(['sort' => ($order-1)]);

                // Update the selected item sort order.
                DB::table('news_images')->where('id', $images->id)->update(['sort' => $order]);

            }
            //Url::redirect('backoffice/trainer-images/index/'.$parent_id);
            return redirect()->back()->with('status', 'News Images sorted successfully.');

        }else{
            //Url::redirect('backoffice/trainer-images/index/'.$parent_id);
            return redirect()->back()->withErrors('News Images sort failed');
        }
    }
}
