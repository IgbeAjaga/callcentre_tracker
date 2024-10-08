<?php

namespace App\Http\Controllers;

use App\Models\Incomingcalls;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\IncomingStoreRequest;
use App\Exports\IncomingCallsExport;
use App\Http\Requests\IncomingUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;

class IncomingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomingcalls = Incomingcalls::latest()->get();
          
    return view('allincoming', compact('incomingcalls'));;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addincoming');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branchcalled' => 'required|string',
            'drug' => 'required|string',
            'response' => 'required|string',
            'branchthatcalled' => 'required|array',
            'branchthatcalled.*' => 'string',
        ]);
    
        $branchesthatCalled = $request->input('branchthatcalled');
    
        // Save the record for the selected branchcalled
        IncomingCalls::create([
            'branchcalled' => $request->input('branchcalled'),
            'drug' => $request->input('drug'),
            'response' => $request->input('response'),
            'branchthatcalled' => $request->input('branchcalled'),
        ]);
    
        // Save the records for each of the branchthatcalled with "out_of_stock" response
        foreach ($branchesthatCalled as $branch) {
            IncomingCalls::create([
                'branchcalled' => $request->input('branchcalled'),
                'drug' => $request->input('drug'),
                'response' => 'out_of_stock',
                'branchthatcalled' => $branch,
            ]);
        }
    
        return redirect()->route('addincoming')
                         ->with('success', 'Incoming call reported successfully.');
    }
    


   /**
     * Display the specified resource.
     */
    public function show(Incomingcalls $incomingcall)
    {
        return view('showin',compact('incomingcall'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Incomingcalls $incomingcall)
    {
        return view('editin',compact('incomingcall'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IncomingUpdateRequest $request, Incomingcalls $incomingcall): RedirectResponse
    {
        $incomingcall->update($request->validated());
          
        return redirect()->route('allincoming')
                        ->with('success','Report updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incomingcalls $incomingcall)
    {
        $incomingcall->delete();
           
        return redirect()->route('allincoming')
                        ->with('success','Incoming calls deleted successfully');
    }
     /**
     * Show the form for creating a new resource.
     */
  
    /**
     * Search the products based on various criteria.
     */
    public function search(Request $request): \Illuminate\Contracts\View\View
    {
        $query = Incomingcalls::query();
    
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
    
        $incomingcalls = $query->get(); // Retrieve all records without pagination
    
        // Prepare the aggregated data for the table
        $drugData = [];
        foreach ($incomingcalls as $call) {
            $drug = $call->drug;
            $branch = $call->branchthatcalled;
    
            if (!isset($drugData[$drug])) {
                $drugData[$drug] = [
                    'Asokoro' => 0, 'Gana' => 0, 'Gimbiya' => 0, 'Gwarinpa 1' => 0,
                    'Gwarinpa 2' => 0, 'Gwarinpa 3' => 0, 'Guzape' => 0, 'New Ademola' => 0,  
                    'New Garki' => 0, 'New Wuse' => 0, 'Old Ademola' => 0, 'Omega' => 0
                ];
            }
    
            if (array_key_exists($branch, $drugData[$drug])) {
                $drugData[$drug][$branch]++;
            }
        }
    
        // Store the search results in the session
        session(['search_result' => $incomingcalls]);
    
        return view('searchin', compact('incomingcalls', 'drugData'));
    }
    
    public function export()
    {
        return Excel::download(new IncomingCallsExport, 'incoming_calls.xlsx');
    }

    public function getPositiveRecord()
{
    // Retrieve search results from the session
    $incomingcalls = session('search_result');
    
    // Prepare the aggregated data for filtering
    $positiveDrugData = [];
    foreach ($incomingcalls as $call) {
        $drug = $call->drug;
        $branch = $call->branchcalled;

        if (!isset($positiveDrugData[$drug])) {
            $positiveDrugData[$drug] = [
                'Asokoro' => 0, 'Gana' => 0, 'Gimbiya' => 0, 'Gwarinpa 1' => 0,
                'Gwarinpa 2' => 0, 'Gwarinpa 3' => 0, 'Guzape' => 0, 'New Ademola' => 0,  
                'New Garki' => 0, 'New Wuse' => 0, 'Old Ademola' => 0, 'Omega' => 0
            ];
        }

        if (array_key_exists($branch, $positiveDrugData[$drug])) {
            $positiveDrugData[$drug][$branch]++;
        }
    }

    // Filter drugs where all branches have values greater than zero
    $filteredData = [];
    foreach ($positiveDrugData as $drug => $branches) {
        if (min($branches) > 0) {
            $filteredData[$drug] = $branches;
        }
    }

    return view('positive_records_in', compact('filteredData'));
}
    
    
}

