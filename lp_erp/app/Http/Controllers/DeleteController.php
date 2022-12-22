<?php

namespace App\Http\Controllers;

use App\Models\Delete;
use App\Repository\DeleteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DeleteController extends Controller
{
    public $deleteRepo;
    public function __construct(DeleteRepository $deleteRepository)
    {
        $this->middleware('auth');
        $this->middleware('permission:view_delete')->only('index');
        $this->middleware('permission:create_delete')->only('create','store');
        $this->middleware('permission:show_delete')->only('show');
        $this->middleware('permission:edit_delete')->only('edit','update','status');
        $this->middleware('permission:destroy_delete')->only('destroy');
        $this->deleteRepo = $deleteRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Deletes'],
            'parent_url' => ['deletes'],
            'page_title' => 'Deletes',
            'page_items' => ['Dashboard' => '/', 'Deletes' => '']
            ];
        if($request->ajax()){
            return $this->deleteRepo->index($request);
        }
        return view('delete.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Deletes'],
            'parent_url' => [BASE_URL.'deletes'],
            'page_title' => 'Delete Create',
            'page_items' => ['Dashboard' => '/', 'Deletes' => BASE_URL.'delete', 'Delete Create' => '']
        ];

        return view('delete.create')->with($data);
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
            'delete_reason_name' => ['required'],
            'sort_order' => ['required', 'integer']
            // 'sort_order' => ['required', 'integer', 'max:255','min:1','digits_between: 1,5'],
        ]);

        $delete = Delete::create([
            'delete_reason_name' => $data['delete_reason_name'],
            'sort_order' => $data['sort_order'],
        ]);

        return redirect()->route('delete.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delete  $delete
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Deletes'],
            'parent_url' => [BASE_URL.'deletes'],
            'page_title' => 'Delete Show',
            'page_items' => ['Dashboard' => '/', 'Deletes' => BASE_URL.'delete', 'Delete Show' => '']
        ];
        $delete = Delete::find($id);
        return view('delete.show',compact('delete'))->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delete  $delete
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['breadcrumb'] = [
            'parent_title' => ['Deletes'],
            'parent_url' => [BASE_URL.'deletes'],
            'page_title' => 'Delete Edit',
            'page_items' => ['Dashboard' => '/', 'Deletes' => BASE_URL.'delete', 'Delete Edit' => '']
        ];
        $delete = Delete::find($id);
        return view('delete.edit',compact('delete'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delete  $delete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'delete_reason_name' => ['required'],
            'sort_order' => ['required', 'integer']
            // 'sort_order' => ['required', 'integer', 'max:255','min:1','digits_between: 1,5'],
        ]);

        $delete = Delete::where('id','=',$id)->update([
            'delete_reason_name' => $data['delete_reason_name'],
            'sort_order' => $data['sort_order'],
        ]);

        return redirect()->route('delete.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delete  $delete
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Delete::destroy($id);
       return redirect()->back();
    }

    public function status($id, $status)
    {
        ($status == '1') ? $status = '0' : $status = '1';
        Delete::where('id','=',$id)->update(['is_active' => $status]);
        return redirect()->back();
    }
}
