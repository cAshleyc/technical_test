<?php

namespace App\Http\Controllers;

use App\Models\InvoiceHeaders;
use App\Models\Locations;
use App\Services\Invoices;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request, Invoices $invoiceService)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $status = $request->get('status');
        $locationID = $request->get('location_id');

        // Check our start and end date are the correct way around (If they are NOT the same!)
        if (!is_null($startDate) && !is_null($endDate) && $startDate != $endDate) {
            $request->validate([
                'start_date' => 'before:end_date',
                'end_date' => 'after:start_date'
            ]);
        }

        $invoices = $invoiceService->filterInvoices($startDate, $endDate, $status, $locationID);

        // Get all our status' to pass for filters
        $allStatus = InvoiceHeaders::ALL_STATUSES;

        // Get all our locations to pass for filters
        $allLocations = Locations::all();

        return view('invoices')
            ->with('startDate', $startDate)
            ->with('endDate', $endDate)
            ->with('filterStatus', $status)
            ->with('filterLocation', $locationID)
            ->with('allStatus', $allStatus)
            ->with('allLocations', $allLocations)
            ->with('invoices', $invoices);
    }
}
