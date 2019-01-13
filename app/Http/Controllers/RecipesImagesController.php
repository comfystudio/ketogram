<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\RecipeImage;
use App\Recipe;
use Illuminate\Support\Facades\File;

class RecipesImagesController extends Controller
{
    /**
     * PAGE: Admin/Recipes-Images/
     * GET: /admin/recipes-images/
     * This method handles the index view of Recipes Images
     * @param Recipes $recipes
     * @return
     */
    public function admin_index(Recipe $recipes){
        $meta = array(
            'title' => 'Recipes Images Index',
            'description' => 'Recipes Images index',
            'section' => 'Recipes',
            'subSection' => 'Recipes'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $images = $recipes->recipesImages()->where('image', 'like', '%'.$_GET['keywords'].'%')
                ->orWhere('title', 'like', '%'.$_GET['keywords'].'%')
                ->orderBy('sort', 'ASC')
                ->paginate(20);
        }else{
            $images = $recipes->recipesImages()->orderBy('sort', 'ASC')->paginate(20);
        }
        return view('recipes_images/admin/index', compact('images', 'meta', 'recipes'));
    }

    /**
     * PAGE: Admin/Recipes-Images/Create
     * GET: /admin/recipes-images/create
     * This method handles the creation view of Recipes Images
     * @param Recipes $recipes
     * @return
     */
    public function admin_createShow(Recipe $recipes){
        $meta = array(
            'title' => 'Recipes Images Index',
            'description' => 'Recipes Images index',
            'section' => 'Recipes',
            'subSection' => 'Recipes'
        );

        return view('recipes_images/admin/create', compact('meta', 'recipes'));
    }

    /**
     * PAGE: Admin/Recipes-Images/Create
     * POST: /admin/recipes-images/create
     * This method handles the creation of Recipes Images
     * @param Request $request Recipes $recipes
     * @return
     */
    public function admin_create(Recipe $recipes, Request $request){
        $this->validate($request, [
            'title' => 'max:255',
            'image' => 'required',
            'is_active' => 'Integer'
        ]);

        //finding the largest sort value so we can increment this to the end
        $count = DB::table('recipe_images')->where('recipe_id', $recipes->id)->max('sort');
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
        RecipeImage::create(array(
                'title' => $request->title,
                'sort' => $count,
                'recipe_id' => $recipes->id,
                'image' => $path,
                'is_active' => $request->is_active
            )
        );

        return redirect('/admin/recipes-images/'.$recipes->id)->with('status', 'Recipes Images added successfully.');
    }

    /**
     * PAGE: Admin/Recipes-Images/Delete
     * GET: /admin/recipes-images/delete
     * This method handles the deletion view of Recipes Images
     * @param Recipes $recipes Recipes Images $images
     * @return
     */
    public function admin_deleteShow(Recipe $recipes, RecipeImage $images){
        $meta = array(
            'title' => 'Recipes Images Delete',
            'description' => 'Recipes Images Delete',
            'section' => 'Recipes',
            'subSection' => 'Recipes'
        );

        return view('recipes_images/admin/delete', compact('meta', 'images', 'recipes'));
    }

    /**
     * PAGE: Admin/Recipes-Images/Delete
     * POST: /admin/recipes-images/delete
     * This method handles the deletion view of Recipes Images
     * @param Recipes $recipes RecipesImage $images
     * @return
     */
    public function admin_delete(Recipe $recipes, RecipeImage $images){
        $images->delete();
        File::delete($images->image);

        return redirect('/admin/recipes-images/'.$recipes->id)->with('status', 'Recipes Images deleted successfully.');
    }

    /**
     * PAGE: Admin/Recipes-Images/edit
     * GET: /admin/recipes-images/edit
     * This method handles the edit view of Recipes Images
     * @param Recipes $recipes, RecipesImage $images
     * @return
     */
    public function admin_editShow(Recipe $recipes, RecipeImage $images){
        $meta = array(
            'title' => 'Recipes Images Edit',
            'description' => 'Recipes Images edit',
            'section' => 'Recipes',
            'subSection' => 'Recipes'
        );

        return view('recipes_images/admin/create', compact('meta', 'images', 'recipes'));
    }

    /**
     * PAGE: Admin/Recipes-Images/edit
     * POST: /admin/recipes-images/edit
     * This method handles the editing of Recipes Images
     * @param Request $request RecipesImage $images
     * @return
     */
    public function admin_edit(Recipe $recipes, Request $request, RecipeImage $images){
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
        return redirect('/admin/recipes-images/'.$recipes->id)->with('status', 'Recipes Images Edited successfully.');
    }

    /**
     * PAGE: Admin/Recipes-Images/download
     * GET: /admin/recipes-images/download
     * This method handles the download of Recipes Images
     * @param Recipes $recipesRecipesImage $images
     * @return
     */
    public function admin_download(Recipe $recipes, RecipeImage $images){
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
     * PAGE: recipes-images types sort
     * GET: /admin/recipes-images/{recipes}/sort/:direction/{recipes-images}
     * This method handles the sorting of recipes-images
     * @param string $direction, int $id
     */
    public function admin_sort(Recipe $recipes, $direction = null, RecipeImage $images, $sort){
        if(!empty($images->id)){
            if($direction == 'up'){
                $order = $sort-1;
                // Make sure we don't move below 0
                if($order < 0){
                    $order = 0;
                }

                // Update the previous item with the new order and add one to it.
                DB::table('recipe_images')->where([
                    ['sort', $order],
                ])
                    ->update(['sort' => ($order+1)]);


                // Update the selected item sort order.
                DB::table('recipe_images')->where('id', $images->id)->update(['sort' => $order]);


            }elseif($direction == 'down'){
                $order = $sort+1;

                // Update the previous item with the new order and add one to it.
                DB::table('recipe_images')->where([
                    ['sort', $order],
                ])
                    ->update(['sort' => ($order-1)]);

                // Update the selected item sort order.
                DB::table('recipe_images')->where('id', $images->id)->update(['sort' => $order]);

            }
            //Url::redirect('backoffice/trainer-images/index/'.$parent_id);
            return redirect()->back()->with('status', 'Recipes Images sorted successfully.');

        }else{
            //Url::redirect('backoffice/trainer-images/index/'.$parent_id);
            return redirect()->back()->withErrors('Recipes Images sort failed');
        }
    }
}
