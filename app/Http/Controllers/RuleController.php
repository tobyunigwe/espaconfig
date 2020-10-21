<?php

namespace App\Http\Controllers;

use App\Http\Resources\RuleResource;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $rules = Rule::with([''])->paginate(50);
//        return RuleResource::collection($rules);

                $rules = Rule::all();

        //return collection of configs as a resource
        return RuleResource::collection($rules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = new Rule();
        $rule->name = $request->name;

        if ($rule->save()) {
            return new RuleResource($rule);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get espa
        $rule = Rule::findorfail($id);
        //return a single espa as a resource
        return new RuleResource($rule);
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
        $rule = Rule::findorfail($id);
        $rule->name = $request->name;
        if ($rule->save()) {
            return new RuleResource($rule);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get config
        $rule = Rule::findorfail($id);

        if ($rule->delete()) {
            return new RuleResource($rule);
        }
    }
}
