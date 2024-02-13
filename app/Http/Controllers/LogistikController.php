<?php

namespace App\Http\Controllers;

use App\Models\Logistik;
use App\Http\Requests\StoreLogistikRequest;
use App\Http\Requests\UpdateLogistikRequest;

class LogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('layouts.logistik.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.logistik.insertLogistik');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLogistikRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Logistik $logistik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logistik $logistik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogistikRequest $request, Logistik $logistik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logistik $logistik)
    {
        //
    }
}
