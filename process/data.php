<?php
require_once 'config.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST['type'])){
    $type = $_POST['type'];
    // Search result
    if($type == 1){
        $searchText = $_POST['search'];
        $sql = "SELECT id,name FROM client where name like '%".$searchText."%' order by name asc limit 10";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            $search_arr = array();
            while($fetch = mysqli_fetch_assoc($result)){
                $id = $fetch['id'];
                $name = $fetch['name'];
                $search_arr[] = array("id" => $id, "name" => $name);
            }
        }else{
            $search_arr[] = array("id" => 0, "name" => "No Client Name Found");
        }
        echo json_encode($search_arr);
    }

    // get User data
    if($type == 2){
        $userid = $_POST['userid'];
        $sql = "SELECT client_address.id,client_address.client_id, client_address.client_address, client_address.client_pin, client.GSTIN, client.contact_no FROM client_address INNER JOIN client ON client_address.client_id = client.id AND client_address.client_id=".$userid;
        $result = mysqli_query($con,$sql);
        $return_arr = array();
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            if($num_rows == 1){
                $fetch = mysqli_fetch_assoc($result);
                $id = $fetch['id'];
                $client_id = $fetch['client_id'];
                $client_address = $fetch['client_address'];
                $client_pin = $fetch['client_pin'];
                $client_gstin = $fetch['GSTIN'];
                $return_arr[] = array("id"=>$id, "client_id"=>$client_id, "client_address"=>$client_address, "client_pin"=> $client_pin,"client_gstin" => $client_gstin);
            }else{
                while($fetch = mysqli_fetch_assoc($result)){
                    $id = $fetch['id'];
                    $client_id = $fetch['client_id'];
                    $client_address = $fetch['client_address'];
                    $client_pin = $fetch['client_pin'];
                    $client_gstin = $fetch['GSTIN'];
                    $return_arr[] = array("id"=>$id, "client_id"=>$client_id, "client_address"=>$client_address, "client_pin"=> $client_pin, "client_gstin" => $client_gstin);
                }
            }
        }else{
            
        } 
        echo json_encode($return_arr);
    }
}

if(isset($_POST['purpose'])){
    if($_POST['purpose'] == "fetch_received_challan_data"){
        $data = [];
        $challan_no = $_POST['rec_challan_no'];
        $result = mysqli_query($con,"SELECT * FROM received_item_main WHERE challan_no = '$challan_no'");
        
        if($result){
        
            $row = mysqli_fetch_assoc($result);
            extract($row);
            $data = [
                'total_weight' => $total_weight,
                'remain_weight' => $remain_weight,
                'timestamp' => $timestamp,
                'work_type_id' => $work_type_id,
                'client_id' => $client_id,
                'order_id' => $id,
            ];

            $result1 = mysqli_query($con,"SELECT * FROM good_to_produced WHERE challan_no = '$challan_no'");
            if($result1){
                $data_good_produced = [];
                $cnt = 0;
                while($row1 = mysqli_fetch_assoc($result1)){
                    extract($row1);
                    $data_good_produced[$cnt] =  array('id'=>$id,'item' => $item, 'hsn' => $hsn);
                    $cnt++;
                }
            }

            $result2 = mysqli_query($con,"SELECT * FROM client WHERE id = '$client_id'");
            $row2 = mysqli_fetch_assoc($result2);
            extract($row2);
            array_push($data, array('client' => [
                'id' => $id,
                'name' => $name,
                'GSTIN' => $GSTIN
            ]));

            $data['prod'] = $data_good_produced;

        }

        echo json_encode($data);
    }
}

if(isset($_POST['myData'])){
    $obj = json_decode($_POST["myData"]);

    $challan_no = test_input($obj->challan_no);
    $vehical_no = test_input($obj->vehical_no);
    $work_type = test_input($obj->work_type);

    $date = test_input($obj->date);
    $date = date('Y-m-d', strtotime($date)); 

    $user_id = test_input($obj->user_id);

    $received_total_qty = test_input($obj->received_total_qty);

    $delivered_item = $obj->delivered_item;
    $received_item = $obj->received_item;


    $sql = "INSERT INTO `received_item_main` (`challan_no`, `total_weight`,`remain_weight`,`timestamp`,`vehical_no`, `work_type_id`, `client_id`) VALUES ('$challan_no', '$received_total_qty','$received_total_qty', '$date','$vehical_no', '$work_type', '$user_id')";
    $error = 1;
    if(mysqli_query($con, $sql)){
        for($i = 0 ; $i < count($delivered_item) ; $i++){
            $item = $delivered_item[$i]->item;
            $hsn = $delivered_item[$i]->hsn;
            $qty = $delivered_item[$i]->qty;
            $sql = "INSERT INTO `goods_delivered` (`challan_no`, `item`, `hsn`, `qty`) VALUES ('$challan_no', '$item', '$hsn', '$qty')";
            if(mysqli_query($con, $sql)) $error = 0;
        }
        for($i = 0 ; $i < count($received_item) ; $i++){
            $item = $received_item[$i]->item;
            $hsn = $received_item[$i]->hsn;
            $qty = $received_item[$i]->qty;
            $unit = $received_item[$i]->unit;
            $sql = "INSERT INTO `good_to_produced` (`challan_no`, `item`, `hsn`, `qty`, `unit`) VALUES ('$challan_no', '$item', '$hsn', '$qty', '$unit')";
            if(mysqli_query($con, $sql)) $error = 0;
        }
    }
    echo($error == 0)?"Order Received Successfully":"Something Went Wrong";
}

if(isset($_POST['myData2'])){
    $obj = json_decode($_POST["myData2"]);

    $challan_no = test_input($obj->challan_no);
    $received_challan_no = test_input($obj->received_challan_no);
    $veichel_no = test_input($obj->veichel_no);
    // $work_type = test_input($obj->work_type);

    $date = test_input($obj->date);
    $date = date('Y-m-d', strtotime($date)); 

    $client_id = test_input($obj->client_details->client_id);
    $address_id = test_input($obj->client_details->address_id);

    // $received_total_qty = test_input($obj->received_total_qty);

    $item_details = $obj->item_details;

    $order_id = $obj->order_id;

    $prev_qty = $obj->prev_qty;
    $received_total_qty = $obj->received_total_qty;

    $error = 1;

    if($prev_qty > $received_total_qty){
        $updated_qty = $prev_qty - $received_total_qty;

        $sql0 = "UPDATE `received_item_main` SET `remain_weight` = '$updated_qty' WHERE `id` = '$order_id'";
        if(mysqli_query($con, $sql0)) $error = 0;

        for($i = 0 ; $i < count($item_details) ; $i++){
            $item_id = $item_details[$i]->item_id;
            $qty_pic = $item_details[$i]->qty_pic;
            $qty_kg = $item_details[$i]->qty_kg;
            $qty_bag = $item_details[$i]->qty_bag;

            $sql = "INSERT INTO `delivery_prod_details` (`prod_id`, `qty_kg`, `qty_pic`, `qty_bag`) VALUES ('$item_id', '$qty_kg', '$qty_pic', '$qty_bag')";
            if(mysqli_query($con, $sql)){
                $last_id = mysqli_insert_id($con);
                $sql1 = "INSERT INTO `delivery_challan` (`received_challan_no`, `deli_challan_no`, `delivery_prod_id`, `client_id`, `client_address_id`, `veichel_no`) VALUES ('$received_challan_no', '$challan_no', '$last_id', '$client_id', '$address_id', '$veichel_no')";
                if(mysqli_query($con, $sql1)) $error = 0;
            }
        }
        echo($error == 0)?"Delivery Order Received Successfully":"Something Went Wrong";
    }
}
?>