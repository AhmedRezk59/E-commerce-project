<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureAdminIsSuper;
use App\Http\Requests\Admin\RegisterAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(EnsureAdminIsSuper::class)->except('index');        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            Admin::orderBy('id', 'desc')->select('id', 'name', 'is_super','email', 'created_at', 'updated_at')->get(),
            200
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterAdminRequest $request)
    {
        Admin::create($request->validated());

        return response('Admin Added successfully', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        Admin::whereId($id)->update($request->validated());
        return response('Admin updated successfully', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        return response('Admin deleted successfully', 200);
    }


    public function multi_delete(Request $request)
    {
        foreach ($request->checkedRows as $rowId) {
            Admin::find($rowId)->delete();
        }
        return response("Checked Rows deleted successfully", 200);
    }
}
