<?php 
    include("head.php"); 
    include("sidebar.php"); 
?>
    
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i> BIENVENIDO </li>
              <li><i class="icon_profile"></i><?php echo $_SESSION['ides']; ?></li>
              <li><i class="fa fa-user-md"></i><?php echo $_SESSION['username']; ?></li>
              <li><i class="icon_cogs"></i><?php echo $_SESSION['nivelus']; ?></li>
            </ol>
          </div>
        </div>
        
        <!-- page start-->
        <!-- page end-->

      </section>
    </section>
    <!--main content end-->
    
    
<?php include("footer.php");  ?>