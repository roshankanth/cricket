@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
       Teams List
    </div>
    <div class="card-body">
       <div class="table-responsive">
        <table class="dss table card-table table-vcenter text-nowrap datatable dataTable no-footer" id="teams" width="100%">
            <thead>
                <th class="text-center">SN.</th>
                <th>Team Title</th>
               
                <th>Actions</th>
            </thead>
        </table>
    </div>
</div>
</div>
@endsection
@section('scripts')
@parent
 <script>

            $(document).ready(function () {
                $('#teams').DataTable({
                    dom: 'lfrtip',
                    "processing": true,
                    "serverSide": true,
                    "paging": true,
                    "pageLength": 10,
                    "ajax":{
                        "url": "{{ route('admin.teams.search') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data":{ _token: "{{csrf_token()}}"}

                    },
                    "columns": [
                        { "data": "id" },
                        { "data": "title" },
                       
                        { "data": "options" }
                    ],
                    'columnDefs': [ {
                        'targets': [0,2], /* column index */
                        'orderable': false, /* true or false */
                     }]

                });


            });
        </script>
@endsection