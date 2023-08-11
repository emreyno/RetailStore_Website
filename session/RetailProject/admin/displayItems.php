
<?php 
    include_once '../env/connection.php';
    include_once '../env/adminAuth.php';

    if (isset($_POST['cartID'])){

        
        
        $cart_id=$_POST['cartID'];
        $item_query ="SELECT * FROM ca_contains_i natural join item where cart_ID=$cart_id;" ;
        $item_result = mysqli_query($conn,$item_query);
        $response=array();
       
            while ($item_row = mysqli_fetch_assoc($item_result)){
                // $response = $item_row;
                array_push($response,$item_row);
             
            };
        echo json_encode($response);

    }else{
        
        // header('location: adminHome.php');
        $response['status']=200;
        $response['message']="Invalid or data not found";
    };

    if (isset($_POST['adminID'])){

        
        
        $id=$_POST['adminID'];
        $query ="SELECT * FROM admin natural join admin_contact where admin.admin_ID=$id;" ;
        $result = mysqli_query($conn,$query);
        $response=array();
       
            while ($item_row = mysqli_fetch_assoc($result)){
                // $response = $item_row;
                array_push($response,$item_row);
             
            };
        echo json_encode($response);

    }else{
        
        // header('location: adminHome.php');
        $response['status']=200;
        $response['message']="Invalid or data not found";
    };


    if (isset($_POST['LowInventoryID'])){

        $inventoryID=$_POST['LowInventoryID'];
        $query ="SELECT * from bi_has_i natural join item where bi_has_i.inventory_ID=$inventoryID and item_Stock<500;" ;
        $result = mysqli_query($conn,$query);
        $response=array();
       
            while ($row = mysqli_fetch_assoc($result)){
                // $response = $item_row;
                array_push($response,$row);
             
            };
        echo json_encode($response);

    }else{
        
        // header('location: adminHome.php');
        $response['status']=200;
        $response['message']="Invalid or data not found";
    };

    if (isset($_POST['availableInventoryID'])){

        $inventoryID=$_POST['availableInventoryID'];
        $query ="SELECT * from bi_has_i natural join item where bi_has_i.inventory_ID=$inventoryID ;" ;
        $result = mysqli_query($conn,$query);
        $response=array();
       
            while ($row = mysqli_fetch_assoc($result)){
                // $response = $item_row;
                array_push($response,$row);
             
            };
        echo json_encode($response);

    }else{
        
        // header('location: adminHome.php');
        $response['status']=200;
        $response['message']="Invalid or data not found";
    };



?>


