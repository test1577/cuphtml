<style>
  .dataTables_filter{
    text-align: right;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
       <i class="fa fa-user"></i> Users
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::route('user/index') }}"><i class="fa fa-user"></i> Users</a></li>
      <li class="active">Index</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Table Users</h3>
            <div class="box-tools pull-right">
              <div class="btn-group">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-wrench"></i></button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Add</a></li>
                  <li><a href="javascript:void(0);" id="selectDelete" data-cuphtml-action="user-delete-where" >Delete</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Empty</a></li>
                </ul>
              </div>
<!--                
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
          </div>
          <div class="box-body">
            <table id="indexTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><input id="selectAll" type="checkbox"></th>
                  <th>id</th>
                  <th>Name</th>
                  <th>Email or Account</th>
                  <th>Social</th>
                  <th>Actived</th>
                  <th>Create At</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data['rows'] as $row)
                <tr>
                  <td>
                    <input data-cuphtml-checkbox type="checkbox" value="{{ $row->user_id }}">
                    <input name="title" type="hidden" value="{{ $row->user_fullname }}">
                  </td>
                  <td>{{ $row->user_id }}</td>
                  <td>{{ $row->user_fullname }}</td>
                  <td>{{ $row->user_email }}</td>
                  <td>
                    <span style="width:1px;display:inline-block;color:transparent;">{{ $row->user_social }}</span>
                    @if ($row->user_social === "facebook")
                    <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                    @elseif ($row->user_social === "google")
                    <a class="btn btn-social-icon btn-google"><i class="fa fa-google"></i></a>
                    @elseif ($row->user_social === "twitter")
                    <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                    @endif
                  </td>
                  <td>
                    <input type="checkbox" name="my-checkbox" switch-cuphtml-param-id="{{ $row->user_id }}" switch-cuphtml-param-name="user_status" switch-cuphtml-action="user-status"  @if ($row->user_status == "1") checked @endif>
                  </td>
                  <td>{{ $row->created_at }}</td>
                  <td>
                    <div class="box-tools pull-right">
                      <a class="cuphtml-select-edit btn btn-social-icon btn-info" table-cuphtml-action="user-edit-where" table-cuphtml-id="{{ $row->user_id }}"><i class="fa fa-edit"></i></a>
                      <a class="cuphtml-select-delete btn btn-social-icon btn-danger" table-cuphtml-action="user-delete-where" table-cuphtml-id="{{ $row->user_id }}"><i class="fa fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section>

</div>