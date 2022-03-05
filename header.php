        <?php 
         include('connection.php');
$query = mysqli_query($conn,"select * from company_master  ");
$num = mysqli_fetch_array($query);

        ?>

        <div class="top_nav">

          <div class="nav_menu">
              <div class="nav toggle">
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    Darshan Patel
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <?php  
if($num==0)
{?>
                    <a class="dropdown-item"  href="company-form.php">Add Profile</a>
  <?php
}
else
{
                    ?>
                    <a class="dropdown-item"  href="company-edit-form.php"> Profile</a>
                  <?php } ?>
                    <a class="dropdown-item"  href="upload-logo.php">Upload Company Logo</a>
                    <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>