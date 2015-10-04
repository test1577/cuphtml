
<!--cuphtml-box="boxAdd"-->
<div cuphtml-box="boxAdd" class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-plus"></i> Add</h3>
  </div><!-- /.box-header -->
  <!-- form start -->
  <form id="formAdd" action="{{ URL::route('admin-add') }}" method="post" class="form-horizontal" data-toggle="validator" cuphtml-form>
    <div class="box-body">
      <div class="form-group" hidden>
        <label for="id" class="col-sm-2 control-label">Type Post</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="type_post" name="type_post" value="save" readonly>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="email" data-remote="{{ URL::route('validate-email') }}" class="form-control" id="email" name="email" placeholder="Email" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="fullname" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
      <div class="col-md-12">
        <button id="formAddSave" type="submit" class="btn btn-default pull-right">Add</button>
        <button id="formAddSaveClose" type="submit" class="btn btn-info pull-right">Add Close</button>
      </div>
    </div><!-- /.box-footer -->
  </form>
</div>