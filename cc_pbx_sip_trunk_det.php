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

$fmenu_link_back = "cc_pbx_sip_trunk_list";
    	
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
$contype		= get_param("contype");
$host			= get_param("host");
$dtmfmode		= get_param("dtmfmode");
$canreinvite		= get_param("canreinvite");
$username	= get_param("username");
$secret		= get_param("secret");
$callerid	= get_param("callerid");
$insecure	= get_param("insecure");
$qualify	= get_param("qualify");
$codec_alaw	= get_param("codec_alaw");
$codec_ulaw	= get_param("codec_ulaw");
$codec_g729	= get_param("codec_g729");
$status			= get_param("status");


if($iddet!=''){
	$sqlv = "SELECT * 
		FROM cc_pbx_sip_trunk a 
                WHERE a.id > 0
                      AND a.id='$iddet'";
	$resv = mysqli_query($condb,$sqlv);
	if($recv = mysqli_fetch_array($resv)){
		$serverid		= $recv['server_id'];
		$trunk_name		= $recv['trunk_name'];
		$context		= $recv['context'];
		$contype		= $recv['con_type'];
		$host			= $recv['host'];
		$dtmfmode		= $recv['dtmfmode'];
		$canreinvite		= $recv['canreinvite'];
		$username	= $recv['username'];
		$secret		= $recv['secret'];
		$callerid	= $recv['callerid'];
		$insecure	= $recv['insecure'];
		$qualify	= $recv['qualify'];
		$codec_alaw	= $recv['codec_alaw'];
		$codec_ulaw	= $recv['codec_ulaw'];
		$codec_g729	= $recv['codec_g729'];
		$status			= $recv['status'];

		if ($codec_alaw == 1) {
			$alawchk ="checked=\"\"";
		}
		else {
			$alawchk ='';
		}
		if ($codec_ulaw == 1) {
			$ulawchk ="checked=\"\"";
		}
		else {
			$ulawchk ='';
		}
		if ($codec_g729 == 1) {
			$g729chk ="checked=\"\"";
		}
		else {
			$g729chk ='';
		}
	}
}
//file save data
$save_form = "view/cc/cc_pbx_sip_trunk_save.php";

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
								
								$txttitle	= $library['title'];
	                    		$icofrm	  = "fas fa-list-ul";
	                    		echo title_form_det($txttitle,$icofrm);
								
								$x				   = 0;
	        
	                    		$txtlabel[$x]      = "Server IP";
	                    		$bodycontent[$x]   = cc_get_select_server($serverid,$condb);
	                    		$x++;
	                    		
	                    		// $txtlabel[$x]      = "Sip Provider";
	                    		// $bodycontent[$x]   = cc_get_select_host($host,$condb);
	                    		// $x++;

	                    		$txtlabel[$x]      = "Sip Provider";
	                    		$bodycontent[$x]   = input_text_temp("host","host",$host,"","required","form-control border-primary");
	                    		$x++;

	                    		$txtlabel[$x]      = "Type";
	                    		$bodycontent[$x]   = get_new_select_pbx_contype($contype);
	                    		$x++;

	                    		$txtlabel[$x]      = "Context";
	                    		$bodycontent[$x]   = input_text_temp("context","context",$context,"","required","form-control border-primary");
	                    		$x++;

	                    		$txtlabel[$x]      = "Trunk Name";
	                    		$bodycontent[$x]   = input_text_temp("trunk_name","trunk_name",$trunk_name,"","required","form-control border-primary");
	                    		$x++;

	                    		$txtlabel[$x]      = "DTMF Mode";
	                    		$bodycontent[$x]   = get_select_pbx_dtmf($dtmfmode);
	                    		$x++;

	                    		$txtlabel[$x]      = "Can Reinvite";
	                    		$bodycontent[$x]   = get_select_pbx_canreinvite($canreinvite);
	                    		$x++;

	                    		$txtlabel[$x]      = "User Name";
	                    		$bodycontent[$x]   = input_text_temp("username","username",$username,"","","form-control border-primary");
	                    		$x++;

	                    		$txtlabel[$x]      = "Secret";
	                    		$bodycontent[$x]   = input_password_temp("secret","secret",$secret,"","","form-control border-primary");
	                    		$x++;

	                    		$txtlabel[$x]      = "Caller Id";
	                    		$bodycontent[$x]   = input_text_temp("callerid","callerid",$callerid,"","","form-control border-primary");
	                    		$x++;

	                    		$txtlabel[$x]      = "Insecure";
	                    		$bodycontent[$x]   = cc_get_select_insecure($insecure);
	                    		$x++;

	                    		$txtlabel[$x]      = "Qualify";
	                    		$bodycontent[$x]   = cc_get_select_qualify($qualify);
	                    		$x++;

	                    		$codec = "<label class=\"selectgroup-item\">
								 <input type=\"checkbox\" name=\"codec_alaw\" value=\"1\" class=\"selectgroup-input\" $alawchk>
								 <span class=\"selectgroup-button\">alaw</span>
								 </label>";
								$codec2 = "<label class=\"selectgroup-item\">
								 <input type=\"checkbox\" name=\"codec_ulaw\" value=\"1\" class=\"selectgroup-input\" $ulawchk>
								 <span class=\"selectgroup-button\">ulaw</span>
								 </label>";

								 $codec3 = "<label class=\"selectgroup-item\">
								 <input type=\"checkbox\" name=\"codec_g729\" value=\"1\" class=\"selectgroup-input\" $g729chk>
								 <span class=\"selectgroup-button\">g729</span>
								 </label>";

	                    		$txtlabel[$x]      = "Codec";
	                    		$bodycontent[$x]   = "<br>".$codec."\t".$codec2."\t".$codec3;
	                    		$x++;

	                    		$txtlabel[$x]      = "Status";
	                    		$bodycontent[$x]   = cc_get_select_status_enable("status", "status", $status);
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
			swal({ title: "Info!", type: "error",  text: "Please fill in all mandatory",   timer: 1000,   showConfirmButton: false });
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
