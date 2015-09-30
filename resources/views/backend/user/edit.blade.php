
<!--cuphtml-box="boxEdit"-->
<div cuphtml-box="boxEdit" class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-edit"></i> Edit</h3>
  </div><!-- /.box-header -->
  <!-- form start -->
  <form id="formEdit" action="{{ URL::route('user-update') }}" method="post" class="form-horizontal" data-toggle="validator" cuphtml-form>
    <div class="box-body">
      <div class="form-group" hidden>
        <label for="user_id" class="col-sm-2 control-label">Type Post</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="type_post" name="type_post" value="save" readonly>
          <div class="help-block with-errors"></div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </div>
      </div>
      <div class="form-group">
        <label for="user_id" class="col-sm-2 control-label">id</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $data['row']->user_id }}" readonly>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="user_email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="user_email" name="user_email" value="{{ $data['row']->user_email }}" readonly>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="user_fullname" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="user_fullname" name="user_fullname" value="{{ $data['row']->user_fullname }}" placeholder="Name" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="user_social" class="col-sm-2 control-label">Social</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="user_social" name="user_social" value="{{ $data['row']->user_social }}" readonly>
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="user_tel" class="col-sm-2 control-label">Phone</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="user_tel" name="user_tel" value="{{ $data['row']->user_tel }}" placeholder="Phone">
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="user_address" class="col-sm-2 control-label">Address</label>
        <div class="col-sm-10">
          <textarea type="text" class="form-control" id="user_address" name="user_address" placeholder="Address">{{ $data['row']->user_address }}</textarea>
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