<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureAdminIsSuper;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Resources\Department\DataTree;
use App\Models\Department;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{

    private $children = [];

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
        $unOrganizedDepartments = DataTree::collection(Department::select('id', 'name_ar', 'description', 'keyword', 'name_en', 'parent')->get());

        return response($unOrganizedDepartments, 200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());

        return response('Department Added successfully', 201);
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
    public function update(UpdateDepartmentRequest $request, $id)
    {
        $this->getChildren($request->parent);
        if (in_array((int) $request->parent, $this->children)) {
            throw ValidationException::withMessages(['parent' => 'please do not choose a child department']);
        }
        Department::whereId($id)->update($request->validated());

        return response('Department updated successfully', 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::find($id)->delete();
        return response('Department deleted successfully', 200);
    }

    public function getChildren($id)
    {
        array_push($this->children, (int) $id);
        $departments = Department::where('parent', $id)->get();
        foreach ($departments as $d) {
            $this->getChildren($d->id);
        }
    }
}
