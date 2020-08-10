<?php
include "header.php";

?>

        <!-- page content area main -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <div class="right_col" role="main" style="background-color:white">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3 style="color:black">Generate Certificate</h3>
                    </div>

                    <form name="add_books" class="col-lg-12" action="" method="post">
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Name or Domain" name="USN" required="" > <!--search_variable instead of USN-->
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit1" name="Go">Go!</button>
                    </span>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

                <div class="clearfix"></div>
                
                <?php
                if(isset($_POST["Go"]))
                {
                  $usn=$_POST["USN"];
                  $usn1 = strtoupper($usn);
                ?>
                  <div class="row" style="min-height:500px">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                              <div class="x_content">
                                  <?php
                                  $query = "SELECT user_id,name,d.dname,r.marks from user,result r,domain d where d.dname like('$usn1%') and r.d_id=d.d_id and user_id=r.u_id ;";
								   $link=Connect();
                                  $result = mysqli_query($link,$query);
								   
                                     if (!$result) {
    printf("Error: %s\n", mysqli_error($link));
									 
    exit();
									 }

                                  echo "<table class='table table-bordered'>";
                                  echo "<tr>";
                                  echo "<th>"; echo "User Id"; echo "</th>";
                                  echo "<th>"; echo "User Name"; echo "</th>";
                                  echo "<th>"; echo "Domain"; echo "</th>";
                                  echo "<th>"; echo "Marks"; echo "</th>";
                                  echo "<th>"; echo "Results"; echo "</th>";
                                  echo "<th>"; echo "Action"; echo "</th>";

                                  echo "</tr>";

                                  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                  {
                                    echo "<tr>";
                                    echo "<td>"; echo $row["user_id"]; echo "</td>";
                                    echo "<td>"; echo $row["name"]; echo "</td>";
                                    echo "<td>"; echo $row["dname"]; echo "</td>";
                                    echo "<td>"; echo $row["marks"]; echo "</td>";
                                    if($row["marks"]>50)
									{
									echo"<td>";echo "Pass";echo"</td>";
									}
									else
									{
                                    echo "<td>"; echo "Fail"; echo "</td>";
                                    }
                                    echo "<td>"; ?> <a href="grant.php?usn="<?php echo $row["user_id"]; ?>>Grant</a><?php echo " /"; ?> <a href="revoke.php?usn=<?php echo $row["user_id"]; ?>">Revoke</a><?php echo "</td>";
                                    echo "</tr>";
                                  }
                                  echo "</table>";
                                   ?>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php
                }
                else
                {?>
                  <div class="row" style="min-height:500px;color:black">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                              <div class="x_content">
                                  <?php
                                 $query = "SELECT user_id,name,d.dname,r.marks from user,result r,domain d where r.d_id=d.d_id and user_id=r.u_id ;";
								 $link=Connect();
                                  $result = mysqli_query($link,$query);
                                  echo "<table class='table table-bordered'>";
                                  echo "<tr>";
                                  echo "<th>"; echo "User Id"; echo "</th>";
                                  echo "<th>"; echo "Name"; echo "</th>";
                                  echo "<th>"; echo "Domain"; echo "</th>";
                                  echo "<th>"; echo "Marks"; echo "</th>";
                                  echo "<th>"; echo "Results"; echo "</th>";
                                  echo "<th>"; echo "Action"; echo "</th>";
                                  echo "</tr>";


                                  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                                  {
									  
                                    echo "<td>"; echo $row["user_id"]; echo "</td>";
                                    echo "<td>"; echo $row["name"]; echo "</td>";
                                   
                                   echo "<td>"; echo $row["dname"]; echo "</td>";
                                    echo "<td>"; echo $row["marks"]; echo "</td>";
                                    if($row["marks"]>50)
									{
									echo"<td>";echo "Pass";echo"</td>";
									}
									else
									{
                                    echo "<td>"; echo "Fail"; echo "</td>";
                                    }
                                    echo "<td>"; ?> <a href="grant.php?usn=<?php echo $row["user_id"]; ?>">View Graph</a><?php echo "</td>";
                                    echo "</tr>";
                                  }
                                  echo "</table>";
                                   ?>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php
                } ?>



            </div>
        </div>
        <!-- /page content -->
<?php
include "footer.php"
?>
