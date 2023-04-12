<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        //$comments = Comment::all();
        $gradebook_id = $request->gradebook_id;
        $comments = Comment::where('gradebook_id', $gradebook_id)->get();

        $comments->each(function ($comment) {
            if($comment->user_id){
                $comment->user_name =  $comment->user->first_name." ".$comment->user->last_name;
            }
        });

        $comments->makeHidden('user');

        return $comments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {
        $comment = Comment::create($request->validated());
        $comment->user_id = $request->user_id;
        $comment->gradebook_id = $request->gradebook_id;
        $comment->save();
        
        $comment->user_name =  $comment->user->first_name." ".$comment->user->last_name;
        
        return response()->json($comment);
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
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
    }
}
