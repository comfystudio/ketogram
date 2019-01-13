<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoriesController extends Controller
{
    /**
     * PAGE: Admin/Categories/
     * GET: /admin/categories/
     * This method handles the index view of Categories
     * @param
     * @return
     */
    public function admin_index(){
        $meta = array(
            'title' => 'Categories Index',
            'description' => 'Categories index',
            'section' => 'News',
            'subSection' => 'Categories'
        );
        if(isset($_GET['keywords']) && !empty($_GET['keywords'])){
            $categories = Category::where('name', 'like', '%'.$_GET['keywords'].'%')
                ->orderBy('created_at', 'ASC')
                ->paginate(20);
        }else{
            $categories = Category::paginate(20);
        }
        return view('categories/admin/index', compact('categories', 'meta'));
    }

    /**
     * PAGE: Admin/Categories/Create
     * GET: /admin/categories/create
     * This method handles the creation view of Categories
     * @param
     * @return
     */
    public function admin_createShow(){
        $meta = array(
            'title' => 'Categories Index',
            'description' => 'Categories index',
            'section' => 'News',
            'subSection' => 'Categories'
        );

        return view('categories/admin/create', compact('meta', 'categories'));
    }

    /**
     * PAGE: Admin/Categories/Create
     * POST: /admin/categories/create
     * This method handles the creation of Categories
     * @param Request $request
     * @return
     */
    public function admin_create(Request $request){
        $this->validate($request, [
            'name' => array('required','unique:categories', 'max:255'),
            'is_active' => 'Integer'
        ]);


        Category::create(array(
                'name' => $request->name,
                'is_active' => $request->is_active
            )
        );

        return redirect('/admin/categories/')->with('status', 'Categories added successfully.');
    }

    /**
     * PAGE: Admin/Categories/Delete
     * GET: /admin/categories/delete
     * This method handles the deletion view of Categories
     * @param Categories $categories
     * @return
     */
    public function admin_deleteShow(Category $categories){
        $meta = array(
            'title' => 'Categories Delete',
            'description' => 'Categories Delete',
            'section' => 'News',
            'subSection' => 'Categories'
        );

        return view('categories/admin/delete', compact('meta', 'categories'));
    }

    /**
     * PAGE: Admin/Categories/Delete
     * POST: /admin/categories/delete
     * This method handles the deletion view of Categories
     * @param Category $categories
     * @return
     */
    public function admin_delete(Category $categories){
        $categories->delete();

        return redirect('/admin/categories/')->with('status', 'Categories deleted successfully.');
    }

    /**
     * PAGE: Admin/Categories/edit
     * GET: /admin/categories/edit
     * This method handles the edit view of Categories
     * @param Category $categories
     * @return
     */
    public function admin_editShow(Category $categories){
        $meta = array(
            'title' => 'Categories Edit',
            'description' => 'Categories edit',
            'section' => 'News',
            'subSection' => 'Categories'
        );

        return view('categories/admin/create', compact('meta', 'categories'));
    }

    /**
     * PAGE: Admin/Categories/edit
     * POST: /admin/categories/edit
     * This method handles the editing of Categories
     * @param Request $request Category $categories
     * @return
     */
    public function admin_edit(Request $request, Category $categories){
        $this->validate($request, [
            'name' => array('required','unique:categories,name,'.$categories->id, 'max:255'),
            'is_active' => 'Integer'
        ]);

        $input = array(
            'name' => $request->name,
            'is_active' => $request->is_active
        );

        $categories->update($input);
        return redirect('/admin/categories/')->with('status', 'Categories Edited successfully.');
    }
}
