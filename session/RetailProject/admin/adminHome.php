<?php

include_once '../env/connection.php';
include_once '../env/adminAuth.php';


$user = $_SESSION['admin_User'] ;
$branchID_query = "SELECT * FROM branch NATURAL JOIN (b_has_bi) NATURAL JOIN branchinventory NATURAL JOIN a_manages_b NATURAL JOIN admin WHERE admin.admin_Username= '$user' ;"; #check if in admin table
$branchID_result = mysqli_query($conn,$branchID_query);
$branchID_Check = mysqli_num_rows($branchID_result); 

if ($branchID_Check>0) {                                              
    while($branchID_row = mysqli_fetch_assoc($branchID_result)) {
        $_SESSION['branchID'] = $branchID_row['branch_ID'];                #store in $_SESSION for referencing later
        $_SESSION['inventoryID'] = $branchID_row['inventory_ID']; 
       
    }                    
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
     <!-- ajax -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- jquery -->
        <script src="jquery-3.5.1.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Admin | Home</title>
  
    <script id="helper" data-name="<?php echo $_SESSION['admin_User'];?>" src="../env/idle.js"></script> 
  </head>
  <body>
 
  <?php include "./components/nav.php"?>


  <?php if($_SESSION['admin']==1){?>
  
 
 <!-- ---------------------- -->
 <div class="container mt-5  p-2 text-dark bg-transparent" >
        
        <div class="row align-items-center">
           
                <h1 class="text-center">General Manager</h1>
                <table class="table table-striped table-hover fs-6  fw-normal">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    
                            $query = "SELECT * FROM admin natural join admin_contact where admin.admin_ID=1;"; 
                            $result = mysqli_query($conn,$query);
                            $Check = mysqli_num_rows($result);
                        
                                if ( $Check>0) {                                                       
                                    while($row = mysqli_fetch_assoc($result)) {
                                    echo"<tr>
                                    <td>".$row['admin_Firstname']. " ". $row['admin_Lastname']."</td>
                                    <td>". $row['contact'] ." </td>
                        
                                    </tr>";
                            
                                    }
                                } 
                
                                
                            ?>
                            </tbody>
                </table>  
            </div>

            <div class="row align-items-center">
                <h1 class="text-center">Branch Managers</h1>
    
                <div class="fs-6">
                <h5 > <span class="btn badge btn-dark" onclick="managerForm()" >New Branch</span></h5 >
                </div>
    
                <table class="table table-striped table-hover fs-6  fw-normal">
                    <thead>
                        <tr>
                            <th scope="col">Branch Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Manager</th>
        
                        </tr>
                    </thead>
                    <tbody>
                            <?php
        
                            $query = "SELECT * FROM branch natural join a_manages_b natural join branch_contact natural join admin where admin.admin_ID>1;"; 
                            $result = mysqli_query($conn,$query);
                            $Check = mysqli_num_rows($result);
                                if ( $Check>0) {                                                       
                                    while($row = mysqli_fetch_assoc($result)) {
                                    echo"<tr>
                                    <td>".$row['branch_Name']."</td>
                                    <td>". $row['branch_Address'] ." </td>
                                    <td>". $row['contact'] ." </td>
                                    <td>"; ?> <button type="button" class="badge btn btn-secondary" onclick="showManager(<?php  echo $row['admin_ID'] ;?>)" >See Info</button></td>
                                    <?php echo "</td>                                                   
                                    </tr>";                         
                                    }
                                } 
                        
                            ?>
                    </tbody>
                </table>
                </div>  
        </div>
            
    </div>


  <?php }else{ ?>

    <!-- ---------------------- -->
    <div class="container-md   mt-4 pt-4 pb-4 ps-4 pe-4">
        <div class="row align-items-start">
            <div class="col  bg-dark p-2 text-dark bg-opacity-10 rounded">
                <div class="col  bg-transparent ms-2 me-2 p-2 text-dark  rounded">
                    <h1 class="text-center">General Manager</h1>
                    <table class="table table-striped table-hover fs-6  fw-normal">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Contact</th>
 
                            </tr>
                        </thead>

                        <tbody>

                        <?php
       
                         $query = "SELECT * FROM admin natural join admin_contact where admin.admin_ID=1;"; 
                         $result = mysqli_query($conn,$query);
                         $Check = mysqli_num_rows($result);
                      
                            if ( $Check>0) {                                                       
                                while($row = mysqli_fetch_assoc($result)) {
                                  echo"<tr>
                                  <td>".$row['admin_Firstname']. " ". $row['admin_Lastname']."</td>
                                  <td>". $row['contact'] ." </td>
                      
                                  </tr>";
                          
                                }
                            } 

                        ?>
                         </tbody>
                    </table>  
                </div>

            <h1 class="text-center">Branch Managers</h1>
            <table class="table table-striped table-hover fs-6  fw-normal">
                <thead>
                    <tr>
                        <th scope="col">Branch Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Manager</th>
       
                    </tr>
                </thead>
                <tbody>
                    <?php
                
                       
                        
                         $query = "SELECT * FROM branch natural join a_manages_b natural join branch_contact natural join admin where admin.admin_ID>1;"; 
                         $result = mysqli_query($conn,$query);
                         $Check = mysqli_num_rows($result);
                      
                            if ( $Check>0) {                                                       
                                while($row = mysqli_fetch_assoc($result)) {
                                  echo"<tr>
                                  <td>".$row['branch_Name']."</td>
                                  <td>". $row['branch_Address'] ." </td>
                                  <td>". $row['contact'] ." </td>
                                  <td>"; ?> <button type="button" class="badge btn btn-secondary" onclick="showManager(<?php  echo $row['admin_ID'] ;?>)" >See Info</button></td>
                                  <?php echo "</td>
                                                          
                                  </tr>";
                          
                                }
                            } 

      
                            
                    ?>
                </tbody>
            </table>  

        </div>
    </div>
    <!-- --------------------------- -->

    <div class="col-12 mt-5">
            <div class="row align-items-center bg-info p-2 text-dark bg-opacity-50  text-center rounded">

                  <div class="col   ">
                      <h1 > Total Sales<h1>
                      <?php
                              $branchID = $_SESSION['branchID'] ;
                              $orders_query = "SELECT sum(total) AS sales FROM customer NATURAL join cu_orders_ca  NATURAL join cart where cu_orders_ca.status=1 AND customer.cust_ID=cu_orders_ca.customer_ID AND branch_ID=$branchID;"; 
                              $orders_result = mysqli_query($conn,$orders_query);
                              $orders_Check = mysqli_num_rows($orders_result);
                            
                                  if ($orders_Check>0) {                                                       
                                      while($orders_row = mysqli_fetch_assoc($orders_result)) {
                                        if($orders_row['sales'] !=null){

                                        
                                        ?>  
                                        <p class="display-4 "><?php echo $orders_row['sales']  ?>  </p> 
                                        <?php
                                      }else{
                                        ?>  
                                        <p class="display-4 ">0</p> 
                                        <?php
                                      }
                                      }
                                  }

                              

                                  
                                  
                                
                                  
                              ?>


                  </div>
                  <div class="col">   
                      <h1>Total Orders</h1>
                      <?php
                              $branchID = $_SESSION['branchID'] ;
                              $orders_query = "SELECT COUNT(cart_ID) FROM customer NATURAL join cu_orders_ca NATURAL join cart where cu_orders_ca.status=1 AND customer.cust_ID=cu_orders_ca.customer_ID AND branch_ID=$branchID;"; 
                              $orders_result = mysqli_query($conn,$orders_query);
                              $orders_Check = mysqli_num_rows($orders_result);
                            
                                  if ($orders_Check>0) {                                                       
                                      while($orders_row = mysqli_fetch_assoc($orders_result)) {
                                        ?>  
                                        <p class="display-4"><?php echo $orders_row['COUNT(cart_ID)']  ?>  </p> 


                                      
                                        <?php
                                      }
                                  } 

                              

                                  
                                  
                                
                                  
                              ?>

                  </div>
              </div> 
              <div class="row align-items-center bg-info p-2 text-dark bg-opacity-50  text-center rounded mt-3">
                            <h1 class="text-center">Recent Orders<h1>

                            <table class="table table-striped table-hover fs-6  fw-normal">
                                <thead>
                                    <tr>
                                    <th scope="col">Cart ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Address</th>
                            

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                    $branchID = $_SESSION['branchID'] ;
                    if($_SESSION['admin']==1){ 
                        $orders_query = "SELECT * FROM customer NATURAL join cu_orders_ca NATURAL join cart  Limit 10; ";
                    }else{
                        $orders_query = "SELECT * FROM customer NATURAL join cu_orders_ca NATURAL join cart where cu_orders_ca.status=1 AND customer.cust_ID=cu_orders_ca.customer_ID AND branch_ID=$branchID order by cart_ID DESC limit 10;"; 
                    }
                    $status = array("Cancelled", "Ordered", "Delivered");
                    $orders_result = mysqli_query($conn,$orders_query);
                    $orders_Check = mysqli_num_rows($orders_result);
                   
                        if ($orders_Check>0) {                                                       
                            while($orders_row = mysqli_fetch_assoc($orders_result)) {
                               echo"<tr>
                                    <td>".$orders_row['cart_ID']."</td>
                                    <td>". $orders_row['cust_FName'] ." ".$orders_row['cust_LName'] ."</td>
                                    <td>"; ?> <button type="button" class="badge btn btn-secondary" onclick="showDetails(<?php  echo $orders_row['cart_ID'] ;?>)" >Show Items</button></td>
                                     <?php echo "
                                    <td>" .  $orders_row['total']."</td>
                                    <td>". $orders_row['order_Date'] ."</td>
                                    <td>". $orders_row['cust_ABrgy'] .", ".$orders_row['cust_ACity'] .", ".$orders_row['cust_AProvince'] .", ".$orders_row['cust_APostal'] ."</td>
                                   
                                    </tr>";
                            }
                        } 

                     

                        
                        
                      
                        
                    ?>
                    </tbody>
                </table>  

            </div>

              
                      <div class="row align-items-center bg-info p-2 text-dark bg-opacity-50 mt-3 text-center rounded">
                            <h1 class="text-center">Low on Stocks<h1>

                            <table class="table table-striped table-hover fs-6  fw-normal">
                                <thead>
                                    <tr>
                                        <th scope="col">Item ID</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Stock</th>
                            

                                        
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                
                                      
                                        
                                $inventoryID=$_SESSION['inventoryID'];
                                $inventory_query = "SELECT item_ID, item_Name,item_Stock FROM item NATURAL JOIN (bi_has_i) NATURAL JOIN branchinventory where inventory_id =$inventoryID and item_Stock<500 "; 
                                $inventory_result = mysqli_query($conn,$inventory_query);
                                $inventory_Check = mysqli_num_rows($inventory_result);
                              
                                    if ( $inventory_Check>0) {                                                       
                                        while($inventory_row = mysqli_fetch_assoc($inventory_result)) {
                                          echo"<tr>
                                          <td>".$inventory_row['item_ID']."</td>
                                          <td>".$inventory_row['item_Name']."</td>
                                          <td>". $inventory_row['item_Stock'] ." </td>                           
                                          </tr>";
                                  
                                        }
                                    } 


                                        

                                            
                                            
                                          
                                            
                                        ?>
                                        </tbody>
                            </table>  

                          </div>

              
             
          </div>

       
              
             

<?php  } ?>
    <!-- --------------------------- -->

    <script type="text/javascript">
        function showManager(adminID){

            $.post("displayItems.php",{adminID:adminID},function(data,status){
                var json=JSON.parse(data);
                document.getElementById("branchInfo").innerHTML = json.map(getInfo).join("");
                function getInfo(info) {
                return "<tr><td>"+ info.admin_Firstname + " " + info.admin_Lastname +  "</td><td>"+ info.contact + "</td></tr>";
                }
                // document.getElementById("demo").innerHTML = myJSON;
                  //  alert("Data: " + data );
            });
           
            $('#showInfo').modal('show');
        };

        function managerForm(){
            $('#newManager').modal('show');

        };


        function showDetails(cartID){

            $.post("displayItems.php",{cartID:cartID},function(data,status){
            var json=JSON.parse(data);
            let cleanJSON = json;
            document.getElementById("demo").innerHTML = cleanJSON.map(getItem).join("");
            function getItem(item) {
            return "<tr><td>"+ item.item_ID + "</td><td>"+ item.item_Name + "</td><td>"+ item.item_RetailPrice + "</td><td>"+ item.quantity + "</td></tr>";
            }
            // document.getElementById("demo").innerHTML = myJSON;            
        });

        $('#showItems').modal('show');
        };
    </script>
  
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

     <!-- show items modal ##################################-->
     <div class="modal fade" id="showInfo" tabindex="-1" aria-labelledby="showInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showInfoLabel">Branch Managers Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                        </tr>
                    </thead>
                    <tbody id="branchInfo" >
                      

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
            </div>
        </div>
    </div>

 <!-- New Branch Modal ##################################-->
 <div class="modal fade" id="newManager" tabindex="-1" aria-labelledby="newManagerModalLabel"  aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newManagerModalLabel">New Branch Form</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3 pb-4" action="admin.newUser.php" method="post">
                                    <div class="col-12">
                                        <label for="newBranchName" class="form-label">Branch Name</label>
                                        <input type="text" class="form-control" name="newBranchName" id="newBranchName"required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="branchAddress" class="form-label">Branch Address</label>
                                        <input type="text" class="form-control" name="branchAddress"  id="branchAddress"required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="branchContact" class="form-label">Branch Contact</label>
                                        <input type="text" class="form-control" name="branchContact" id="branchContact" pattern="[0-9]{11}"placeholder="ex. 09056447337"  title="pattern 09056537386" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="branchUser" class="form-label">Admin Username</label>
                                        <input type="text" class="form-control" name="branchUser" required>
                                    </div>


                                    <div class="col-md-6">
                                        <label for="branchUserPass" class="form-label">Admin Password</label>
                                        <input type="text" class="form-control" name="branchUserPass"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="adminFN" class="form-label">Admin FirstName</label>
                                        <input type="text" class="form-control" name="adminFN" required>
                                    </div>


                                    <div class="col-md-6">
                                        <label for="adminLN" class="form-label">Admin LastName</label>
                                        <input type="text" class="form-control" name="adminLN"required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="branchUserContact" class="form-label">Admin Contact</label>
                                        <input type="tel" class="form-control" name="branchUserContact" placeholder="ex. 09056447337" minlength="11" maxlength="11"required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="adminPass" class="form-label text-dark">Enter Password to Confirm Action</label>
                                        <input type="password" class="form-control" name="AdminPass" required>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-dark" name="newUser">Submit</button>
                                    </div>
                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>   
                
<!-- show items modal ##################################-->
    <div class="modal fade" id="showItems" tabindex="-1" aria-labelledby="showItemsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showItemsLabel">Cart Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
  
                        </tr>
                    </thead>
                    <tbody id="demo" >
                      

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
            </div>
        </div>
    </div>

  </body>
</html>