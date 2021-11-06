<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Choice;
use App\Voting;

class ChoiceController extends Controller
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
        
    }

    public function list($id)
    {
        $choicesCollection = collect([]);
        $choices = Choice::where('vote_id',$id)->get();

        foreach ($choices as $choice) {
            $c = [
                'id' => $choice->id,
                'name' => $choice->name,
                'vote_id' => $choice->vote_id,
                'count' => Voting::where('choice_id', $choice->id)->count()
                //'count' => rand(20, 30)
            ];

            $choicesCollection->push($c);
        }

        return response()->json([
            'choices' => $choicesCollection
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $choice = new Choice();

        $choice->name = $request->name;
        $choice->vote_id = $request->vote_id;

        $choice->save();

        return response()->json([
            'message' => 'Successfully created choice!'
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
        $choice = Choice::find($id);

        return response()->json([
            'choice' => $choice
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
        $choice = Choice::find($id);

        $choice->name = $request->name;

        $choice->update();

        return response()->json([
            'message' => 'Successfully updated choice!'
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
        $choice = Choice::find($id);

        $choice->delete();

        return response()->json([
            'message' => 'Successfully deleted choice!'
        ], 201);
    }
}
