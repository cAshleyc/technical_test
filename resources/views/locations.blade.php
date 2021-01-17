@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-11">
            <h2>Location Totals by Status</h2>
        </div>
    </div>

    <div class="flex-center position-ref full-height">

        <div>
            <form method="get" action="{{ url('/locations') }}">
                <label>
                    Get totals by status for location
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
                <th>Status</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($statusTotals as $line)
                <tr>
                    <td>{{ ucwords($line->status) }}</td>
                    <td>£{{ number_format($line->total, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
