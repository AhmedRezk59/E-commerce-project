<?php

namespace App\Http\Controllers\Color;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureAdminIsSuper;
use App\Http\Requests\Color\StoreColorRequest;
use App\Http\Requests\Color\UpdateColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
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
        $colors = Color::orderBy('id' , 'desc')->select('id','name_ar', 'name_en', 'color')->get();


        return response($colors, 200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreColorRequest $request)
    {

        Color::create($request->validated());

        return response('Color Added successfully', 201);
    }

    public function show()
    {
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
    public function update(UpdateColorRequest $request, $id)
    {
        Color::whereId($id)->update($request->validated());

        return response('Color updated successfully', 201);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Color::find($id)->delete();

        return response('Color deleted successfully', 200);
    }

    public function multi_delete(Request $request)
    {
        foreach ($request->checkedRows as $rowId) {

            Color::find($rowId)->delete();
        }
        return response("Checked Rows deleted successfully", 200);
    }
}
