<?php

namespace App\Http\Controllers\Weight;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureAdminIsSuper;
use App\Http\Requests\Weight\StoreWeightRequest;
use App\Http\Requests\Weight\UpdateWeightRequest;
use App\Models\Weight;
use Illuminate\Http\Request;

class WeightController extends Controller
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
        $weights = Weight::orderBy('id' ,'desc')->select('id','name_ar', 'name_en')->get();


        return response($weights, 200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWeightRequest $request)
    {

        Weight::create($request->validated());

        return response('Weight Added successfully', 201);
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
    public function update(UpdateWeightRequest $request, $id)
    {
        Weight::whereId($id)->update($request->validated());

        return response('Weight updated successfully', 201);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Weight::find($id)->delete();

        return response('Weight deleted successfully', 200);
    }

    public function multi_delete(Request $request)
    {
        foreach ($request->checkedRows as $rowId) {

            Weight::find($rowId)->delete();
        }
        return response("Checked Rows deleted successfully", 200);
    }
}
