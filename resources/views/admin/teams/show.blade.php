@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h5>  Team - {{ $teams->name }}</h5>
        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;">
            @if(!empty($teams->logo_uri))
            <img src="{{url($teams->logo_uri)}}"  style="width: 100px; height: 100px;" alt=""/>
            @else
            <img src="http://www.placehold.it/100x100/EFEFEF/AAAAAA&amp;text=No+Image" alt="">
            @endif
        </div>
    </div>
    <div class="card-body">
       <h5>  Player Lists</h5>
       <table class="table table-bordered table-striped">
         <thead>
          <tr>
            <th>Sn.</th>
            <th>Name</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
       @if(count($teams->players)>0)
       @foreach($teams->players as $key=>$value)
       <tr>
        <td>
            {{$key+1}}                       
        </td>
        <td>
            {{$value->last_name}}  {{$value->first_name}}
        </td>
        <td>
         <div class="fileinput-new thumbnail">
            @if(!empty($value->image_uri))
            <img src="{{url($value->image_uri)}}"  style="width: 100px; height: 100px;" alt=""/>
            @else
            <img src="http://www.placehold.it/100x100/EFEFEF/AAAAAA&amp;text=No+Image" alt="">
            @endif
        </div>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="3">
       N/A
   </td>
</tr>
@endif
</tbody>
</table>
</div>
</div>
@endsection