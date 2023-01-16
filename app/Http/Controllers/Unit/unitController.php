<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;

class unitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $units = Unit::latest()->get();

        return view('backend.unit.units_all')->with('units',$units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.unit.unit_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name'=> 'required|regex:/(^[A-Za-z0-9 ]+$)+/|unique:units,name',
            
        ]);

        $unit = new Unit();
         
        $unit->name = $request->name;
        $unit->created_by = Auth::user()->id;
         // default 1 otherwise 0
        if($request->status == 0){ $unit->status =0;}

        $unit->save();

        $notification = array(
            'message' => 'Unit added Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);
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
        //
        $unit = Unit::findOrFail($id);

        return view('backend.unit.unit_edit')->with('unit',$unit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name'=> 'required|regex:/(^[A-Za-z0-9 ]+$)+/',

        ]);

        $unit = Unit::findorFail($id);

        $unit->name =$request->name;
        $unit->status =(is_null($request->status) ? 0:1);
        $unit->updated_by = Auth::user()->id;



        $unit->save();

        $notification = array(
            'message' => 'unit updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $unit = Unit::findorFail($id);

        $unit->delete();

        $notification = array(
            'message' => 'Unit deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);
    }
}
