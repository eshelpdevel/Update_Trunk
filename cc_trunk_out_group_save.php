<?php
###############################################################################################################
# Date          |    Type    |   Version                                                                      # 
############################################################################################################### 
# 14-05-2025    |   Create   |  1.1.1405.2025                                                                 #
############################################################################################################### 

include "../../sysconf/global_func.php";
include "../../sysconf/session.php";
include "../../sysconf/db_config.php";
include "global_func_cc.php";
$condb = connectDB();

$v_agentid      = get_session("v_agentid");
$v_agentlevel   = get_session("v_agentlevel");

$v				= get_param("v");
$iddet			= get_param("iddet");

$trunk_idp    			= get_param("trunk_id");
$trunk_id2    			= get_param("trunk_id2");
$server_idp   			= get_param("server_id");
$priorityp    			= get_param("priority");
$statusp				= get_param("status");
$tottrk					= get_param("tottrk");
$group_id					= get_param("group_id");
$srv_id					= get_param("srv_id");

//trail log
$reason_log = "cc_trunk_out_group $server_idp";

if($v=='del') {
	//delete
	  $sql_del  	= "DELETE FROM cc_trunk_out_group 
                   WHERE group_id = '$group_id'"; 
	if($rec_del = mysqli_query($condb,$sql_del)) {
		//user trail log
		$traildesc = "Delete $reason_log Success";
		cc_insert_trail_log($v_agentid,$traildesc,$condb);
		
		echo "Success";
	} else {
		//user trail log
		$traildesc = "Delete $reason_log Failed";
		cc_insert_trail_log($v_agentid,$traildesc,$condb);
		
		echo "Failed";
	}
	
} else {
	
	$sqldel1    = "DELETE FROM cc_trunk_out_group 
                   WHERE group_id = '$group_id'";
	$cekdel = mysqli_query($condb, $sqldel1);
	// if($cekdel) {

         // print_r($statusp);
         // print_r($trunk_id2);die();

		
		if (!empty($trunk_idp)) {
	 	    $z = 0;     	  
		 	  foreach($trunk_id2 as $trunkid) {

		 	  			$status             = "";
						$sqlsts = "SELECT status FROM cc_trunk_out_group 
								WHERE  group_id = '".$group_id."'
								 AND server_id = '".$server_idp[$z]."'
								 AND trunk_out = '".$trunkid."'";
						$ressts = mysqli_query($condb,$sqlsts);
						if($recsts = mysqli_fetch_array($ressts)){
							$status 			= $recsts['status'];
						}

						$max_priority=0;
						$sqlsts = "SELECT MAX(priority) AS max_priority FROM cc_trunk_out_group 
								WHERE  group_id = '".$group_id."'
								 AND server_id = '".$server_idp[$z]."'";
						$ressts = mysqli_query($condb,$sqlsts);
						if($recsts = mysqli_fetch_array($ressts)){
							$max_priority 			= $recsts['max_priority'];
						}
						$max_priority++;


					// if($statusp[$z]!='0'){
						// $sql = "UPDATE cc_trunk_out_group SET 
						// 		 status = '".$statusp[$z]."',
						// 		 modif_time = now()
						// 		WHERE  group_id = '".$group_id."'
						// 		 AND server_id = '".$server_idp[$z]."'
						// 		 AND trunk_out = '".$trunkid."'";//echo "## $sql || $sqlsts </br>";
			   //         mysqli_query($condb, $sql);

						//$priorityp[$z]
						$sql = "INSERT INTO cc_trunk_out_group SET 
								 status = '".$statusp[$z]."',
								 group_id = '".$group_id."',
								 server_id = '".$server_idp[$z]."',
								 trunk_out = '".$trunkid."',
								 priority  = '".$max_priority."',
								 modif_time = now()";//echo "## $sqlsts || $sql </br>";
			           mysqli_query($condb, $sql);
					// }  
			           $z++;

			           // if ($statusp[$z]!=$status) {
		            //     $sqlu = "INSERT INTO cc_setting_reload SET
		            //     server_id     ='$server_idp[$z]',
		            //     mod_astgwy    = '0',
		            //     mod_astcti    = '0',
		            //     mod_astctigwy = '0',
		            //     request_by    = '$v_agentid',
		            //     request_time  = now(),
		            //     insert_time   = now() 
		            //     ON DUPLICATE KEY UPDATE
		            //     server_id     ='$server_idp[$z]',
		            //     mod_astgwy    = '0',
		            //     mod_astcti    = '0',
		            //     mod_astctigwy = '0',
		            //     request_by    = '$v_agentid',
		            //     request_time  = now(),
		            //     insert_time   = now()";
		            //     // echo $sqlu;
		            //     $rec_u = mysqli_query($condb,$sqlu);
			           // }
			            $srv_id_arr   = explode(',', $srv_id);
			            $srv_id_arr2  =array_unique($srv_id_arr);
			            foreach ($srv_id_arr2 as $value) {

			                $sqlu = "INSERT INTO cc_setting_reload SET
			                server_id     ='$value',
			                mod_astgwy    = '0',
			                mod_astcti    = '0',
			                mod_astctigwy = '0',
			                request_by    = '$v_agentid',
			                request_time  = now(),
			                insert_time   = now() 
			                ON DUPLICATE KEY UPDATE
			                server_id     ='$value',
			                mod_astgwy    = '0',
			                mod_astcti    = '0',
			                mod_astctigwy = '0',
			                request_by    = '$v_agentid',
			                request_time  = now(),
			                insert_time   = now()";//echo "$sqlu </br>";
			                // echo $sqlu;
			                $rec_u = mysqli_query($condb,$sqlu);
			            }
		 	  }
		}
		
		echo "Success";
		$traildesc = "Update $reason_log Success";
		cc_insert_trail_log($v_agentid,$traildesc,$condb);
	// } else {
	// 	echo "Failed";
	// }
}

disconnectDB($condb);
?>