<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserAcitivityRequest;
use App\Http\Requests\UpdateUserAcitivityRequest;
use App\Models\UserAcitivity;

class UserAcitivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAcitivityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserAcitivity $userAcitivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAcitivity $userAcitivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAcitivityRequest $request, UserAcitivity $userAcitivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAcitivity $userAcitivity)
    {
        //
    }
}
