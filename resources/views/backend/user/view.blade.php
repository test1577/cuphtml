
<!--cuphtml-box="boxView"-->
<div cuphtml-box="boxView" class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-sort-alpha-asc"></i> Table Users</h3>
    <div class="box-tools pull-right">
      <div class="btn-group">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-wrench"></i></button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="{{ URL::route('user/add') }}"><i class="fa fa-plus"></i> Add</a></li>
          <li><a href="javascript:void(0);" id="selectDelete" data-cuphtml-action="user-delete-where"><i class="fa fa-trash"></i> Delete</a></li>
          <li class="divider"></li>
          <li><a href="#">Empty</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="box-body">
    <input id="getDataTable" type="hidden" value="{{ URL::route('api-user-get') }}">
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
          <th>Social</th>
          <th>Active / Disable</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
<!--        @foreach ($data['rows'] as $row)
        <tr>
          <td class="checkbox checkbox-info">
            <input id="table-check-{{ $row->user_id }}" data-cuphtml-checkbox type="checkbox" value="{{ $row->user_id }}">
            <label for="table-check-{{ $row->user_id }}"></label>
            <input name="title" type="hidden" value="{{ $row->user_fullname }}">
          </td>
          <td>{{ $row->user_id }}</td>
          <td>{{ $row->user_fullname }}</td>
          <td>{{ $row->user_email }}</td>
          <td>
            <span class="invisibility-text">{{ $row->user_social }}</span>
            @if ($row->user_social === "facebook")
            <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
            @elseif ($row->user_social === "google")
            <a class="btn btn-social-icon btn-google"><i class="fa fa-google"></i></a>
            @elseif ($row->user_social === "twitter")
            <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
            @endif
          </td>
          <td>
            <span class="invisibility-text"> @if ($row->user_status == "1") active @else disable @endif</span>
            <input type="checkbox" name="my-checkbox" switch-cuphtml-param-id="{{ $row->user_id }}" switch-cuphtml-param-name="user_status" switch-cuphtml-action="user-status"  @if ($row->user_status == "1") checked @endif>
          </td>
          <td>
            <div class="box-tools pull-right">
              <a class="cuphtml-select-edit btn btn-social-icon btn-info" table-cuphtml-action="user-get-where" table-cuphtml-id="{{ $row->user_id }}"><i class="fa fa-edit"></i></a>
              <a href="{{ URL::route('user/edit', $row->user_id) }}" class="btn btn-social-icon btn-info"><i class="fa fa-edit"></i></a>
              <a class="cuphtml-select-delete btn btn-social-icon btn-danger" table-cuphtml-action="user-delete-where" table-cuphtml-id="{{ $row->user_id }}"><i class="fa fa-trash"></i></a>
            </div>
          </td>
        </tr>
        @endforeach-->
      </tbody>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->