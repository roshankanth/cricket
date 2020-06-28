<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.teams.index');
    }
  /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teams = Team::findOrFail($id);
        return view('admin.teams.show',compact('teams'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $columns = array(0 => 'id', 1 => 'title');
        $totalData = Team::all()->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $status = $request->input('status');
        $order = isset($columns[$request->input('order.0.column')]) ? $columns[$request->input('order.0.column')] : $columns[0];
        $dir = isset($columns[$request->input('order.0.dir')]) ? $columns[$request->input('order.0.dir')] : 'desc';
        if (empty($request->input('search.value'))) {
            $query = Team::select('id','name');
            $teams = $query->offset($start)->limit($limit)->orderBy($order, $dir)->get();
        } else {
            $search = $request->input('search.value');
            $query = Team::select('id','name');
            $query->where(function ($q) use ($search) {
                $q->orWhere('name', 'LIKE', "%{$search}%");
            });
            $totalFiltered = $query->count();
            $teams = $query->offset($start)->limit($limit)->orderBy($order, $dir)->get();
        }
        $data = array();
        if (!empty($teams)) {
            foreach ($teams as $key => $value) {
                $show = route('admin.teams.show', $value->id);
                $token = csrf_token();
                $nestedData['id'] = $key+1;
                $nestedData['title'] = $value->name;
                $nestedData['options'] = "<a href='{$show}' class='btn btn-sm btn-link'><i class='fa fa-eye'></i> Preview</a>";
                $data[] = $nestedData;
            }
        }
        $json_data = array("draw" => intval($request->input('draw')), "recordsTotal" => intval($totalFiltered), "recordsFiltered" => intval($totalFiltered), "data" => $data);
        echo json_encode($json_data);
    }
}