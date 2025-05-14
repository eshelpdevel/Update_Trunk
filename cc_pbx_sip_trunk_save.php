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

$serverid		= get_param("server_id");
$contype		= get_param("con_type");
// $host			= get_param("host_id");
$dtmfmode		= get_param("dtmfmode");
$canreinvite		= get_param("canreinvite");
// $context		= get_param("context");
// $host			= get_param("host");
// $username	= get_param("username");
// $secret		= get_param("secret");
// $callerid	= get_param("callerid");
$context		= mysqli_real_escape_string($condb,get_param("context"));
$host			= mysqli_real_escape_string($condb,get_param("host"));
$username	= mysqli_real_escape_string($condb,get_param("username"));
$secret		= mysqli_real_escape_string($condb,get_param("secret"));
$callerid	= mysqli_real_escape_string($condb,get_param("callerid"));
$trunk_name	= mysqli_real_escape_string($condb,get_param("trunk_name"));
$insecure	= get_param("insecure");
$qualify	= get_param("qualify");
$codec_alaw	= get_param("codec_alaw");
$codec_ulaw	= get_param("codec_ulaw");
$codec_g729	= get_param("codec_g729");
$status			= get_param("status");

if ($codec_alaw=='') {
	$codec_alaw=0;
}
if ($codec_ulaw=='') {
	$codec_ulaw=0;
}
if ($codec_g729=='') {
	$codec_g729=0;
}
//trail log
$reason_log = "cc_pbx_sip_trunk $serverid";

if($v=='del') {
	//delete
	if($iddet!='' && $serverid != '' && $host != '') {
			mysqli_autocommit($condb,FALSE);
			$sql_del  	= "DELETE FROM cc_pbx_sip_trunk 
					   WHERE id = '$iddet'"; 
			// delete device session
			$sql_del_device = "DELETE FROM cc_device_session
						   WHERE server_id = $serverid
						   AND dev_address = '$host'
						   ";
	
						   
			if(mysqli_query($condb,$sql_del) && mysqli_query($condb,$sql_del_device)) {
				if(!mysqli_commit($condb)) {
					$err = mysqli_error($condb);
					//user trail log
					$traildesc = "Delete $reason_log Failed";
					cc_insert_trail_log($v_agentid,$traildesc,$condb);
					echo "Failed : $err";
					
				} else {
					
					//user trail log
					$traildesc = "Delete $reason_log Success";
					cc_insert_trail_log($v_agentid,$traildesc,$condb);
					
					echo "Success";
				}
				
			} else {
				mysqli_rollback($condb);
				//user trail log
				$traildesc = "Delete $reason_log Failed";
				cc_insert_trail_log($v_agentid,$traildesc,$condb);
				
				echo "Failed";
			}
	}
	else{
		//user trail log
		$traildesc = "Delete $reason_log Failed";
		cc_insert_trail_log($v_agentid,$traildesc,$condb);
		
		echo "Failed";
	}
	
} else {
	
	if($iddet!=''){
		//update
		 $sqlu = "UPDATE cc_pbx_sip_trunk SET
					server_id 	='$serverid',
					trunk_name	='$trunk_name',
					context 	='$context',
					con_type 	='$contype',
					host 		='$host',
					dtmfmode 	='$dtmfmode',
					canreinvite ='$canreinvite',
					username 	='$username',
					secret 		='$secret',
					callerid 	='$callerid',
					insecure 	='$insecure',
					qualify 	='$qualify',
					codec_alaw 	='$codec_alaw',
					codec_ulaw 	='$codec_ulaw',
					codec_g729 	='$codec_g729',
					status 		='$status',
					modif_by		='$v_agentid',
					modif_time		=now()
				WHERE id='$iddet'";
		if($rec_u = mysqli_query($condb,$sqlu)) {
			//user trail log
			$traildesc = "Update $reason_log Success";
			cc_insert_trail_log($v_agentid,$traildesc,$condb);
			
			echo "Success";
		} else {
			//user trail log
			$traildesc = "Update $reason_log Failed";
			cc_insert_trail_log($v_agentid,$traildesc,$condb);
			
			echo "Failed";
		}
		
	}else {
		//insert
		 $sqli = "INSERT INTO cc_pbx_sip_trunk SET
					server_id 	='$serverid',
					trunk_name	='$trunk_name',
					context 	='$context',
					con_type 	='$contype',
					host 		='$host',
					dtmfmode 	='$dtmfmode',
					canreinvite ='$canreinvite',
					username 	='$username',
					secret 		='$secret',
					callerid 	='$callerid',
					insecure 	='$insecure',
					qualify 	='$qualify',
					codec_alaw 	='$codec_alaw',
					codec_ulaw 	='$codec_ulaw',
					codec_g729 	='$codec_g729',
					status 		='$status',
					created_by			='$v_agentid',
					insert_time			=now()";
	  	if($rec_i = mysqli_query($condb,$sqli)) {
	  		//user trail log
			$traildesc = "Insert $reason_log Success";
			cc_insert_trail_log($v_agentid,$traildesc,$condb);
			
			echo "Success";
		} else {
			
			//user trail log
			$traildesc = "Insert $reason_log Failed";
			cc_insert_trail_log($v_agentid,$traildesc,$condb);
			
			echo "Failed";
		}
	}
}

disconnectDB($condb);
?>
