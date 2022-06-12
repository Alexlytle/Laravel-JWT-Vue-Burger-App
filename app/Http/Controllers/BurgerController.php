<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\SubmitBuger;
use Illuminate\Http\Request;
use App\Mail\CustomerAdminMail;
use App\Mail\CustomerOrderMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreBurgerRequest;
use App\Http\Requests\UpdateBurgerRequest;

class BurgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Burger $burger)
    {
        return $burger;
    }   

    public function each(Request $request)
    {
        $builder = Burger::find($request->id);
         if(auth()->user()->id === $builder->user_id){
                return $builder;
           }
           
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBurgerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'burger' => 'required',
            'burger_name' => 'required',
        ]);
        return Burger::create([
            'user_id'=> auth()->user()->id,
            'burger'=>$request->burger,
            'burger_name'=>$request->burger_name
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Burger  $burger
     * @return \Illuminate\Http\Response
     */
    public function show(Burger $burger)
    {
        return auth()->user();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Burger  $burger
     * @return \Illuminate\Http\Response
     */
    public function edit(Burger $burger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBurgerRequest  $request
     * @param  \App\Models\Burger  $burger
     * @return \Illuminate\Http\Response
     */
    public function update(Burger $burger,Request $request)
    {

        $burger->update($request->all());
        return $burger;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Burger  $burger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Burger $burger)
    {
        //
    }

    public function user()
    {
        return 'hello';
    }

    public function submitBurger(Request $request)
    {

        $request->validate([
            'email' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|numeric|digits:10',
            'zip' => 'required|numeric|digits:5',
            'city' => 'required|string',
        ]);
        Mail::to('alex.joe.lytle@gmail.com')->send(new CustomerAdminMail($request->name,$request->email,$request->phone,$request->zip,$request->city,json_encode($request->burger_data)));

        Mail::to($request->email)->send(new CustomerOrderMail($request->name,$request->email,$request->phone,$request->zip,$request->city,json_encode($request->burger_data)));
        SubmitBuger::create($request->all());
    }
}
