@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-11">
            <h2>Invoice Filters</h2>
        </div>
    </div>

    <div class="filters">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="get" action="{{ url('/invoices') }}">
            <label>
                Start Date
                <input type="date" name="start_date" value="{{ $startDate }}">
            </label>

            <label>
                End Date
                <input type="date" name="end_date" value="{{ $endDate }}">
            </label>

            <label>
                Status
                <select name="status">
                    <option value="">All</option>
                    @foreach($allStatus as $status)
                        <option value="{{ $status }}" @if ($filterStatus == $status) selected @endif>{{ ucwords($status) }}</option>
                    @endforeach
                </select>
            </label>

            <label>
                Locations
                <select name="location_id">
                    <option value="">All</option>
                    @foreach($allLocations as $location)
                        <option value="{{ $location->getKey() }}" @if ($filterLocation == $location->getKey()) selected @endif>{{ ucwords($location->name) }}</option>
                    @endforeach
                </select>
            </label>

            <button>Filter</button>
        </form>
    </div>

    <table id="example" class="table hover row-border" style="width:100%">
        <thead>
        <tr>
            <th>Location</th>
            <th>Date</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->name }}</td>
                <td>{{ $invoice->date->format('d/m/Y') }}</td>
                <td>{{ ucwords($invoice->status) }}</td>
                <td>£{{ number_format($invoice->total, 2) }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection
