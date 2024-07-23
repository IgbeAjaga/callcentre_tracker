<?php

namespace App\Http\Controllers;

use App\Models\Outgoingcalls;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\OutgoingStoreRequest;
use App\Exports\OutgoingCallsExport;
use App\Http\Requests\OutgoingUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;

class OutgoingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outgoingcalls = Outgoingcalls::latest()->paginate(1000);
          
        return view('alloutgoing', compact('outgoingcalls'))
                    ->with('i', (request()->input('page', 1) - 1) * 1000);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
{
    $request->validate([
        'branchthatcalled' => 'required|string',
        'drug' => 'required|string',
        'response' => 'required|string',
        'branchcalled' => 'required|array',
        'branchcalled.*' => 'string',
    ]);

    $branchesCalled = $request->input('branchcalled');

    foreach ($branchesCalled as $branch) {
        OutgoingCalls::create([
            'branchthatcalled' => $request->input('branchthatcalled'),
            'drug' => $request->input('drug'),
            'response' => $request->input('response'),
            'branchcalled' => $branch,
        ]);
    }

    return redirect()->route('create')
                     ->with('success', 'Outgoing call report created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Outgoingcalls $outgoingcall)
    {
        return view('show',compact('outgoingcall'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outgoingcalls $outgoingcall)
    {
        return view('edit',compact('outgoingcall'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OutgoingUpdateRequest $request, Outgoingcalls $outgoingcall): RedirectResponse
    {
        $outgoingcall->update($request->validated());
          
        return redirect()->route('alloutgoing')
                        ->with('success','Report updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outgoingcalls $outgoingcall)
    {
        $outgoingcall->delete();
           
        return redirect()->route('alloutgoing')
                        ->with('success','Outgoing calls deleted successfully');
    }

    /**
 * Show the form for creating a new resource.
 */

/**
 * Search the products based on various criteria.
 */
public function search(Request $request): \Illuminate\Contracts\View\View
    {
        $query = Outgoingcalls::query();

        if ($request->filled('branchcalled')) {
            $query->where('branchcalled', 'like', '%' . $request->branchcalled . '%');
        }

        if ($request->filled('branchthatcalled')) {
            $query->where('branchthatcalled', 'like', '%' . $request->branchthatcalled . '%');
        }

        if ($request->filled('drug')) {
            $query->where('drug', 'like', '%' . $request->drug . '%');
        }

        if ($request->filled('response')) {
            $query->where('response', $request->response);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('time_from')) {
            $query->whereTime('created_at', '>=', $request->input('time_from'));
        }
    
        if ($request->filled('time_to')) {
            $query->whereTime('created_at', '<=', $request->input('time_to'));
        }
    

        $outgoingcalls = $query->paginate(1000);

        // Prepare the aggregated data for the table
        $drugData = [];
        foreach ($outgoingcalls as $call) {
            $drug = $call->drug;
            $branch = $call->branchcalled;
            
            if (!isset($drugData[$drug])) {
                $drugData[$drug] = [
                    'Asokoro' => 0, 'Gana' => 0, 'Gimbiya' => 0, 'Gwarinpa 1' => 0,
                    'Gwarinpa 2' => 0, 'Gwarinpa 3' => 0, 'Guzape' => 0, 'New Ademola' => 0,  'New Garki' => 0, 'New Wuse' => 0, 
                     'Old Ademola' => 0,    'Omega' => 0,  'Wholesale' => 0
                ];
            }

            if (array_key_exists($branch, $drugData[$drug])) {
                $drugData[$drug][$branch]++;
            }
        }

        return view('search', compact('outgoingcalls', 'drugData'))->with('i', (request()->input('page', 1) - 1) * 1000);
    }

    
    
    public function export()
    {
        return Excel::download(new OutgoingCallsExport, 'outgoing_calls.xlsx');
    }
    
    
}

