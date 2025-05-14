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

$iddet 			= $library['iddet'];

$ffolder		= $library['folder'];
$fmenu_link		= $library['menu_link'];
$fdescription	= $library['description'];
$fmenu_id		= $library['menu_id'];
$ficon			= $library['icon'];
$fiddet			= $library['iddet'];
$fblist			= $library['blist'];

$fmenu_link_back = "cc_trunk_out_group_list";
    	
$blist 			= $library['blist'];
$strblist       = explode(";", $blist); 
$blist_date		= $strblist[0];
$blist_fcount	= $strblist[1];
$blist_csearch0	= $strblist[2];
$blist_tsearch0	= $strblist[3];
$blist_csearch1	= $strblist[4];
$blist_tsearch1	= $strblist[5];
$blist_csearch2	= $strblist[6];
$blist_tsearch2	= $strblist[7];
$blist_csearch3	= $strblist[8];
$blist_tsearch3	= $strblist[9];
$blist_csearch4	= $strblist[10];
$blist_tsearch4	= $strblist[11];

$serverid		= get_param("serverid");
$context		= get_param("context");
$spy_type		= get_param("spy_type");
$acc_number		= get_param("acc_number");
$status			= get_param("status");


if($iddet!=''){
	$sqlv = "SELECT * 
		FROM cc_trunk_out_group a 
                WHERE a.id > 0
                      AND a.id='$iddet'"; //echo "$sqlv";
	$resv = mysqli_query($condb,$sqlv);
	if($recv = mysqli_fetch_array($resv)){
		$serverid			= $recv['server_id'];
		$groupid			= $recv['group_id'];
		$context			= $recv['context'];
		$acc_number		    = $recv['acc_number'];
		$spy_type		    = $recv['spy_type'];
		$status				= $recv['status'];

	}
}
//file save data
$save_form = "view/cc/cc_trunk_out_group_save.php";

if($iddet  == "") {
	$desc_iddet = "Create New";
}else{
	$desc_iddet = "View";
}


?>
<form name="frmDataDet" id="frmDataDet" method="POST"><?php $idsec = get_session('idsec'); ?> <input type="hidden" name="idsec" id="idsec" value="<?php echo $idsec;?>">
<input type="hidden" name="iddet" id="iddet" value="<?php echo $iddet;?>">

<input type="hidden" name="blist_date" id="blist_date" value="<?php echo $blist_date;?>">
<input type="hidden" name="blist_fcount" id="blist_fcount" value="<?php echo $blist_fcount;?>">
<input type="hidden" name="blist_csearch0" id="blist_csearch0" value="<?php echo $blist_csearch0;?>">
<input type="hidden" name="blist_tsearch0" id="blist_tsearch0" value="<?php echo $blist_tsearch0;?>">
<input type="hidden" name="blist_csearch1" id="blist_csearch1" value="<?php echo $blist_csearch1;?>">
<input type="hidden" name="blist_tsearch1" id="blist_tsearch1" value="<?php echo $blist_tsearch1;?>">
<input type="hidden" name="blist_csearch2" id="blist_csearch2" value="<?php echo $blist_csearch2;?>">
<input type="hidden" name="blist_tsearch2" id="blist_tsearch2" value="<?php echo $blist_tsearch2;?>">
<input type="hidden" name="blist_csearch3" id="blist_csearch3" value="<?php echo $blist_csearch3;?>">
<input type="hidden" name="blist_tsearch3" id="blist_tsearch3" value="<?php echo $blist_tsearch3;?>">
<input type="hidden" name="blist_csearch4" id="blist_csearch4" value="<?php echo $blist_csearch4;?>">
<input type="hidden" name="blist_tsearch4" id="blist_tsearch4" value="<?php echo $blist_tsearch4;?>">
<input type="hidden" name="srv_id" id="srv_id" value="">


<div class="page-inner">
	<div class="page-header"  style="margin-bottom:0px;margin-top:-15px;padding-left:0px;padding:0px;margin-left:-20px;">
		<ul class="breadcrumbs" style="border-left:0px;margin:0px;">
			<li class="nav-home">
				<a href="index.php">
					<i class="fas fa-home"></i>
				</a>
			</li>
			<li class="separator">
				<i class="fas fa-chevron-right"></i>
			</li>
			<?php
				$menu_tree = explode("|", $library['page']);
				for ($i=0; $i <count($menu_tree) ; $i++) { 
					if ($i != 0) {
						echo "<li class=\"separator\"><i class=\"fas fa-chevron-right\"></i></li>";
					}
					echo "<li class=\"nav-item\">".$menu_tree[$i]."</li>";;
				}
				echo "<li class=\"separator\"><i class=\"fas fa-chevron-right\"></i></li>";
				echo "<li class=\"nav-item\">".$desc_iddet."</li>";;				
			?>
		</ul>
	</div>
	<div class="content" style="margin-top: 10px;">
		<div class="row">
		
		<!-- table 1 start -->
		<div class="col-md-12">
			<div class="card">
				<div style="margin:10px 10px 10px 10px;">
					<div>

						
							<div class="form-body">		
								<?php
								// input_checkbox_temp("changepasswd","changepasswd","1","","","form-control border-primary","","Agree change password");
								
								$txttitle	= $library['title'];
	                    		$icofrm	  = "fas fa-list-ul";
	                    		echo title_form_det($txttitle,$icofrm);
								
								$x				   = 0;
	        
	                    		$txtlabel[$x]      = "Group Name";
	                    		//$bodycontent[$x]   = get_select_server($condb, $groupid);
	                    		$bodycontent[$x]   = get_sselect_group($condb, "group_id", "group_id", $groupid);
	                    		$x++;
	                    		
	                    		echo label_form_det($txtlabel,$bodycontent,$x);
	                    		
	                    		$txttitle	= "# Out Trunk";
	                    		$icofrm	  = "icon-clipboard4";
	                    		echo title_form_det($txttitle,$icofrm);
	                    		
	                    		$x						 		 = 0;
	                    		$txtlabel[$x]      = "Detail";
	                    		$bodycontent[$x]   = "<div id ='dial_plan'></div>";
	                    		$x++;
	                    		
	                    		echo label_form_det($txtlabel,$bodycontent,$x);
	                    		
								?>

							</div>


					</div>
				</div>
			</div>
		</div>
		<!-- table 1 end -->
		
		</div>
		
		
		<div class="card-action">
			<?php
			echo button_priv('1','1','1');
			?>
		</div>
		
	</div>
</div>


</form>
<?php
disconnectDB($condb);
?>

<!--   Core JS Files   -->
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- Sweet Alert -->
	<script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
	<!-- Bootstrap Toggle -->
	<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	<!-- jQuery Scrollbar -->
	<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Select2 -->
	<script src="assets/js/plugin/select2/select2.full.min.js"></script>
	<!-- jQuery Validation -->
	<script src="assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>
	<!-- Bootstrap Tagsinput -->
	<script src="assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<!-- Atlantis JS -->
	<script src="assets/js/atlantis.min.js"></script>
	<script src="assets/js/setting.js"></script>

	<!--
	<link rel="stylesheet" type="text/css" href="assets/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="assets/css/pickers/datetime/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="assets/css/pickers/pickadate/pickadate.css">
    
    <script src="assets/js/plugin/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
    <script src="assets/js/plugin/pickers/dateTime/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="assets/js/plugin/pickers/pickadate/picker.js" type="text/javascript"></script>
    <script src="assets/js/plugin/pickers/pickadate/picker.date.js" type="text/javascript"></script>
    <script src="assets/js/plugin/pickers/pickadate/picker.time.js" type="text/javascript"></script>
    <script src="assets/js/plugin/pickers/pickadate/legacy.js" type="text/javascript"></script>
    <script src="assets/js/plugin/pickers/daterange/daterangepicker.js" type="text/javascript"></script>
    -->
    <script lang="javascript">
    var form = $( "#frmDataDet" );
	form.validate();
    $("#btnSaveForm").click(function(){ 
      var fvalid = form.valid();
	  $gid = document.getElementById("group_id").value;
      tot_status=0;
      paramtext="Please fill in all mandatory";
      if ($gid=='') {
      	fvalid=false;
      	paramtext="Please select Group Name";
      }
	  param_status = document.getElementsByName('status[]');
	  for (let i = 0; i < param_status.length; i++) {
		if (param_status[i].value==1) {
			tot_status++;
		}
	  }
	  if (tot_status>1) {
	  	fvalid=false;
      	paramtext="Please select only one 'enable' status";
	  }

      if(fvalid==true){
    	swal({
						title: 'Are you sure want to save?',
						text: "",
						type: 'warning',
						buttons:{
							confirm: {
								text : 'Yes',
								className : 'btn btn-success'
							},
							cancel: {
								visible: true,
								className: 'btn btn-danger'
							}
						}
					}).then((Save) => {
						if (Save) {
							 var data = new FormData();
							 var form_data = $('#frmDataDet').serializeArray();
							 $.each(form_data, function (key, input) {
							    data.append(input.name, input.value);
							 });

							 data.append('key', 'value');	
							
							 $.ajax({
						        url: "<?php echo $save_form; ?>",
						        type: "post",
						        data: data,
							    processData: false,
							    contentType: false,
						        success: function(d) {
						        	var warn = d;
					            	if(warn=="Success!") {
					            		var vtype = "success";
					            	} else {
										var vtype = "error";	
					            	}
						            swal({ title: "Save Data!", type: vtype,  text: warn,   timer: 1000,   showConfirmButton: false });
						            if(warn=="Success") {
						            	setTimeout(function(){history.back();}, 1500);
						            } 
						        }
							  });
							/*
							swal({
								title: 'Deleted!',
								text: 'Your file has been deleted.',
								type: 'success',
								buttons : {
									confirm: {
										className : 'btn btn-success'
									}
								}
							});
							*/
						} else {
							swal.close();
						}
					});
		}else{
			swal({ title: "Info!", type: "error",  text: paramtext,   timer: 1000,   showConfirmButton: false });
		}
        return false;
	}) 
	 $("#btnCancelForm").click(function(){
    	swal({
						title: 'Are you sure to return to the previous page?',
						text: "",
						type: 'warning',
						buttons:{
							confirm: {
								text : 'Yes',
								className : 'btn btn-success'
							},
							cancel: {
								visible: true,
								className: 'btn btn-danger'
							}
						}
					}).then((Save) => {
						if (Save) {
							var alink= "<?php echo $ffolder;?>|<?php echo $fmenu_link_back;?>|<?php echo $fdescription;?>|<?php echo $fmenu_id;?>|<?php echo $ficon;?>|<?php echo $fiddet;?>|<?php echo $fblist;?>"
							var link = "index.php?v="+encodeURI(btoa(alink));
							window.location.href = link;
							//window.history.back();
						} else {
							swal.close();
						}
					});
        return false;
	})
	
    $("#btnDeleteForm").click(function(){
		var iddet = document.getElementById("iddet").value;

         swal({
						title: 'Are you sure want to delete?',
						text: "",
						type: 'warning',
						buttons:{
							confirm: {
								text : 'Yes',
								className : 'btn btn-success'
							},
							cancel: {
								visible: true,
								className: 'btn btn-danger'
							}
						}
					}).then((Save) => {
						if (Save) {
							 var data = new FormData();
							 var form_data = $('#frmDataDet').serializeArray();
							 $.each(form_data, function (key, input) {
							    data.append(input.name, input.value);
							 });

							 data.append('key', 'value');	
							
							 $.ajax({
						        url: "<?php echo $save_form; ?>?v=del&iddet="+iddet,
						        type: "post",
						        data: data,
							    processData: false,
							    contentType: false,
						        success: function(d) {
						        	var warn = d;
					            	if(warn=="Success") {
					            		var vtype = "success";
					            	} else {
										var vtype = "error";	
					            	}
						            swal({ title: "Save Data!", type: vtype,  text: warn,   timer: 1000,   showConfirmButton: false });
						            if(warn=="Success") {
						            	setTimeout(function(){history.back();}, 1500);
						            } 
						        }
							  });
						} else {
							swal.close();
						}
					});
        return false;
            
	}) 
	
	
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('select').select2({
		theme: "bootstrap"
	});
	// $('#rpt_user').select2({
	// 	theme: "bootstrap"
	// });
	$gid = document.getElementById("group_id").value;
	$tpid = "trunk_out";
	
   $.getJSON('view/cc/global_param_cc.php?groupid='+$gid+'&ctype='+$tpid, function(data) {
			$('#dial_plan').html(data.own_followup);
   });
});		
$("#group_id").change(function(){
	$gid = document.getElementById("group_id").value;
	$tpid = "trunk_out";
	
   $.getJSON('view/cc/global_param_cc.php?groupid='+$gid+'&ctype='+$tpid, function(data) {
			$('#dial_plan').html(data.own_followup);
   }); 
});	

function status_change(serverid){
	var x = document.getElementById("srv_id").value;
	
	if (x!='') {
		x=x+','+serverid;
	}else{
		x=serverid;
	}
	document.getElementById("srv_id").value=x;
}
</script>