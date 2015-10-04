
<!--cuphtml-box="boxEdit"-->
<div cuphtml-box="boxEdit" class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-edit"></i> Edit</h3>
  </div><!-- /.box-header -->
  <!-- form start -->
  <form id="formEdit" action="{{ URL::route('admin-update') }}" method="post" class="form-horizontal" data-toggle="validator" cuphtml-form>
    <div class="box-body">
      <div class="form-group" hidden>
        <label for="id" class="col-sm-2 control-label">Type Post</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="type_post" name="type_post" value="save" readonly>
          <div class="help-block with-errors"></div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </div>
      </div>
      <div class="form-group">
        <label for="id" class="col-sm-2 control-label">id</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="id" name="id" value="{{ $data['row']->id }}" readonly>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="email" name="email" value="{{ $data['row']->email }}" readonly>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="fullname" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" name="name" value="{{ $data['row']->name }}" placeholder="Name" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
      <div class="col-md-12">
        <button id="formEditSave" type="submit" class="btn btn-default pull-right">Save</button>
        <button id="formEditSaveClose" type="submit" class="btn btn-info pull-right">Save Close</button>
      </div>
    </div><!-- /.box-footer -->
  </form>
</div>