<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.header')
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
          <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        
        
        @include('user.layout.nav')
        @include('user.layout.sidebar')
        @yield('user-content')
        @include('admin.layouts.footer')
    </div>
    @include('admin.layouts.script')
    
    
    
    
  


</body>

<script>
     $(window).load(function(){        
   $('#myModal').modal('show');
    }); 
</script>





</html>
