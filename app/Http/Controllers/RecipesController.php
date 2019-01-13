<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use DB;
use Carbon\Carbon;

class RecipesController extends Controller
{
    /**
     * PAGE: Admin/Recipes/
     * GET: /admin/recipes/
     * This method handles the index view of Recipes
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'Recipes Index',
            'description' => 'Recipes index',
            'section' => 'Recipes',
            'subSection' => 'Recipes'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $recipes = Recipe::where('title', 'like', '%'.$_GET['keywords'].'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(20);
        }else{
            $recipes = Recipe::orderBy('created_at', 'DESC')->paginate(20);
        }
        return view('recipes/admin/index', compact('recipes', 'meta'));
    }

    /**
     * PAGE: Admin/Recipes/Create
     * GET: /admin/recipes/create
     * This method handles the creation view of Recipes
     * @param
     * @return
     */
    public function admin_createShow(){
        $meta = array(
            'title' => 'Recipes Index',
            'description' => 'Recipes index',
            'section' => 'Recipes',
            'subSection' => 'Recipes'
        );

        $categories = DB::table('categories')->where('is_active', 1)->pluck('name', 'id');
        return view('recipes/admin/create', compact('meta', 'categories'));
    }

    /**
     * PAGE: Admin/Recipes/Create
     * POST: /admin/recipes/create
     * This method handles the creation of Recipes
     * @param Request $request
     * @return
     */
    public function admin_create(Request $request){
        $this->validate($request, [
            'title' => array('required','unique:recipes', 'max:255'),
            'category_id' => 'Integer',
            'text' => 'required',
            'publish_date' => 'required|Date',
            'is_active' => 'Integer',
            'sat_fat' => 'numeric',
            'tran_fat' => 'numeric',
            'cholesterol' => 'numeric',
            'salt' => 'numeric',
            'sugar' => 'numeric',
            'polyol' => 'numeric',
        ]);

        $request->merge(array('slug' => $this->FormatUrl($request->title)));
        $recipes = Recipe::create($request->except(['categories', 'save']));

        if($request->has('categories')) {
            $recipes->category()->sync($request->categories);
        }

        return redirect('/admin/recipes/')->with('status', 'Recipes added successfully.');
    }

    /**
     * PAGE: Admin/Recipes/Delete
     * GET: /admin/recipes/delete
     * This method handles the deletion view of Recipes
     * @param Recipes $recipes
     * @return
     */
    public function admin_deleteShow(Recipe $recipes){
        $meta = array(
            'title' => 'Recipes Delete',
            'description' => 'Recipes Delete',
            'section' => 'Recipes',
            'subSection' => 'Recipes'
        );

        return view('recipes/admin/delete', compact('meta', 'recipes'));
    }

    /**
     * PAGE: Admin/Recipes/Delete
     * POST: /admin/recipes/delete
     * This method handles the deletion view of Recipes
     * @param Recipes $recipes
     * @return
     */
    public function admin_delete(Recipe $recipes){
        $recipes->delete();

        return redirect('/admin/recipes/')->with('status', 'Recipes deleted successfully.');
    }

    /**
     * PAGE: Admin/Recipes/edit
     * GET: /admin/recipes/edit
     * This method handles the edit view of Recipes
     * @param Recipes $recipes
     * @return
     */
    public function admin_editShow(Recipe $recipes){
        $meta = array(
            'title' => 'Recipes Edit',
            'description' => 'Recipes edit',
            'section' => 'Recipes',
            'subSection' => 'Recipes'
        );

        if(isset($recipes->category[0]) && !empty($recipes->category[0])) {
            foreach ($recipes->category as $category) {
                $temp['categories'][] = $category->pivot->category_id;
            }
            $recipes->append($temp);
        }

        $categories = DB::table('categories')->where('is_active', 1)->pluck('name', 'id');
        return view('recipes/admin/create', compact('meta', 'recipes', 'categories'));
    }

    /**
     * PAGE: Admin/Recipes/edit
     * POST: /admin/recipes/edit
     * This method handles the editing of Recipes
     * @param Request $request Recipes $recipes
     * @return
     */
    public function admin_edit(Request $request, Recipe $recipes){
        $this->validate($request, [
            'title' => array('required','unique:recipes,title,'.$recipes->id, 'max:50'),
            'category_id' => 'Integer',
            'text' => 'required',
            'publish_date' => 'required|Date',
            'is_active' => 'Integer',
            'sat_fat' => 'numeric',
            'tran_fat' => 'numeric',
            'cholesterol' => 'numeric',
            'salt' => 'numeric',
            'sugar' => 'numeric',
            'polyol' => 'numeric',
        ]);

//        $recipes->update(array(
//                'title' => $request->title,
//                'slug' => $this->FormatUrl($request->title),
//                'text' => $request->text,
//                'publish_date' => $request->publish_date,
//                'is_active' => $request->is_active,
//                'meta_title' => $request->meta_title,
//                'meta_description' => $request->meta_description
//            )
//        );
        $request->merge(array('slug' => $this->FormatUrl($request->title)));
        $recipes->update($request->except(['categories', 'save']));

        if($request->has('categories')) {
            $recipes->category()->sync($request->categories);
        }
        return redirect('/admin/recipes/')->with('status', 'Recipes Edited successfully.');
    }

    /**
     * PAGE: Recipes
     * GET: /recipes
     * This method handles the index view of Recipes
     * @param
     * @return
     */
    public function index(){
//        $testArray = $this->test();
        //pr($cartArray);die;

        $meta = array(
            'title' => 'Ketogram Recipes',
            'description' => 'Recipes Blog, Keto, Ketosis, low carb, UK, Belfast, Recipes',
            'section' => 'Recipe',
            'subSection' => 'Recipe'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])) {
            $recipes = Recipe::where('title', 'like', '%' . $_GET['keywords'] . '%')
                ->where('publish_date', '<',  Carbon::now())
                ->where('is_active', '=', '1')
                ->orderBy('publish_date', 'DESC')
                ->paginate(10);
        }elseif(isset($_GET['category']) && !empty($_GET['category'])){
            $recipes = Recipe::whereHas('category', function($q){
                $q->where('name', '=', $_GET['category']);
                $q->where('publish_date', '<',  Carbon::now());
                $q->where('is_active', '=', '1');
            })
                ->orderBy('publish_date', 'DESC')
                ->paginate(10);
        }else{
            $recipes = Recipe::orderBy('publish_date', 'DESC')->where('publish_date', '<', Carbon::now())->where('is_active', '=', '1')->paginate(10);
        }

        $categories = DB::table('categories')->where('is_active', 1)->pluck('name', 'id');
        return view('recipes/index', compact('recipes', 'meta', 'categories'));
    }

    /**
     * PAGE: Recipes/{{slug}}
     * GET: /recipes/{{slug}}
     * This method handles the view of Recipes
     * @param String $slug
     * @return
     */
    public function view($slug){
        $meta = array(
            'title' => 'Ketogram Recipes',
            'description' => 'Ketogram Recipes, Keto, Ketosis, low carb, UK, Belfast, Recipes',
            'section' => 'Recipe',
            'subSection' => 'Recipe'
        );

        $recipes = Recipe::where('slug', $slug)->first();

        if(isset($recipes->recipesImages[0])) {
            $facebook = array(
                'og:title' => $recipes->title,
                'og:url' => env('APP_URL') . '/recipes/' . $recipes->slug,
                'og:type' => 'Website',
                'og:description' => $recipes->meta_description,
                'og:image' => env('APP_URL') . '/' . $recipes->recipesImages[0]['image']
            );
        }

        //changing the meta title and description if we have some from the data.
        if(isset($recipes) && !empty($recipes)){
            if(isset($recipes->meta_title) && !empty($recipes->meta_description)){
                $meta['title'] = $recipes->meta_title;
            }
            if(isset($recipes->meta_description) && !empty($recipes->meta_description)){
                $meta['description'] = $recipes->meta_description;
            }
        }

        $latestRecipes = Recipe::where('is_active', 1)
            ->orderBy('created_at', 'ASC')
            ->limit(3)
            ->get();

        $categories = DB::table('categories')->where('is_active', 1)->pluck('name', 'id');
        return view('recipes/view', compact('recipes', 'facebook', 'meta', 'categories', 'latestRecipes'));
    }
}
