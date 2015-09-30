<style>
  .dataTables_filter{
    text-align: right;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <a href="{{ URL::route('user/index') }}"><i class="fa fa-user"></i> Users</a>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        @if ($subPage === "view")
          <!--cuphtml-box="boxView"-->
          @include('backend/user/view')
        @elseif ($subPage === "add")
          <!--cuphtml-box="boxAdd"-->
          @include('backend/user/add')
        @elseif ($subPage === "edit")
          <!--cuphtml-box="boxEdit"-->
          @include('backend/user/edit')
        @endif
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section>

</div>