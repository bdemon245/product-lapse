<?php

namespace App\Http\Controllers\Features\Change;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeRequest;
use App\Models\Change;
use App\Models\Product;
use App\Models\Select;
use Illuminate\Http\Request;
use App\Services\SearchService;
use App\Http\Requests\SearchRequest;

class ChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $changes = Product::find(productId())->changeManagements()->paginate(10);
        return view('features.change.index', compact('changes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $priority = Select::of('change')->type('priority')->get();
        $status = Select::of('change')->type('status')->get();
        $classification = Select::of('change')->type('classification')->get();
        return view('features.change.partials.create', compact('priority', 'status', 'classification'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChangeRequest $request)
    {
        $data = $request->except('_token');
        $data['owner_id'] = ownerId();

        $change = Change::create($data);

        if (!$change) {
            notify()->success(__('Create failed!'));
            return redirect()->route('change.index');
        }

        notify()->success(__('Created successfully!'));
        return redirect()->route('change.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Change $change)
    {
        return view('features.change.partials.show', compact('change'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Change $change)
    {
        $priority = Select::of('change')->type('priority')->get();
        $status = Select::of('change')->type('status')->get();
        $classification = Select::of('change')->type('classification')->get();

        return view('features.change.partials.edit', compact('change', 'priority', 'status', 'classification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChangeRequest $request, Change $change)
    {
        $data = $request->except('_token', '_method');
        $data['owner_id'] = ownerId();
        $change->update($data);

        notify()->success(__('Update success!'));
        return redirect()->route('change.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Change $change)
    {
        $change->delete();

        notify()->success(__('Delete success!'));
        return redirect()->route('change.index');
    }
    public function search(SearchRequest $request)
    {
        $changes = SearchService::items($request);
        return view('features.change.index', compact('changes'));
    }
}
