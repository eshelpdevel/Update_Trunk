<?php
###############################################################################################################
# Date          |    Type    |   Version                                                                      # 
############################################################################################################### 
# 14-05-2025    |   Create   |  1.1.1405.2025                                                                 #
############################################################################################################### 

include "../../sysconf/global_func.php";
include "../../sysconf/session.php";
include "../../sysconf/db_config.php";
// include "global_func_ticket.php";
$condb = connectDB();

function get_paramod($value){
    if ($value == '1') {
        $temp = '0';
    }else{
        $temp = '1';
    }

    return $temp;
}

$v_agentid      = get_session("v_agentid");
$v_agentlevel   = get_session("v_agentlevel");

$server_id      = get_param("server_id");
$mod_astgwy     = get_paramod(get_param("astgwy_mod"));
$mod_astcti     = get_paramod(get_param("astcti_mod"));
$mod_astctigwy  = get_paramod(get_param("astctigwyd_mod"));
$mod_astpdd     = get_paramod(get_param("astpdd_mod"));
$mod_astivrgwy  = get_paramod(get_param("astivrgwyd_mod"));
$mod_astautolog = get_paramod(get_param("astautolog_mod"));
$mod_astalarm   = get_paramod(get_param("astalarmd_mod"));

$sql_updt = "server_id='$server_id'";
if ($mod_astgwy==0) {
    $sql_updt .= ",mod_astgwy = '$mod_astgwy'";
}
if ($mod_astcti==0) {
    $sql_updt .= ",mod_astcti = '$mod_astcti'";
}
if ($mod_astctigwy==0) {
    $sql_updt .= ",mod_astctigwy = '$mod_astctigwy'";
}
if ($mod_astpdd==0) {
    $sql_updt .= ",mod_astpdd = '$mod_astpdd'";
}
if ($mod_astivrgwy==0) {
    $sql_updt .= ",mod_astivrgwy = '$mod_astivrgwy'";
}
if ($mod_astautolog==0) {
    $sql_updt .= ",mod_astautolog = '$mod_astautolog'";
}
if ($mod_astalarm==0) {
    $sql_updt .= ",mod_astalarm = '$mod_astalarm'";
}

// //update
// $sqlu = "UPDATE cc_setting_reload SET
//     $sql_updt 
//     WHERE id='$server_id'";
//update
$sqlu = "INSERT INTO cc_setting_reload SET
    $sql_updt ,
    request_by = '$v_agentid',
    insert_time = now(),
    request_time  = now()
    ON DUPLICATE KEY UPDATE
    $sql_updt ,
    request_by = '$v_agentid',
    insert_time = now(),
    request_time  = now()";
    // echo $sqlu;
    if($rec_u = mysqli_query($condb,$sqlu)) {
        echo "Success";
    }else{    
        echo "Failed";
    }

disconnectDB($condb);
?>