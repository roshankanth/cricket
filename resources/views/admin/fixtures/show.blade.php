@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h5>  Match - {{ $matches->title }}</h5>
    </div>
    <div class="card-body">
        @if(count($matches->points)>0)
        @if($matches->is_complete=='no')
        <table class="table table-bordered table-striped">
            <tbody>
                <tr><td>Team</td><td>Score</td><td>Points</td></tr>
                @foreach($matches->points as $key=>$value)
                <tr><td>{{getTeamDetailsById($value->team_id,'name')}}</td><td>{{ $value->score}}</td><td>0.00</td></tr>
                @endforeach
                <tr><td>winner</td><td colspan="2">In-progress</td></tr>
            </tbody>
        </table>
        @else
        <table class="table table-bordered table-striped">
            <tbody>
                <tr><td>Team</td><td>Score</td><td>Points</td></tr>
                @foreach($matches->points as $key=>$value)
                <tr><td>{{getTeamDetailsById($value->team_id,'name')}}</td><td>{{ $value->score}}</td><td>{{ $value->point}}</td></tr>
                @endforeach
                <tr><td>winner</td><td colspan="2">{{getmatchStatusByID($matches->id)}}</td></tr>
            </tbody>
        </table>
        @endif

@else
<h5> Match is live </h5>
<h5> Match Will start At {{$matches->start_at}}</h5>
@endif
</div>
</div>
@endsection