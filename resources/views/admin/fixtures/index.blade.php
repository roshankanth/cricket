@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
       Fixtures List
    </div>
    <div class="card-body">
       <div class="table-responsive">
        <table class="dss table card-table table-vcenter text-nowrap datatable dataTable no-footer" id="fixtures" width="100%">
            <thead>
                <th class="text-center">SN.</th>
                <th>Title</th>
                <th>From</th>
                <th>To</th>
                <th>Date Time</th>
                <th>Type</th>
                <th>Place</th>
               
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
                $('#fixtures').DataTable({
                    dom: 'lfrtip',
                    "processing": true,
                    "serverSide": true,
                    "paging": true,
                    "pageLength": 10,
                    "ajax":{
                        "url": "{{ route('admin.fixtures.search') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data":{ _token: "{{csrf_token()}}"}

                    },
                    "columns": [
                        { "data": "id" },
                        { "data": "title" },
                        { "data": "from" },
                        { "data": "to" },
                        { "data": "start" },
                        { "data": "type" },
                        { "data": "place" },
                       
                        { "data": "options" }
                    ],
                    'columnDefs': [ {
                        'targets': [0,7], /* column index */
                        'orderable': false, /* true or false */
                     }]

                });


            });
        </script>
@endsection