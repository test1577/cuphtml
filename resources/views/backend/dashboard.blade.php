
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>information</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">System Information</h3>
          </div>
          <form  action="{{ URL::route('update/system') }}" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input id="title" name="title" type="text" class="form-control" placeholder="Title" value="{{ $system_info['title'] }}">
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                </div>
              </div>
              <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea id="description" name="description" class="form-control" rows="3" placeholder="Description">{{ $system_info['description'] }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="keywords" class="col-sm-2 control-label">Keywords</label>
                <div class="col-sm-10">
                  <textarea id="keywords" name="keywords" class="form-control" rows="3" placeholder="Keywords">{{ $system_info['keywords'] }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="copyright" class="col-sm-2 control-label">Copyright</label>
                <div class="col-sm-10">
                  <input id="copyright" type="text" class="form-control" placeholder="Title" readonly value="{{ $system_info['copyright'] }}">
                </div>
              </div>
              <div class="form-group">
                <label for="reservation" class="col-sm-2 control-label">Life system:</label>
                <div class="col-sm-10">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right active" name="daterange">
                  <input name="started_at" type="text" class="form-control" value="{{ $system_info['started_at'] }}">
                  <input name="end_at" type="text" class="form-control" value="{{ $system_info['end_at'] }}">
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