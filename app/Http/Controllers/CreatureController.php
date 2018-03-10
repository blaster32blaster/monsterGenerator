<?php

namespace App\Http\Controllers;

use App\Creature;
use App\Torso;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
    /**
     * @var Creature
     */
    protected $creature;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Creature::all(), 200);
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
        $this->creature = new Creature();
        $locomotion = 'bipedal';
        $this->creature->locomotion = $locomotion;
        $this->creature->save();
        $this->creature->torso = $this->createCreatureTorso();
//        @todo : create methods for adding lower / upper torso
//        @todo : create methods for top/bottom front/back
//        @todo : determine the method by which the different values will impact attributes or add modifiers
        return response($this->creature, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return response(Creature::find($request->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
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

    /**
     * This is for the creatures main body area
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function createCreatureTorso()
    {
        $torso = new Torso();
        $torso->color = $torso->getRandomColor();
        $torso->covering = $torso->getRandomCovering();
        $torso->pattern = $torso->getRandomPattern();
        $this->creature->torso()->save($torso);
        return $this->creature->torso()->get();
    }

    /**
     * This is for the creatures upper torso, shoulder area
     */
    private function createCreatureUpperTorso()
    {

    }

    /**
     * This is for the creatures lower torso, pelvic area
     */
    private function createCreatureLowerTorso()
    {

    }

    /**
     * This is for the bottom middle of the torso, tail etc...
     */
    private function createCreatureBottom()
    {

    }

    /**
     * This is for the top middle of the torso, head area
     */
    private function createCreatureTop()
    {

    }

    /**
     * This is for the creatures front facing side
     */
    private function createCreatureFront()
    {

    }

    /**
     * This is for the creatures backward facing side
     */
    private function createCreatureBack()
    {

    }
}
