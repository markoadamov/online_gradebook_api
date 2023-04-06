<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGradebookRequest;
use App\Models\Gradebook;
use Illuminate\Http\Request;

class GradebooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        // $per_page = $request->query('per_page', 1000);
        // $gradebooks = Gradebook::paginate($per_page);
      
        $gradebooks = Gradebook::all();
        return $gradebooks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGradebookRequest $request)
    {
        $gradebook = Gradebook::create($request->validated());
        return response()->json($gradebook);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $gradebook = Gradebook::findOrFail($id);
        return response()->json($gradebook);
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
        $gradebook = Gradebook::findOrFail($id);
        $gradebook->update($request->validated());
        return response()->json($gradebook);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $gradebook = Gradebook::findOrFail($id);
        $gradebook->delete();
    }
}
