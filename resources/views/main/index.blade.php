@extends('layout')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Group</th>
            <th scope="col">Weight</th>
            <th scope="col">Weight %</th>
            <th scope="col">Players</th>
            <th scope="col">Players %</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($counters as $key => $counter)
            <tr>
                <th scope="row">{{ ++$key }}</th>
                <td>{{ $counter['group_name'] }}</td>
                <td>{{ $counter['weight'] }}</td>
                <td>{{ $counter['weight_percent'] }}</td>
                <td class="players">{{ $counter['players'] }}</td>
                <td class="playersPercent">{{ $counter['players_percent'] }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <button type="button" class="btn btn-primary" id="resetCounters">Reset Counters</button>
@endsection
