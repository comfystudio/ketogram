<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodCategory;
use DB;

class FoodCategoriesController extends Controller
{
    /**
     * PAGE: Admin/FoodCategories/
     * GET: /admin/food_categories/
     * This method handles the index view of Categories
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'Food Categories Index',
            'description' => 'Food Categories index',
            'section' => 'Item',
            'subSection' => 'Food Categories'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $categories = FoodCategory::where('name', 'like', '%'.$_GET['keywords'].'%')
                ->orderBy('created_at', 'ASC')
                ->paginate(20);
        }else{
            $categories = FoodCategory::paginate(20);
        }
        return view('food_categories/admin/index', compact('categories', 'meta'));
    }

    /**
     * PAGE: Admin/FoodCategories/Create
     * GET: /admin/food_categories/create
     * This method handles the creation view of Categories
     * @param
     * @return
     */
    public function admin_createShow(){
        $meta = array(
            'title' => 'Food Categories Index',
            'description' => 'Food Categories index',
            'section' => 'Item',
            'subSection' => 'Food Categories'
        );

        return view('food_categories/admin/create', compact('meta', 'categories'));
    }

    /**
     * PAGE: Admin/FoodCategories/Create
     * POST: /admin/food_categories/create
     * This method handles the creation of Categories
     * @param Request $request
     * @return
     */
    public function admin_create(Request $request){
        $this->validate($request, [
            'name' => array('required','unique:food_categories', 'max:255'),
            'is_active' => 'Integer'
        ]);


        FoodCategory::create(array(
                'name' => $request->name,
                'is_active' => $request->is_active
            )
        );

        return redirect('/admin/food_categories/')->with('status', 'Categories added successfully.');
    }

    /**
     * PAGE: Admin/FoodCategories/Delete
     * GET: /admin/food_categories/delete
     * This method handles the deletion view of Categories
     * @param Categories $categories
     * @return
     */
    public function admin_deleteShow(FoodCategory $categories){
        $meta = array(
            'title' => 'Food Categories Index',
            'description' => 'Food Categories index',
            'section' => 'Item',
            'subSection' => 'Food Categories'
        );

        return view('food_categories/admin/delete', compact('meta', 'categories'));
    }

    /**
     * PAGE: Admin/FoodCategories/Delete
     * POST: /admin/food_categories/delete
     * This method handles the deletion view of Categories
     * @param Category $categories
     * @return
     */
    public function admin_delete(FoodCategory $categories){
        $categories->delete();

        return redirect('/admin/food_categories/')->with('status', 'Categories deleted successfully.');
    }

    /**
     * PAGE: Admin/FoodCategories/edit
     * GET: /admin/food_categories/edit
     * This method handles the edit view of Categories
     * @param Category $categories
     * @return
     */
    public function admin_editShow(FoodCategory $categories){
        $meta = array(
            'title' => 'Food Categories Index',
            'description' => 'Food Categories index',
            'section' => 'Item',
            'subSection' => 'Food Categories'
        );

        return view('food_categories/admin/create', compact('meta', 'categories'));
    }

    /**
     * PAGE: Admin/FoodCategories/edit
     * POST: /admin/food_categories/edit
     * This method handles the editing of Categories
     * @param Request $request Category $categories
     * @return
     */
    public function admin_edit(Request $request, FoodCategory $categories){
        $this->validate($request, [
            'name' => array('required','unique:food_categories,name,'.$categories->id, 'max:255'),
            'is_active' => 'Integer'
        ]);

        $input = array(
            'name' => $request->name,
            'is_active' => $request->is_active
        );

        $categories->update($input);
        return redirect('/admin/food_categories/')->with('status', 'Categories Edited successfully.');
    }
}
