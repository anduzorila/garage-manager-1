<?php

namespace App\Http\Controllers;

use DB;
use App\Car;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Redirect;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();

        return view('cars.index', ['cars' => $cars, 'count' => Car::count()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create', [] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        Car::create( $input );

        return Redirect::route('cars.index')->with('message', 'Car added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //var_dump($car->repairs->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Car $car)
    {
        $input = array_except(Input::all(), ['_method']);

        $car->update( $input );


        return Redirect::route('cars.index')->with('message', 'Car updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        if ($car->repairs->count() == 0)
        {
            $car->delete();
            return Redirect::route('cars.index')->with('message', 'Car deleted');
        }

        return Redirect::route('cars.index')->with('message', 'Car NOT deleted; delete the associated cars first');
    }
}
