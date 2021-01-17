<?php

namespace App\Services;

use App\Models\InvoiceHeaders;
use Illuminate\Support\Facades\DB;

class Invoices
{
    /**
     * Filter Invoices
     *
     * @param null $startDate
     * @param null $endDate
     * @param null $status
     * @param null $locationID
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     *
     * @author AC
     */
    public function filterInvoices($startDate = null, $endDate = null, $status = null, $locationID = null)
    {
        $query = InvoiceHeaders::query();
        $query->leftJoin('invoice_lines', 'invoice_headers.id', '=', 'invoice_lines.invoice_header_id');
        $query->leftJoin('locations', 'invoice_headers.location_id', '=', 'locations.id');

        // Start our Select, including summing our line values
        $query->select(
            'locations.name',
            'invoice_headers.date',
            'invoice_headers.status',
            DB::raw('SUM(invoice_lines.value) AS total')
        );

        // Set our start and end dates, including the time (As this can and does make a difference)
        if (!is_null($startDate)) {
            $startDate = date_create_from_format('Y-m-d', $startDate);
            $startDate->setTime(0, 0, 0);
        }

        if (!is_null($endDate)) {
            $endDate = date_create_from_format('Y-m-d', $endDate);
            $endDate->setTime(23, 59, 59);
        }

        // Start Date & End Date
        switch (true) {
            case (!is_null($startDate) && !is_null($endDate)):
                $query->whereBetween('invoice_headers.date', [$startDate, $endDate]);
                break;
            case (!is_null($startDate) && is_null($endDate)):
                $query->where('invoice_headers.date', '>=', $startDate);
                break;
            case (is_null($startDate) && !is_null($endDate)):
                $query->where('invoice_headers.date', '<=', $endDate);
                break;
        }

        // Check Status
        if (!is_null($status)) {
            $query->where('invoice_headers.status', '=', $status);
        }

        // Check Location ID
        if (!is_null($locationID)) {
            $query->where('invoice_headers.location_id', '=', $locationID);
        }

        // Group by Invoice ID's (And ensure it sum's up the values)
        $query->groupBy('invoice_headers.id');

        $query->get();

        return $query->get();
    }

    /**
     * Get Total For Location By Status
     *
     * @param null $locationID
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     *
     * @author AC
     */
    public function getTotalForLocationByStatus($locationID = null)
    {
        $query = InvoiceHeaders::query();

        $query->leftJoin('invoice_lines', 'invoice_headers.id', '=', 'invoice_lines.invoice_header_id');

        // Sum our values
        $query->select(
            'invoice_headers.status',
            DB::raw('SUM(invoice_lines.value) AS total')
        );

        // Where our location ID is used (if not null)
        if (!is_null($locationID)) {
            $query->where('invoice_headers.location_id', '=', $locationID);
        }

        // Group by status
        $query->groupBy('invoice_headers.status');

        return $query->get();
    }
}
