<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\CategoryRepository;

class CategoryController extends Controller
{
    public $categoryRepo;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('auth');
        $this->middleware('permission:view_categories')->only('index');
        $this->middleware('permission:create_category')->only('create','store');
        $this->middleware('permission:show_category')->only('show');
        $this->middleware('permission:edit_category')->only('edit','update','status');
        $this->middleware('permission:destroy_category')->only('destroy');
        $this->categoryRepo = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['breadcrumb'] = [
        'parent_title' => ['Categories'],
        'parent_url' => ['categories'],
        'page_title' => 'Categories',
        'page_items' => ['Dashboard' => '/', 'Categories' => '']
        ];
        if($request->ajax()){
            return $this->categoryRepo->index($request);
        }
        return view('category.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Categories'],
            'parent_url' => [BASE_URL.'categories'],
            'page_title' => 'Category Create',
            'page_items' => ['Dashboard' => '/', 'Categories' => BASE_URL.'category', 'Category Create' => '']
        ];
        return view('category.create')->with($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_name' => ['required', 'string', 'max:255', 'unique:categories'],
            'sort_order' => ['required', 'integer']
            // 'sort_order' => ['required', 'integer', 'max:255','min:1','digits_between: 1,5'],
        ]);

        $category = Category::create([
            'category_name' => $data['category_name'],
            'sort_order' => $data['sort_order'],
        ]);

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Categories'],
            'parent_url' => [BASE_URL.'categories'],
            'page_title' => 'Category Show',
            'page_items' => ['Dashboard' => '/', 'Categories' => BASE_URL.'category', 'Category Show' => '']
        ];
        $category = Category::find($id);
        // dd($category);
        return view('category.show',compact('category'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Categories'],
            'parent_url' => [BASE_URL.'categories'],
            'page_title' => 'Category Edit',
            'page_items' => ['Dashboard' => '/', 'Categories' => BASE_URL.'category', 'Category Edit' => '']
        ];
        $category = Category::find($id);
        return view('category.edit',compact('category'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
            'sort_order' => ['required', 'integer']
            // 'sort_order' => ['required', 'integer', 'max:255','min:1','digits_between: 1,5'],
        ]);

        $category = Category::where('id','=',$id)->update([
            'category_name' => $data['category_name'],
            'sort_order' => $data['sort_order'],
        ]);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->back();
    }

    public function status($id, $status)
    {
        ($status == '1') ? $status = '0' : $status = '1';
        Category::where('id','=',$id)->update(['is_active' => $status]);
        return redirect()->back();
    }
}
