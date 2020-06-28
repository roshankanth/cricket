@extends('layouts.admin')
@section('content')
<section class="content">
	
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>2</h3>

                <p>Teams</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('admin.teams.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
         
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
@parent

@endsection