<?php
###############################################################################################################
# Date          |    Type    |   Version                                                                      # 
############################################################################################################### 
# 14-05-2025    |   Create   |  1.1.1405.2025                                                                 #
############################################################################################################### 

    include "../../sysconf/con_reff.php";
    include "../../sysconf/global_func.php";
    //include "../../sysconf/session.php";
    include "../../sysconf/db_config.php";

    $condb = connectDB();
    $serverid = $_POST['server'];
    $host = $_POST['host'];

    $sql  = "SELECT * 
             FROM cc_pbx_sip_trunk";
    $where = "";
    if($serverid!=""){
       $where = " Where server_id = $serverid";
    }
    $sql .= $where;
    $sql .=" order by host";
    $res  = mysqli_query($condb,$sql);
    $sel .= "<option value=\"\" selected>--- Selected ---</option>";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $host) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["host"]."</option>";  
       }else{
          $sel .= "<option value=".$rec["id"].">".$rec["host"]."</option>";  
      }
    }
    mysqli_free_result($res);
    echo $sel; 
disconnectDB($condb);
?>
