<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use App\Services\Invoices;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request, Invoices $invoiceService)
    {
        $locationID = $request->get('location_id');

        // Get all our locations to pass for filters
        $allLocations = Locations::all();

        $statusTotal = $invoiceService->getTotalForLocationByStatus($locationID);

        return view('locations')
            ->with('filterLocation', $locationID)
            ->with('allLocations', $allLocations)
            ->with('statusTotals', $statusTotal);
    }
}
