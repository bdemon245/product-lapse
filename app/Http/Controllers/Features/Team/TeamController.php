<?php

namespace App\Http\Controllers\Features\Team;


use App\Models\Invitation;
use App\Services\InvitationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamInvitationRequest;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Invitation::latest()->get();
        return view('features.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('features.team.partials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamInvitationRequest $request)
    {
        // dd($request);
        InvitationService::store($request);
        notify()->success(__('notify/success.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamInvitationRequest $request, Invitation $invitation)
    {
        notify()->success(__('notify/success.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invitation $invitation)
    {
               notify()->success(__('notify/success.delete'));
    }
}
