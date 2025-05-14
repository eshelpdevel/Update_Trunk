<?PHP
###############################################################################################################
# Date          |    Type    |   Version                                                                      # 
############################################################################################################### 
# 14-05-2025    |   Create   |  1.1.1405.2025                                                                 #
############################################################################################################### 

  function cc_insert_trail_log($agentid,$traildesc,$condb){
  	$traildesc = mysqli_real_escape_string($condb,$traildesc);
	$sqlin = "INSERT INTO cc_agent_trail_log SET
				agent_id	='$agentid',
				trail_desc	='$traildesc',
				insert_time	=now()";
	mysqli_query($condb,$sqlin);  	
  	
  }

  function cc_get_select_pbx_srvlookup($srvlookup) {
   	$sel1 ="";
   	$sel2 ="";
    if ($srvlookup == "no")
       $sel1 = "selected";
    if ($srvlookup == "yes")
       $sel2 = "selected";
    
    $sel  = "<SELECT id=\"srvlookup\" name=\"srvlookup\" class=\"select2 form-control\">
           
             <option value=\"no\" $sel1>no</option>
             <option value=\"yes\" $sel2>yes</option>
             </SELECT>";
    
    return $sel;   
  }
  
  function cc_get_select_pbx_canreinvite($reinvite) {
   	$sel1 ="";
   	$sel2 ="";
   	$sel3 ="";
   	$sel4 ="";
   	$sel5 ="";
    if ($reinvite == "no")
       $sel1 = "selected";
    else if ($reinvite == "yes")
       $sel2 = "selected";
    else if ($reinvite == "nonat")
       $sel3 = "selected";
    else if ($reinvite == "update")
       $sel4 = "selected";
    else if ($reinvite == "update,nonat")
       $sel5 = "selected";                            
    
    $sel  = "<SELECT id=\"canreinvite\" name=\"canreinvite\" class=\"select2 form-control\">
             <option value=\"no\" $sel1>no</option>
             <option value=\"yes\" $sel2>yes</option>
             <option value=\"nonat\" $sel3>nonat</option>
             <option value=\"update\" $sel4>update</option>
             <option value=\"update,nonat\" $sel5>update,nonat</option>
             </SELECT>";
    
    return $sel;   
  }  
  
   function cc_get_select_server($serverid,$condb) {
     $sql  = "SELECT * 
             FROM cc_server
             ORDER BY server_hostname";
    $res	= mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"server_id\" name=\"server_id\" class=\"select2 form-control serverid required\" required>";
    $sel .= "<option value=\"\" selected>--- Selected ---</option>";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $serverid) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["server_hostname"]." / ".$rec["server_ip"]."</option>";  
       }else{
	   	 $sel .= "<option value=".$rec["id"].">".$rec["server_hostname"]." / ".$rec["server_ip"]."</option>";  
	   }
    }                                        
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }
  
  function cc_get_select_status_enable($idname, $name, $status) {
    $sel0 = "";
    $sel1 = "";
    
    if ($status == "0")
       $sel0 = "selected";
    else if ($status == "1")   
       $sel1 = "selected";
       
    $selectout = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\" style=\"width:100%;\">     
                    <option value=\"0\" $sel0>Disable</option>
                    <option value=\"1\" $sel1>Enable</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_status_training($idname, $name, $status) {
    $sel0 = "";
    $sel1 = "";
    $sel2 = "";
    $sel3 = "";
    
    if ($status == "0")
       $sel0 = "selected";
    else if ($status == "1")   
       $sel1 = "selected";
    else if ($status == "2")   
       $sel2 = "selected";
    else if ($status == "3")   
       $sel3 = "selected";
       
    $selectout = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\" style=\"width:100%;\">     
                    <option value=\"0\" $sel0>NEW</option>
                    <option value=\"1\" $sel1>IN PROGRESS</option>
                    <option value=\"2\" $sel2>DONE</option>
                    <option value=\"3\" $sel3>NOT</option>
                  </SELECT>";
                  
    return $selectout;                     
  }
  
  function cc_get_select_status_enable2($idname, $name, $status) {
    $sel0 = "";
    $sel1 = "";
    
    if ($status == "0")
       $sel0 = "selected";
    else if ($status == "1")   
       $sel1 = "selected";
       
    $selectout = "<SELECT id=\"$idname\" name=\"$name\" class=\"form-control\">     
                    <option value=\"0\" $sel0>Disable</option>
                    <option value=\"1\" $sel1>Enable</option>
                  </SELECT>";
                  
    return $selectout;                     
  }
  
   
  function cc_get_default_status_al($idname, $name, $status) {
    $sel0 = "";
    $sel1 = "";
    
    if ($status == "1")
       $sel0 = "selected";
    else if ($status == "10")   
       $sel1 = "selected";
       
    $selectout = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\">     
                    <option value=\"1\" $sel0>Autoin</option>
                    <option value=\"10\" $sel1>Outbound</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

   function cc_get_select_status_auxwork($idname, $name, $status) {
    $sel0 = "";
    $sel1 = "";
    
    if ($status == "0")
       $sel0 = "selected";
    else if ($status == "1")   
       $sel1 = "selected";
       
    $selectout = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\">     
                    <option value=\"0\" $sel0>Not Work</option>
                    <option value=\"1\" $sel1>Aux Work</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_host($host,$condb) {

     $sql  = "SELECT * 
             FROM cc_pbx_sip_trunk
             ORDER BY host";
    $res  = mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"host_id\" name=\"host_id\" class=\"select2 form-control host\">";
    $sel .= "<option value=\"\" selected>--- Selected ---</option>";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $host) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["host"]."</option>";  
       }else{
       $sel .= "<option value=".$rec["id"].">".$rec["host"]."</option>";  
     }
    }                                        
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }

  function get_select_qos_type($qostype) {
    $sel0 = "";
    $sel1 = "";
    $sel2 = "";
    
    if ($qostype == "1")
       $sel1 = "selected";
    else if ($qostype == "2")   
       $sel2 = "selected";
    else if ($qostype == "0")   
       $sel0 = "selected";       
       
    $selectout = "<SELECT id=\"QoS Type\" name=\"qos_type\" class=\"form-control\">     
                    <option value=\"0\" $sel0>All passed</option>
                    <option value=\"1\" $sel1>Allowed by privileges</option>
                    <option value=\"2\" $sel2>Blocked by privileges</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_acc($acctype) {
    $sel1 = "";
    $sel2 = "";
    
    if ($acctype == "1")
       $sel1 = "selected";
    else if ($acctype == "2")   
       $sel2 = "selected";      
       
    $selectout = "<SELECT id=\"acc_type\" name=\"acc_type\" class=\"form-control\">     
                    <option value=\"1\" $sel1>Extension</option>
                    <option value=\"2\" $sel2>Context</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_spy($spytype) {
    $sel1 = "";
    $sel2 = "";
    
    if ($spytype == "q")
       $sel1 = "selected";
    else if ($spytype == "qw")   
       $sel2 = "selected";      
       
    $selectout = "<SELECT id=\"spy_type\" name=\"spy_type\" class=\"form-control\">     
                    <option value=\"q\" $sel1>observing</option>
                    <option value=\"qw\" $sel2>coaching</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_skill($id, $name, $idskill, $condb) {

     $sql  = "SELECT a.id, a.skill_id, a.skill_name 
             FROM cc_skill a
             ORDER BY a.id ASC";
    $res  = mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"$id\" name=\"$name\" class=\"select2 form-control skill\" style=\"width:100%;\">";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $idskill) {
          $sel .= "<option value=".$rec["id"]." selected>".inj($rec["skill_id"])." / ".inj($rec["skill_name"])."</option>";  
       } else {
          $sel .= "<option value=".$rec["id"]." >".inj($rec["skill_id"])." / ".inj($rec["skill_name"])."</option>";  
     }
    }                                        
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }

  function get_select_pbx_contype($contype) {
    $sel1 = "";
    $sel2 = "";
    
    if ($contype == "friend")
       $sel1 = "selected";
    else if ($contype == "peer")   
       $sel2 = "selected";      
       
    $selectout = "<SELECT id=\"con_type\" name=\"con_type\" class=\"form-control\">     
                    <option value=\"friend\" $sel1>friend</option>
                    <option value=\"peer\" $sel2>peer</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function get_new_select_pbx_contype($contype) {
    $sel1 = "";
    $sel2 = "";
    
    if ($contype == "friend")
       $sel1 = "selected";
    else if ($contype == "peer")   
       $sel2 = "selected";
    else if ($contype == "endpoint")
       $sel3 = "selected";
       
    $selectout = "<SELECT id=\"con_type\" name=\"con_type\" class=\"form-control\">     
                    <option value=\"friend\" $sel1>friend</option>
                    <option value=\"peer\" $sel2>peer</option>
                    <option value=\"endpoint\" $sel3>endpoint</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function get_select_pbx_dtmf($dtmf) {
    $sel1 = "";
    $sel2 = "";
    
    if ($dtmf == "rfc2833")
       $sel1 = "selected";
    else if ($dtmf == "inband")   
       $sel2 = "selected";      
       
    $selectout = "<SELECT id=\"dtmfmode\" name=\"dtmfmode\" class=\"form-control\">     
                    <option value=\"rfc2833\" $sel1>rfc2833</option>
                    <option value=\"inband\" $sel2>inband</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function get_select_pbx_canreinvite($crinvite) {
    $sel1 = "";
    $sel2 = "";
    $sel3 = "";
    $sel4 = "";
    $sel5 = "";
    
    if ($crinvite == "yes")
       $sel1 = "selected";
    else if ($crinvite == "no")   
       $sel2 = "selected";
    else if ($crinvite == "nonat")   
       $sel3 = "selected";
    else if ($crinvite == "update")   
       $sel4 = "selected";
    else if ($crinvite == "update,nonat")   
       $sel5 = "selected";      
       
    $selectout = "<SELECT id=\"canreinvite\" name=\"canreinvite\" class=\"form-control\">     
                    <option value=\"yes\" $sel1>yes</option>
                    <option value=\"no\" $sel2>no</option>
                    <option value=\"nonat\" $sel3>nonat</option>
                    <option value=\"update\" $sel4>update</option>
                    <option value=\"update,nonat\" $sel5>update,nonat</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_insecure($inscr) {
    $sel1 = "";
    $sel2 = "";
    $sel3 = "";
    
    if ($inscr == "port")
       $sel1 = "selected";
    else if ($inscr == "invite")   
       $sel2 = "selected";
    else if ($inscr == "port,invite")   
       $sel3 = "selected";
       
    $selectout = "<SELECT id=\"insecure\" name=\"insecure\" class=\"form-control\">     
                    <option value=\"\" selected>--- Select ---</option>
                    <option value=\"port\" $sel1>port</option>
                    <option value=\"invite\" $sel2>invite</option>
                    <option value=\"port,invite\" $sel3>port,invite</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_qualify($qlfy) {
    $sel1 = "";
    $sel2 = "";
    
    if ($qlfy == "yes")
       $sel1 = "selected";
    else if ($qlfy == "no")   
       $sel2 = "selected";      
       
    $selectout = "<SELECT id=\"qualify\" name=\"qualify\" class=\"form-control\">     
                    <option value=\"yes\" $sel1>yes</option>
                    <option value=\"no\" $sel2>no</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_status_blocked($idname, $name, $status) {
    $sel0 = "";
    $sel1 = "";
    
    if ($status == "0")
       $sel0 = "selected";
    else if ($status == "1")   
       $sel1 = "selected";
     else if ($status == "2")   
       $sel2 = "selected";
       
    $selectout = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\">     
                    <option value=\"1\" $sel1>Trash</option>
                    <option value=\"2\" $sel2>Blacklist</option>
                    <option value=\"0\" $sel0>Reopen</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_skill_feature($idname,$name,$value) {
    $dataSkill = array(  
            array(1,"Auto In"),
            array(10,"Outbound"),
            array(11,"Email"),
            array(12,"SMS"),
            array(13,"Fax"),
            array(14,"Livechat"),
            array(21,"Facebook"),
            array(22,"Messenger"),
            array(23,"Twitter"),
            array(24,"Instagram"),
            array(25,"WhatsApp"),
            array(26,"Telegram"),
            array(27,"Line"),
            array(30,"Other")
          );
    $sel   = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\">";
    for ($i=0; $i <count($dataSkill) ; $i++) { 
      if ($dataSkill[$i][0] == $value) {
          $sel  .= "<option value=\"".$dataSkill[$i][0]."\" selected>".$dataSkill[$i][1]."</option>";
      }else{
          $sel  .= "<option value=\"".$dataSkill[$i][0]."\">".$dataSkill[$i][1]."</option>";
      }
    }
    
    $sel  .= "</SELECT>";
    
    return $sel;   
  }
  
  
   function cc_get_agent_level($selval) {
    $sel1 = "";
    $sel2 = "";
    $sel3 = "";
    $sel4 = "";
    $sel5 = "";
    $sel6 = "";
    
    if ($selval == "1")
       $sel1 = "selected";
    else if ($selval == "2")   
       $sel2 = "selected"; 
    else if ($selval == "3")   
       $sel3 = "selected"; 
    else if ($selval == "4")   
       $sel4 = "selected"; 
    else if ($selval == "5")   
       $sel5 = "selected"; 
    else if ($selval == "6")   
       $sel6 = "selected";      

    $selectout = "<SELECT id=\"agent_level\" name=\"agent_level\" class=\"form-control select2\">     
                    <option value=\"1\" $sel1>Agent</option>
                    <option value=\"2\" $sel2>SPV</option>
                    <option value=\"3\" $sel3>Admin</option>
                    <option value=\"4\" $sel4>Support</option>
                    <option value=\"5\" $sel5>Developer</option>
                    <option value=\"6\" $sel6>Other</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_agent($id,$name,$default,$lev,$condb) {

     $sql  = "SELECT * 
             FROM cc_agent_profile
             WHERE agent_level IN($lev)
             ORDER BY id";
    $res  = mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"$id\" name=\"$name\" class=\"select2 form-control host\">";
    $sel .= "<option value=\"\" selected>--- Selected ---</option>";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $default) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["agent_id"]." / ".$rec["agent_name"]."</option>";  
       }else{
       $sel .= "<option value=".$rec["id"].">".$rec["agent_id"]." / ".$rec["agent_name"]."</option>";  
     }
    }                                        
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }

  function cc_get_route_acww($idname, $name, $status) {
    $sel0 = "";
    $sel1 = "";
    
    if ($status == "0")
       $sel0 = "selected";
    else if ($status == "1")   
       $sel1 = "selected";
       
    $selectout = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\">     
                    <option value=\"0\" $sel0>No Route</option>
                    <option value=\"1\" $sel1>Routed If Call VVIP</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function cc_get_select_group($id, $name, $idgroup, $condb) {

     $sql  = "SELECT a.id, a.group_id, a.group_name 
             FROM cc_group_profile a
             ORDER BY a.id ASC";
    $res  = mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"$id\" name=\"$name\" class=\"select2 form-control skill\" style=\"width:100%;\">";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $idgroup) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["group_id"]." / ".$rec["group_name"]."</option>";  
       } else {
          $sel .= "<option value=".$rec["id"]." >".$rec["group_id"]." / ".$rec["group_name"]."</option>";  
     }
    }                                        
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }

  function cc_get_select_leader($id, $name, $idleader, $condb) {

     $sqlxx  = "SELECT a.id, a.agent_name 
             FROM cc_agent_profile a
             WHERE a.agent_level = '2'
             ORDER BY a.id ASC";
    $resxx  = mysqli_query($condb,$sqlxx); //multiple
    $sel  = "<SELECT id=\"$id\" name=\"$name\" class=\"select2 form-control skill\" style=\"width:100%;\" >";
    //$sel .= "<option value=''>-- Selected --</option>";
    while($recxx = mysqli_fetch_array($resxx)) {
       if ($recxx["id"] == $idleader) {
          $sel .= "<option value=".$recxx["id"]." selected>".$recxx["agent_name"]."</option>";  
       } else {
          $sel .= "<option value=".$recxx["id"]." >".$recxx["agent_name"]."</option>";  
     }
    }                                        
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }

  function get_select_extension_by_id($id, $name, $extid, $condb) {
      $sel  = "<select id=\"$id\" name=\"$name\" class=\"select2 form-control\" style=\"width:100%;\" >";
      $sql  = "SELECT a.id, a.ext_number 
                       FROM cc_extension a 
                       WHERE a.status = '1'
                       ORDER BY a.ext_number";
      $res  = mysqli_query($condb, $sql);
      while($rec = mysqli_fetch_array($res)) {
         if ($rec["id"] == $extid) {
            $sel .= "<option value=".$rec["id"]." selected>".$rec["ext_number"]."</option>";
         } else {
            $sel .= "<option value=".$rec["id"].">".$rec["ext_number"]."</option>";
         }
      }                                        
      $sel .= "</select>";
      
      mysqli_free_result($res);
      return $sel; 
    }  

    function cc_get_select_pdd_need_data($idname, $name, $status) {
    $sel0 = "";
    $sel1 = "";
    
    if ($status == "0")
       $sel0 = "selected";
    else if ($status == "1")   
       $sel1 = "selected";
       
    $selectout = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\">     
                    <option value=\"0\" $sel0>Already Exist</option>
                    <option value=\"1\" $sel1>Not Exist</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function get_sselect_group($condb, $id, $name, $groupid) {
      $sel  = "<select id=\"$id\" name=\"$name\" class=\"select2 form-control\" style=\"width:100%;\">";
      $sel  .= "<option value=''>--- SELECTED ---</option>";
      $sql  = "select a.id, a.group_id, a.group_name from cc_group_profile a";
      $res  = mysqli_query($condb, $sql);
      while($rec = mysqli_fetch_array($res)) {
         if ($rec["id"] == "$groupid") {
            $sel .= "<option value=".$rec["id"]." selected>".$rec["group_id"]." / ".$rec["group_name"]."</option>";
         } else {
            $sel .= "<option value=".$rec["id"].">".$rec["group_id"]." / ".$rec["group_name"]."</option>";
         }
      }                                        
      $sel .= "</select>";
      
      mysqli_free_result($res);
      return $sel; 
    }
    
    
     function cc_get_reason($reasonstatus,$condb) {

     $sql  = "SELECT id, aux_code FROM cc_aux_reason WHERE status=1 ORDER BY aux_code ASC";
    $res  = mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"reason_id\" name=\"reason_id\" class=\"select2 form-control host\">";
    //$sel .= "<option value=\"\" selected>--- Selected ---</option>";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $reasonstatus) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["aux_code"]."</option>";  
       }else{
       $sel .= "<option value=".$rec["id"].">".$rec["aux_code"]."</option>";  
     }
    }                                        
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }

  function get_page_privilleges($condb, $fileback) {
      $priv = "0|0|0|0";
      $id   = 0;
      $sql  = "SELECT id from cc_app_menu where file_name = '$fileback'";
      $res  = mysqli_query($condb, $sql);
      while($rec = mysqli_fetch_array($res)) {
           $id   = $rec['id'];

      }                                        
      mysqli_free_result($res);

      $sql2  = "SELECT priv_view,priv_add,priv_edit,priv_delete from cc_skill_menu where menu_id = '$id'";
      $res  = mysqli_query($condb, $sql2);
      while($rec = mysqli_fetch_array($res)) {
           $priv_view     = $rec['priv_view'];
           $priv_add      = $rec['priv_add'];
           $priv_edit     = $rec['priv_edit'];
           $priv_delete   = $rec['priv_delete'];
           $priv = "$priv_view|$priv_add|$priv_edit|$priv_delete";
      }                                        
      mysqli_free_result($res);
      return $priv; 
    }

function cc_get_select_skill_sel($id, $name, $idskill, $condb) {

     $sql  = "SELECT a.id, a.skill_id, a.skill_name 
             FROM cc_skill a
             ORDER BY a.id ASC";
    $res  = mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"cmbskill\" name=\"cmbskill[]\" multiple=\"multiple\" class=\"SlectBox form-control\" style=\"width:100%;\">";
     $sel .= "<option value=''>--All--</option>";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $idskill) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["skill_id"]." / ".$rec["skill_name"]."</option>";  
       } else {
          $sel .= "<option value=".$rec["id"]." >".$rec["skill_id"]." / ".$rec["skill_name"]."</option>";  
     }
    }                                        
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }
  
   function cc_get_select_group_sel($id, $name, $idgroup, $condb) {

     $sql  = "SELECT a.id, a.group_id, a.group_name 
             FROM cc_group_profile a
             ORDER BY a.id ASC";
    $res  = mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"cmbgroup\" name=\"cmbgroup[]\" multiple=\"multiple\" class=\"SlectBox form-control\" style=\"width:100%;\">";
    $sel .= "<option value=''>--All--</option>";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $idgroup) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["group_id"]." / ".$rec["group_name"]."</option>";  
       } else {
          $sel .= "<option value=".$rec["id"]." >".$rec["group_id"]." / ".$rec["group_name"]."</option>";  
     }
    }                                        
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }
  
   function cc_get_select_server_sel($serverid,$condb) {
     $sql  = "SELECT * 
             FROM cc_server
             ORDER BY server_hostname";
    $res	= mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"server_id\" multiple=\"multiple\" name=\"server_id[]\" class=\"SlectBox form-control \">";
     $sel .= "<option value=''>--All--</option>";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $serverid) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["server_hostname"]." / ".$rec["server_ip"]."</option>";  
       }else{
	   	 $sel .= "<option value=".$rec["id"].">".$rec["server_hostname"]." / ".$rec["server_ip"]."</option>";  
	   }
    }                                        
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }

  function get_select_other_status($other) {
    $sel0 = "";
    $sel1 = "";
    $sel2 = "";
    
    if ($other == "1")
       $sel1 = "selected";
    else if ($other == "2")   
       $sel2 = "selected";
    else if ($other == "0")   
       $sel0 = "selected";       
       
    $selectout = "<SELECT id=\"other_status\" name=\"other_status\" class=\"form-control\">     
                    <option value=\"0\" $sel0>All passed</option>
                    <option value=\"1\" $sel1>Allowed by privileges</option>
                    <option value=\"2\" $sel2>Blocked by privileges</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function get_select_status_autoin($id, $name, $autoid) {
    $sel1 = "";
    $sel2 = "";
    
    if ($autoid == "1")
       $sel1 = "selected";
    else if ($autoid == "10")   
       $sel2 = "selected";      
       
    $selectout = "<SELECT id=\"$id\" name=\"$name\" class=\"form-control\">     
                    <option value=\"1\" $sel1>Autoin</option>
                    <option value=\"10\" $sel2>Outbound</option>
                  </SELECT>";
                  
    return $selectout;                     
  }
  
  function cc_get_priority($idname, $name, $status, $x) {
    $sel0 = "";
    $sel1 = "";
    $sel2 = "";
    $sel3 = "";
    $sel4 = "";
    $sel5 = "";
    $sel6 = "";
    $sel7 = "";
    $sel8 = "";
    $sel9 = "";

    if ($status == "1")
       $sel0 = "selected";
    else if ($status == "2")   
       $sel1 = "selected";
    else if ($status == "3")   
       $sel2 = "selected";
    else if ($status == "4")   
       $sel3 = "selected";
    else if ($status == "5")   
       $sel4 = "selected";
    else if ($status == "6")   
       $sel5 = "selected";
    else if ($status == "7")   
       $sel6 = "selected";
    else if ($status == "8")   
       $sel7 = "selected";
    else if ($status == "9")   
       $sel8 = "selected";
    else if ($status == "10")   
       $sel9 = "selected";
       
    $selectout = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\" palace holder=\"Priority $x\">     
                    <option value=\"1\" $sel0>1</option>
                    <option value=\"2\" $sel1>2</option>
                    <option value=\"3\" $sel1>3</option>
                    <option value=\"4\" $sel1>4</option>
                    <option value=\"5\" $sel1>5</option>
                    <option value=\"6\" $sel1>6</option>
                    <option value=\"7\" $sel1>7</option>
                    <option value=\"8\" $sel1>8</option>
                    <option value=\"9\" $sel1>9</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

function cc_get_language($id, $name, $status) {
    if ($status == "id")
       $sel0 = "selected";
    else if ($status == "en")   
       $sel1 = "selected";

    $sel = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\" palace holder=\"Priority $x\">     
                    <option value=\"id\" $sel0>Indonesia</option>
                    <option value=\"en\" $sel1>English</option>";                                      
    $sel .= "</SELECT>";
    return $sel; 
  }

  function cc_get_select_cat($id, $name, $idcat, $condb) {

     $sql  = "SELECT a.id, a.category 
             FROM cc_campaign_category a
             ORDER BY a.id ASC";
    $res  = mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"$id\" name=\"$name\" class=\"select2 form-control skill\" style=\"width:100%;\" onchange=\"addnew();\">";
    $sel .= "<option value=\"\" >--SELECTED--</option>";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $idcat) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["category"]."</option>";  
       } else {
          $sel .= "<option value=".$rec["id"]." >".$rec["category"]."</option>";  
     }
    }    
    $sel .= "<option value=\"0\" >ADD NEW</option>";                                    
    $sel .= "</SELECT>";
    
    mysqli_free_result($res);
    return $sel; 
  }

  function label_form_det2($txtlabel,$bodycontent,$x){
     $temp ="";
     for($z=0; $z < $x; $z++) {
       $txtlabel[$z] = $txtlabel[$z];
      $temp .= "<div class=\"row\" id=\"divtype[$z]\" style =\"display:none;\">
                  <div class=\"col-md-12\">
                    <div class=\"form-group\" style=\"text-align:left\">
                      <label for=\"$txtlabel[$z]\">$txtlabel[$z]</label>
                      $bodycontent[$z]
                    </div>
                  </div>
                </div>";
      }
  return $temp;
}

function cc_get_select_pdd_type($id, $name, $status) {
    if ($status == "0")
       $sel0 = "selected";
    else if ($status == "1")   
       $sel1 = "selected";

    $sel = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\" palace holder=\"Priority $x\">     
                    <option value=\"0\" $sel0>Non-Blended</option>
                    <option value=\"1\" $sel1>Blended</option>";                                      
    $sel .= "</SELECT>";
    return $sel; 
  }

function cc_get_select_pdd_over_group($id, $name, $status) {
    if ($status == "0")
       $sel0 = "selected";
    else if ($status == "1")   
       $sel1 = "selected";

    $sel = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\" palace holder=\"Priority $x\">     
                    <option value=\"0\" $sel0>Non-Overflow</option>
                    <option value=\"1\" $sel1>Overflow</option>";                                      
    $sel .= "</SELECT>";
    return $sel; 
  }

function cc_get_select_pdd_over($idname, $name, $status) {
    $sel0 = "";
    $sel1 = "";
    
    if ($status == "0")
       $sel0 = "selected";
    else if ($status == "1")   
       $sel1 = "selected";
       
    $selectout = "<SELECT id=\"$idname\" name=\"$name\" class=\"select2 form-control\" style=\"width:100%;\">     
                    <option value=\"0\" $sel0>Disable</option>
                    <option value=\"1\" $sel1>Enable</option>
                  </SELECT>";
                  
    return $selectout;                     
  }

  function report_get_select_group($id, $name, $idgroup, $condb) {

     $sql  = "SELECT a.id, a.group_id, a.group_name 
             FROM cc_group_profile a
             ORDER BY a.id ASC";
    $res  = mysqli_query($condb,$sql);
    $sel  = "<SELECT id=\"$id\" name=\"$name\" class=\"select2 form-control skill\" style=\"width:100%;\">";
    $sel  .= "<option value=''>-- Select --</option>";
    while($rec = mysqli_fetch_array($res)) {
       if ($rec["id"] == $idgroup) {
          $sel .= "<option value=".$rec["id"]." selected>".$rec["group_id"]." / ".$rec["group_name"]."</option>";  
       } else {
          $sel .= "<option value=".$rec["id"]." >".$rec["group_id"]." / ".$rec["group_name"]."</option>";  
     }
    }                                        
    $sel .= "</select>";
    
    mysqli_free_result($res);
    return $sel; 
  }
  
   function get_select_score_qm($id, $name, $max, $sla) {

    $sel  = "<select id=\"$id\" name=\"$name\" class=\"select2 form-control\">";
    if (is_numeric($max)) {
      for ($i=0; $i <= $max; $i++) { 
        if($i == $sla) {
          $sel .= "<option value=\"$i\" selected> $i </option>";
        } else {
          $sel .= "<option value=\"$i\" > $i </option>";
        }
        
      }
    }else{
      for ($i=0; $i <= 1; $i++) { 
        if ($i == 0) {
          $iname = "Yes";
        }else if ($i == 1) {
          $iname = "No";
        }
        if($i == $sla) {
          $sel .= "<option value=\"$i\" selected> $iname </option>";
        } else {
          $sel .= "<option value=\"$i\" > $iname </option>";
        }
      }
    }
    $sel  .= "</select>";

    return $sel;
  }

  
  function cc_get_map_skill($id, $name, $idskill, $condb) {
   
   $whr = " AND b.map_skill IS NULL ";
   if($idskill != "") {
      $whr = " AND a.id = '".$idskill."' ";
   }

$sql  = " SELECT a.id, a.skill_id, a.skill_name, b.map_skill FROM cc_skill a
LEFT JOIN cc_skill_mapping b ON (a.id=b.map_skill) WHERE 1=1 ".$whr."
        ORDER BY a.id ASC ";
$res  = mysqli_query($condb,$sql);
$sel  = "<select id=\"$id\" name=\"$name\" class=\"select2 form-control skill\" style=\"width:100%;\">";
while($rec = mysqli_fetch_array($res)) {
  if ($rec["id"] == $idskill) {
     $sel .= "<option value=".$rec["id"]." selected>".inj($rec["skill_id"])." / ".inj($rec["skill_name"])."</option>";  
  } else {
     $sel .= "<option value=".$rec["id"]." >".inj($rec["skill_id"])." / ".inj($rec["skill_name"])."</option>"; 
  }
}                                        
$sel .= "</select>";

mysqli_free_result($res);
return $sel; 
}

  function cc_get_select_map_source_data($id, $name, $idmaps, $condb) {
      $sel  = "<select id=\"$id\" name=\"$name\" multiple=\"multiple\" class=\"SlectBox form-control\" style=\"width:100%;\">";
      if($idmaps != "") {
         $sql  = " SELECT a.id, a.source FROM cc_master_source a 
         WHERE a.`status` = '1' AND a.id IN(".$idmaps.") ORDER BY a.id ASC ";
         $res  = mysqli_query($condb,$sql);
         while($rec = mysqli_fetch_array($res)) {
            $sel .= "<option value=".$rec["id"]." selected>".$rec["source"]."</option>";
         }  
      }                       
      $sel .= "</select>";

      mysqli_free_result($res);
      return $sel; 
   }

   function cc_get_select_map_region($id, $name, $idmaps, $condb) {
      $sel  = "<select id=\"$id\" name=\"$name\" multiple=\"multiple\" class=\"SlectBox form-control\" style=\"width:100%;\">";
      if($idmaps != "") {
         $sql  = " SELECT a.id, CONCAT(a.region_code, ' - ', a.region_name) AS map_region 
      FROM cc_master_region a WHERE a.id IN(".$idmaps.") ORDER BY a.id ASC ";
         $res  = mysqli_query($condb,$sql);
         while($rec = mysqli_fetch_array($res)) {
            $sel .= "<option value=".$rec["id"]." selected>".$rec["map_region"]."</option>";
         }  
      }                       
      $sel .= "</select>";

      mysqli_free_result($res);
      return $sel; 
   }

   function cc_get_select_map_office($id, $name, $idmaps, $condb) {
      $sel  = "<select id=\"$id\" name=\"$name\" multiple=\"multiple\" class=\"SlectBox form-control\" style=\"width:100%;\">";
      if($idmaps != "") {
         $sql  = " SELECT a.id, CONCAT(a.office_short_name, ' - ', a.office_name) AS map_office FROM cc_master_cabang a WHERE a.id IN(".$idmaps.") ORDER BY a.id ASC ";
         $res  = mysqli_query($condb,$sql);
         while($rec = mysqli_fetch_array($res)) {
            $sel .= "<option value=".$rec["id"]." selected>".$rec["map_office"]."</option>";
         }  
      }                       
      $sel .= "</select>";

      mysqli_free_result($res);
      return $sel; 
   }

   function cc_get_select_map_lob($id, $name, $idmaps, $required, $condb) {
      
      $isarray = explode(",", $idmaps);
         $data[] = "";
         foreach ($isarray as $key => $value) {
            $data[$value] = $value;
         }

      $sel = "<select id=\"$id\" name=\"$name\" class=\"select2 form-control\" style=\"width:100%;\" multiple=\"multiple\" $required>";
      if($data[0] == "0") {
            $sel .= "<option value=\"0\" selected>ALL</option>";  
      } else {
            $sel .= "<option value=\"0\">ALL</option>";
      }
      $sql_str1 = " SELECT a.id, a.lob_code, CONCAT(a.lob_code, ' - ', a.lob_name) AS map_lob FROM cc_ts_lob a 
      GROUP BY a.lob_code ORDER BY a.id ASC ";
      $sql_res1  = execSQL($condb, $sql_str1);
      while ($sql_rec1 = mysqli_fetch_array($sql_res1)) {
         $sid = $sql_rec1['lob_code'];
         if($sid == $data[$sid]) {
            $sel .= "<option value=\"".$sql_rec1['lob_code']."\" selected>".$sql_rec1['map_lob']."</option>";  
         } else {
            $sel .= "<option value=\"".$sql_rec1['lob_code']."\" >".$sql_rec1['map_lob']."</option>";
         }
      }
      $sel .= "</select>";

      return $sel;

      // $sel  = "<select id=\"$id\" name=\"$name\" multiple=\"multiple\" class=\"SlectBox form-control\" style=\"width:100%;\">";
      // if($idmaps != "") {
      //    $sql  = " SELECT a.id, CONCAT(a.lob_code, ' - ', a.lob_name) AS map_lob 
      // FROM cc_ts_lob a WHERE a.id IN(".$idmaps.") ORDER BY a.id ASC ";
      //    $res  = mysqli_query($condb,$sql);
      //    while($rec = mysqli_fetch_array($res)) {
      //       $sel .= "<option value=".$rec["id"]." selected>".$rec["map_lob"]."</option>";
      //    }  
      // }                       
      // $sel .= "</select>";

      // mysqli_free_result($res);
      // return $sel; 
   }

   function cc_get_select_map_product($id, $name, $idmaps, $condb) {
      $sel  = "<select id=\"$id\" name=\"$name\" multiple=\"multiple\" class=\"SlectBox form-control\" style=\"width:100%;\">";
      if($idmaps != "") {
         $sql  = " SELECT a.id, CONCAT(a.product_code, ' - ', a.product_name) AS map_product 
      FROM cc_master_product a WHERE a.product_code != '' AND a.product_name != '' AND a.id IN(".$idmaps.") ORDER BY a.id ASC ";
         $res  = mysqli_query($condb,$sql);
         while($rec = mysqli_fetch_array($res)) {
            $sel .= "<option value=".$rec["id"]." selected>".$rec["map_product"]."</option>";
         }  
      }                       
      $sel .= "</select>";

      mysqli_free_result($res);
      return $sel; 
   }
?>
