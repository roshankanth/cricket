<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Match;
class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.fixtures.index');
    }
  /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matches = Match::findOrFail($id);
        return view('admin.fixtures.show',compact('matches'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $columns = array(0 => 'id', 1 => 'title',2=>'from_team_id',3=>'to_team_id',4=>'start_at',5=>'type',6=>'place');
        $totalData = Match::all()->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $status = $request->input('status');
        $order = isset($columns[$request->input('order.0.column')]) ? $columns[$request->input('order.0.column')] : $columns[0];
        $dir = isset($columns[$request->input('order.0.dir')]) ? $columns[$request->input('order.0.dir')] : 'desc';
        if (empty($request->input('search.value'))) {
            $query = Match::select('matches.*','A.name as TeamA','B.name as TeamB')->leftjoin('teams as A', 'A.id', '=', 'matches.from_team_id')->leftjoin('teams as B', 'B.id', '=', 'matches.to_team_id');
            $matches = $query->offset($start)->limit($limit)->orderBy($order, $dir)->get();
        } else {
            $search = $request->input('search.value');
            $query = Match::select('matches.*','A.name as TeamA','B.name as TeamB')->leftjoin('teams as A', 'A.id', '=', 'matches.from_team_id')->leftjoin('teams as B', 'B.id', '=', 'matches.to_team_id');
            $query->where(function ($q) use ($search) {
                $q->orWhere('A.name', 'LIKE', "%{$search}%");
                $q->orWhere('B.name', 'LIKE', "%{$search}%");
                $q->orWhere('matches.title', 'LIKE', "%{$search}%");
                $q->orWhere('matches.place', 'LIKE', "%{$search}%");
                $q->orWhere('matches.type', 'LIKE', "%{$search}%");
            });
            $totalFiltered = $query->count();
            $matches = $query->offset($start)->limit($limit)->orderBy($order, $dir)->get();
        }
        
        $data = array();
        if (!empty($matches)) {
            foreach ($matches as $key => $value) {
                $show = route('admin.fixtures.show', $value->id);
                $token = csrf_token();
                $nestedData['id'] = $key+1;
                $nestedData['title'] = $value->title;
                $nestedData['from'] = $value->TeamA;
                $nestedData['to'] = $value->TeamB;
                $nestedData['start'] = $value->start_at;
                $nestedData['type'] = $value->type;
                $nestedData['place'] = $value->place;
                $nestedData['options'] = "<a href='{$show}' class='btn btn-sm btn-link'><i class='fa fa-eye'></i> Match Status</a>";
                $data[] = $nestedData;
            }
        }
        $json_data = array("draw" => intval($request->input('draw')), "recordsTotal" => intval($totalFiltered), "recordsFiltered" => intval($totalFiltered), "data" => $data);
        echo json_encode($json_data);
    }
}
