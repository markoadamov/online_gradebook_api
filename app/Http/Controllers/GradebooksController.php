<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGradebookRequest;
use App\Models\Gradebook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradebooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $per_page = $request->query('per_page', 10);
        $filterTerm = $request->query('filter', '');

        $gradebooks = Gradebook::searchByTerm($filterTerm)->paginate($per_page);

        $gradebooks->each(function ($gradebook) {
            if($gradebook->user_id){
                $gradebook->user_name = $gradebook->user->first_name . ' ' . $gradebook->user->last_name;
            }
        });
        
        $gradebooks->makeHidden('user'); // Ovo sam dodao jer mi je bez ovoga u svaki gradebook objekat dodavao property user sa svim vrednostima koje karakterisu user-a (tj. profesora), a ne zelim to da saljem na front.

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
        if ($request->user_id) {
            $gradebook->user_id = $request->user_id;
            $gradebook->user->gradebook_id = $gradebook->id;
            $gradebook->user->save();
        }
        $gradebook->save();
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

            if($gradebook->user_id){
                $gradebook->user_name = $gradebook->user->first_name . ' ' . $gradebook->user->last_name;
            }

            if($gradebook->students){
                $gradebook->class_students = $gradebook->students;
            }
            else
            {
                $gradebook->class_students = [];
            }
        
        $gradebook->makeHidden('students');
        $gradebook->makeHidden('user');

        return response()->json($gradebook);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateGradebookRequest $request, $id)
    {
        $validatedData = $request->validated();

        $gradebook = Gradebook::findOrFail($id);
        $user = User::findOrFail($request->user_id);
        
        if(($gradebook->user->id !== $request->user_id) && !empty($request->validated()))
        {
            $gradebook->user->gradebook_id = null;
            $gradebook->user->save();
            $gradebook->user_id = $request->user_id;
            $gradebook->save();
            
            $user->gradebook_id = $gradebook->id;
            $user->save();
        }
        else
        {
            $gradebook->update($validatedData);
        }
        
        
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
        $gradebook->user->gradebook_id = null;
        $gradebook->user->save();
        $gradebook->delete();
    }
}
