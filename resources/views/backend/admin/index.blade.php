<style>
  .dataTables_filter{
    text-align: right;
  }
</style>
<div class="content-wrapper" cuphtml-page title="admin">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-user-md"></i> Admins
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL::route('admin/index') }}"><i class="fa fa-user-md"></i> Admins</a></li>
        @if ($subPage === "view")
          <li class="active"> Index</li>
        @elseif ($subPage === "add")
          <li class="active"> Add</li>
        @elseif ($subPage === "edit")
          <li class="active"> Edit</li>
        @endif
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        @if ($subPage === "view")
          @include('backend/admin/view')
        @elseif ($subPage === "add")
          @include('backend/admin/add')
        @elseif ($subPage === "edit")
          @include('backend/admin/edit')
        @endif
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section>

</div>