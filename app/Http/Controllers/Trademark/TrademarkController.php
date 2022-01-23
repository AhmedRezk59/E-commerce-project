<?php

namespace App\Http\Controllers\Trademark;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureAdminIsSuper;
use App\Http\Requests\Trademark\StoreTradmarkRequest;
use App\Http\Requests\Trademark\UpdateTradmarkLogoRequest;
use App\Http\Requests\Trademark\UpdateTradmarkRequest;
use App\Models\Trademark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrademarkController extends Controller
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
        $trademarks = Trademark::select('id' , 'name' , 'logo' , 'created_at' , 'updated_at')->get();


        return response($trademarks, 200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTradmarkRequest $request)
    {

        Trademark::create([
            'name' => $request->name,
            'logo' => $request->logo->getClientOriginalName(),
        ]);
        if ($request->hasFile('logo')) {
            $country_id = Trademark::latest()->first()->id;

            $imageName = $request->logo->getClientOriginalName();
            $request->file('logo')->storeAs("trademarks/logos/$country_id", $imageName, 'public');
        }
        return response('Tradmark Added successfully', 201);
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
        return response(Trademark::whereId($id)->first(), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTradmarkRequest $request, $id)
    {
        Trademark::whereId($id)->update($request->validated());

        return response('Trademark updated successfully', 201);
    }

    public function update_logo($id, UpdateTradmarkLogoRequest $request)
    {
        Storage::disk('public')->deleteDirectory('/trademarks/logos/' . $id);
        $imageName = $request->logo->getClientOriginalName();
        Trademark::whereId($id)->update([
            'logo' => $imageName,
        ]);
        $request->logo->storeAs("trademarks/logos/$id", $imageName, 'public');
        return response('Logo updated Successfully', 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Trademark::find($id)->delete();
        Storage::disk('public')->deleteDirectory('/trademarks/logos/' . $id);

        return response('Trademark deleted successfully', 200);
    }

    public function multi_delete(Request $request)
    {
        foreach ($request->checkedRows as $rowId) {
            Storage::disk('public')->deleteDirectory('/trademarks/logos/' . $rowId);

            Trademark::find($rowId)->delete();
        }
        return response("Checked Rows deleted successfully", 200);
    }
}
