
<!--cuphtml-box="boxView"-->
<div cuphtml-box="boxView" class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-sort-alpha-asc"></i> Table Admins</h3>
    <div class="box-tools pull-right">
      <div class="btn-group">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-wrench"></i></button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="{{ URL::route('admin/add') }}"><i class="fa fa-plus"></i> Add</a></li>
          <li><a href="javascript:void(0);" id="selectDelete" data-cuphtml-action="admin-delete-where"><i class="fa fa-trash"></i> Delete</a></li>
          <li class="divider"></li>
          <li><a href="#">Empty</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="box-body">
    <input id="getDataTable" type="hidden" value="{{ URL::route('api-admin-get') }}">
    <table id="indexTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th class="checkbox checkbox-info" style="text-align: center">
            <input id="selectAll" type="checkbox">
            <label for="selectAll"></label>
          </th>
          <th>id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Active / Disable</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->