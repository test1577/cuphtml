<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-dashboard"></i> Dashboard
      <small>information</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="{{ URL::route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon  bg-green"><i class="fa fa-leaf"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Domain : {{ $global['baseUrl'] }}</span>
            <span class="info-box-text">Remaining Life's  : <span id="remainingDays"></span> ( {{ $systemInfo['end_at'] }} )</span>
            
            <div class="progress">
                    <div class="progress-bar bg-green" style="width: 70%"></div>
                  </div>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ $data['items']['movies'] }}</h3>
            <p>Movies</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-movie-o"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ $data['items']['others'] }}</h3>
            <p>Others</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ $data['items']['users'] }}</h3>
            <p>User Registrations</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{ URL::route("user/index") }}" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ $data['items']['reports'] }}</h3>
            <p>Reports</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="๒" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div><!-- ./col -->
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">System Information</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-cuphtml-action="view" data-cuphtml-name="system"><i class="fa fa-navicon"></i></button>
              <button class="btn btn-box-tool" data-cuphtml-action="edit" data-cuphtml-name="system"><i class="fa fa-edit"></i></button>
<!--                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
          </div>
          <!--system-view-->
          <form class="form-horizontal" data-cuphtml-toggle="system-view">
            <div class="box-body">
              <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <p class="form-control-static">{{ $systemInfo['title'] }}</p>
                </div>
              </div>
              <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <p class="form-control-static">{{ $systemInfo['description'] }}</p>
                </div>
              </div>
              <div class="form-group">
                <label for="keywords" class="col-sm-2 control-label">Keywords</label>
                <div class="col-sm-10">
                  <p class="form-control-static">{{ $systemInfo['keywords'] }}</p>
                </div>
              </div>
              <div class="form-group">
                <label for="copyright" class="col-sm-2 control-label">Copyright</label>
                <div class="col-sm-10">
                  <p class="form-control-static">{{ $systemInfo['copyright'] }}</p>
                </div>
              </div>
            </div>
          </form>
          <!--system-edit-->
          <form  action="{{ URL::route('update/system') }}" method="post" class="form-horizontal" data-cuphtml-toggle="system-edit">
            <div class="box-body">
              <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input id="title" name="title" type="text" class="form-control" placeholder="Title" value="{{ $systemInfo['title'] }}">
                  <input type="hidden" name="id" value="{{ $systemInfo['id'] }}" />
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </div>
              </div>
              <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea id="description" name="description" class="form-control" rows="3" placeholder="Description">{{ $systemInfo['description'] }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="keywords" class="col-sm-2 control-label">Keywords</label>
                <div class="col-sm-10">
                  <textarea id="keywords" name="keywords" class="form-control" rows="3" placeholder="Keywords">{{ $systemInfo['keywords'] }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="copyright" class="col-sm-2 control-label">Copyright</label>
                <div class="col-sm-10">
                  <input id="copyright" type="text" class="form-control" placeholder="Title" readonly value="{{ $systemInfo['copyright'] }}">
                </div>
              </div>
              <div class="form-group">
                <label for="reservation" class="col-sm-2 control-label">Life system:</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right active" name="daterange" autocomplete="off" disabled>
                    <input name="started_at" type="hidden" class="form-control" value="{{ $systemInfo['started_at'] }}">
                    <input name="end_at" type="hidden" class="form-control" value="{{ $systemInfo['end_at'] }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-info pull-right">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>   
  </section>

</div>