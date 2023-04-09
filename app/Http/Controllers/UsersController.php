<?php

namespace App\Http\Controllers;

use App\Models\Gradebook;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $per_page = $request->query('per_page', 1000000);
        $filterTerm = $request->query('filter', '');
        $only_free = $request->query('only_free', 0);

        $users = User::searchByName($filterTerm)->searchNotClassTeachers(($only_free))->paginate($per_page);

        $users->each(function ($user) {
            if ($user->gradebook) {
                $user->gradebook_name = $user->gradebook->name;
            }
        });
        
        //$users->makeHidden('user');

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        if($user->gradebook_id){
            $user->gradebook_name = $user->gradebook->name;
            $user->students_count = count($user->gradebook->students)?count($user->gradebook->students):0;
        }

        return response()->json($user);
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
    }
}
