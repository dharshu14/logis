<?php
  session_start();
  include('vendor/inc/config.php');
  include('vendor/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['u_id'];
  //Add Booking
  if(isset($_POST['cancel_booking']))
    {
            $u_book_id = $_GET['u_book_id'];
            $u_book_status  = "Canceled";
            $query="update tms_booking set u_book_status=? where u_book_id=?";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('si', $u_book_status, $u_book_id);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "Booking canceled";
                }
                else 
                {
                    $err = "Please Try Again Later";
                }
            }
?>
<!DOCTYPE html>
<html lang="en">

<?php include('vendor/inc/head.php');?>

<body id="page-top">
 <!--Start Navigation Bar-->
  <?php include("vendor/inc/nav.php");?>
  <!--Navigation Bar-->

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include("vendor/inc/sidebar.php");?>
    <!--End Sidebar-->
    <div id="content-wrapper">

      <div class="container-fluid">
      <?php if(isset($succ)) {?>
                        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Success!","<?php echo $succ;?>!","success");
                    },
                        100);

                       <?php header("location:user-dashboard.php"); ?>
        </script>

        <?php } ?>
        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Failed!","<?php echo $err;?>!","Failed");
                    },
                        100);
        </script>

        <?php } ?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Bookings</a>
          </li>
          <li class="breadcrumb-item active">Cancel</li>
        </ol>
        <hr>
        <div class="card">
        <div class="card-header">
          Cancel Booking
        </div>
        <div class="card-body">
          <!--Add User Form-->
          <?php
            $aid=$_GET['u_book_id'];
            $ret="select * from tms_booking where u_book_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$aid);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
        {
        ?>
          <form method ="POST"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Booking ID</label>
                <input type="text" readonly value="<?php echo $row->u_book_id;?>" required class="form-control" id="exampleInputEmail1" name="u_book_id">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Vehicle Number</label>
                <input type="text" readonly  class="form-control" value="<?php echo $row->u_vehicle_number;?>" id="exampleInputEmail1" name="u_vehicle_number">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Driver Name</label>
                <input type="text" readonly class="form-control" value="<?php echo $row->u_driver_name;?>" id="exampleInputEmail1" name="u_driver_name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Source</label>
                <input type="text" readonly class="form-control" value="<?php echo $row->u_source;?>" id="exampleInputEmail1" name="u_source">
            </div>

            
            <div class="form-group">
                <label for="exampleInputEmail1">Destination</label>
                <input type="email" readonly value="<?php echo $row->u_destination;?>" class="form-control" name="u_destination">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Tons</label>
                <input type="email" readonly placeholder="<?php echo $row->u_tons;?>" class="form-control" name="u_tons">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Booking Date</label>
                <input type="email" readonly placeholder="<?php echo $row->u_book_date;?>" class="form-control" name="u_book_date">
            </div>

        
            <div class="form-group">
                <label for="exampleInputEmail1">Status</label>
                <input type="text" readonly placeholder="<?php echo $row->u_book_status;?>" class="form-control" id="exampleInputEmail1"  name="u_book_status">
            </div>

            

            <button type="submit" name="cancel_booking" class="btn btn-danger">Cancel Booking</button>
          </form>
          <!-- End Form-->
        <?php }?>
        </div>
      </div>
       
      <hr>
     

      <!-- Sticky Footer -->
      <?php include("vendor/inc/footer.php");?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="admin-logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="vendor/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="vendor/js/demo/datatables-demo.js"></script>
  <script src="vendor/js/demo/chart-area-demo.js"></script>
 <!--INject Sweet alert js-->
 <script src="vendor/js/swal.js"></script>

</body>

</html>
