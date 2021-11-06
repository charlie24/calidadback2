<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\Choice;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $vote = new Vote();

        $vote->name = $request->name;
        $vote->description = $request->description;

        $vote->save();

        $choice_yes = new Choice();

        $choice_yes->name = 'Si';
        $choice_yes->vote_id = $vote->id;
        $choice_yes->save();

        $choice_no = new Choice();

        $choice_no->name = 'No';
        $choice_no->vote_id = $vote->id;
        $choice_no->save();

        return response()->json([
            'message' => 'Successfully created vote!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vote = Vote::find($id);

        return response()->json([
            'vote' => $vote
        ], 201);
    }

    public function list()
    {
        $votes = Vote::all();

        return response()->json([
            'votes' => $votes
        ], 201);
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
        $vote = Vote::find($id);

        $vote->name = $request->name;
        $vote->description = $request->description;
        $vote->available = $request->available;

        $vote->update();

        return response()->json([
            'message' => 'Successfully updated vote!'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vote = Vote::find($id);

        $vote->delete();

        return response()->json([
            'message' => 'Successfully deleted vote!'
        ], 201);
    }
}
