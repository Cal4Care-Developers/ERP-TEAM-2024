<?php
session_start();

include_once "includes/config.php";
$cn->Connect(DBHOST, DBUN, DBPW, DBNAME);
include "includes/functions/functions_forms.php";
include_once "includes/modules/utilities.php";
include_once "includes/functions/show_currency.php";
define('PAGE',"recurring_date_update.php");
include_once "quick_menu.php";
$elements["quick_menu"] =$quick_menu;


/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

$msg	=	"";

if(is_valid_session()){

	
	$elements["styles"]	  .= "<link rel='stylesheet' href='images/style.css' type='text/css' />
							 <!--<link rel='stylesheet' href='styles/bootstrap_button.css' type='text/css' />-->
							 <link rel='stylesheet' href='styles/bank.css' type='text/css' />
							 <!--<link rel='stylesheet' href='styles/pagination.css' type='text/css' />
	 						  <link rel='stylesheet' type='text/css' media='all' href='customization/custom-style.css' />
							  <script src='scripts/jquery.min.js' type='text/javascript'></script>
							  <script type='text/javascript' src='scripts/jquery-ui.js'></script>-->
							 
							  <link rel='stylesheet' type='text/css' media='all' href='scripts/calendar/aqua.css' title='Aqua' /> 
							<script type='text/javascript' src='scripts/calendar/calendar.js'></script>
							<script type='text/javascript' src='scripts/calendar/calendar-en.js'></script>
							<script type='text/javascript' src='scripts/calendar/helper_all.js'></script>
	
							";

$biller_array = array_filter($_SESSION['sesRecDate']);
$biller_array_comma = implode(',',$biller_array);

	/*$recuring_approve_qry = "SELECT 
									billId,
									cus_invoice_no,
									date_format(billDate,
									'%d-%m-%Y') as billDate,
									custId,
									billGeneratedBy,
									billerId,
									fixed_duration,
									usage_duration,
									post_send_status,
									date_format(fixed_next_rec_date,'%d-%m-%Y') as fixed_next_rec_date,
									date_format(usage_next_rec_date,'%d-%m-%Y') as usage_next_rec_date,		
									date_format(recured_date,'%d-%m-%Y') as recured_date,
									date_format(next_recuring_date,'%d-%m-%Y') as next_recuring_date 
								FROM billingparent 
								WHERE 1 
								AND billerId IN($biller_array_comma) 
								AND (recuring_status='1' AND recuring_new_status='1')
								AND (next_recuring_date<= DATE_ADD(current_date( ) ,INTERVAL 30 DAY) OR fixed_next_rec_date<= DATE_ADD(current_date( ) ,INTERVAL 30 DAY) OR usage_next_rec_date<= DATE_ADD(current_date( ) ,INTERVAL 30 DAY))
								order by did_invoice_state,billerId asc";	*/
								
//		AND recuring_status='1' AND next_recuring_date<= DATE_ADD(current_date( ) ,INTERVAL 12 MONTH)						
								
		$recuring_approve_qry = "SELECT 
									billId,
									cus_invoice_no,
									date_format(billDate,
									'%d-%m-%Y') as billDate,
									custId,
									billGeneratedBy,
									billerId,
									did_invoice_state,
									fixed_duration,
									usage_duration,
									post_send_status,
									reference_reseller_name,
									did_bill_code,
									netPayment,
									checker_state,
									date_format(fixed_next_rec_date,'%d-%m-%Y') as fixed_next_rec_date,
									date_format(usage_next_rec_date,'%d-%m-%Y') as usage_next_rec_date,		
									date_format(recured_date,'%d-%m-%Y') as recured_date,
									date_format(next_recuring_date,'%d-%m-%Y') as next_recuring_date,
									billStatus
								FROM billingparent 
								WHERE 1 
								AND suspend='0'
								AND billerId IN($biller_array_comma) 
								AND month(billDate)=  MONTH(CURRENT_DATE)
								AND (recuring_new_status='1' 
								OR recuring_status='1')
								AND (fixed_next_rec_date<= DATE_ADD(current_date( ) ,INTERVAL 12 MONTH ) OR usage_next_rec_date<= DATE_ADD(current_date( ) ,INTERVAL 12 MONTH ) OR next_recuring_date<= DATE_ADD(current_date( ) ,INTERVAL 30 DAY)) 
								
								order by did_invoice_state desc, billerId asc , recuring_new_status desc";	
				
			if((in_array(7044,$_SESSION['activeRole']))){
			$recuring_approve_rec_str_mainv ="<span style='display: block;text-align: center;' ><a href='javascript:get_allpayment()'><img src='images/calendar.jpg' border='0' alt='add'></a></span>";
			}
			
			
			$recuring_approve_rec_str_main.="
				
			<table id='purchase_order_list' align='center' width='100%' cellpadding='2' cellspacing='1' border='0' bgcolor='#099' class='table table-striped table-bordered datatables dataTable no-footer' style='border-collapse:collapse'><THEAD>
			<tr>
		    	<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-1' width='1%' ><A href='#' class='fdTableSortTrigger'><input name='approve_all' type='checkbox' id='approve_all' value='' ></a></th>
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-2'  ><strong>A Print</strong> </th>	
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-2' width='5%' ><strong>S.No</strong> </th>				
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-3' width='10%' ><strong>Customer Invoice No</th>
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-4' width='10%'><strong>Invoice Date</strong> </th>
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-5' width='20%'><strong>Customer</strong> </th>
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-6' width='5%'><strong>Fixed Charge</strong></th>
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-6' width='10%'><strong>Fixed Next Rec Dt</strong></th>
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-6' width='5%'><strong>Usage Charge</strong></th>
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-6' width='10%'><strong>Usage Next Rec Dt</strong></th>
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-6' width='10%'><strong>Net Amt</strong></th>
				<th style='border:1px solid #d0d0d0' class='sortable-text fd-column-8' width='10%'><strong>Action</strong></th>
			  </tr></THEAD>"; 
			  
			// echo $recuring_approve_qry;
  		
		$rs	=$cn->Execute($recuring_approve_qry);
		$sno=1;
		$count=$rs->RecordCount();
		if($count>0){			
			$recuring_approve_rec_str_main.="<tr valign='top' id='tr$sn'  valign='top' style='font-weight:normal' >
					<td colspan='12' bgcolor='#FF6600' style='color:#FFF;font-weight:bold;height:30px'>DID Invoice</td>
					</tr>";
			while($res_recuring_approve = $rs->FetchRow()){
				
				$billId = $res_recuring_approve['billId'];
				$billerId = $res_recuring_approve['billerId'];
				$billGeneratedBy = $res_recuring_approve['billGeneratedBy'];
				$next_recuring_date = $res_recuring_approve['next_recuring_date'];
				$billDate = $res_recuring_approve['billDate'];
				$cus_invoice_no = $res_recuring_approve['cus_invoice_no'];
				$custId = $res_recuring_approve['custId'];
				$recured_date = $res_recuring_approve['recured_date'];
				$fixed_duration = $res_recuring_approve['fixed_duration'];
				$usage_duration = $res_recuring_approve['usage_duration'];
				$fixed_next_rec_date = $res_recuring_approve['fixed_next_rec_date'];
				$usage_next_rec_date = $res_recuring_approve['usage_next_rec_date'];		
				$post_send_status = $res_recuring_approve['post_send_status'];
				$did_invoice_state = $res_recuring_approve['did_invoice_state'];	
				$netPayment = $res_recuring_approve['netPayment'];	
				$did_bill_code = $res_recuring_approve['did_bill_code'];
				$reference_reseller_name = $res_recuring_approve['reference_reseller_name'];	
				$checker_state = $res_recuring_approve['checker_state'];
																					
				
				$generatedBy	=	$cn->GetOne("SELECT `firstName` FROM `user` WHERE  userId='$billGeneratedBy'");
				$currency_name	=	$cn->GetOne("SELECT currency_name FROM curreny WHERE  currencyId='$currency'");
				$customerName	=	$cn->GetOne("select customerName from customer where customerId='$custId'");
				
				$fixed_total_amt	=	$cn->GetOne("SELECT sum(total_amt) FROM billchild WHERE  billId='$billId' AND did_particluar_type='1'");
				$usage_total_amt	=	$cn->GetOne("SELECT sum(total_amt) FROM billchild WHERE  billId='$billId' AND did_particluar_type='2'");
				
				$checker_user1	=	$cn->GetOne("SELECT checker_user1 FROM biller WHERE  billerId='$billerId'");				
				$checker_user2	=	$cn->GetOne("SELECT checker_user2 FROM biller WHERE  billerId='$billerId'");
				$checker_user3	=	$cn->GetOne("SELECT checker_user3 FROM biller WHERE  billerId='$billerId'");
				
				
				
				if($checker_state==0 and $checker_user1==$_SESSION['erpcalcare_userId']){
				
				$action_str ="<input name='recurring_bill_id[]' id='approval_id_$billId' type='checkbox' class='approval_class' value='$billId' onclick='rec_checked($billId,1)' />";
				}elseif($checker_state==1 and $checker_user2==$_SESSION['erpcalcare_userId']){
				
				$action_str ="<input name='recurring_bill_id[]' id='approval_id_$billId' type='checkbox' class='approval_class' value='$billId' onclick='rec_checked($billId,2)' />";
				}elseif($checker_state==2 and $checker_user3==$_SESSION['erpcalcare_userId']){
				
				$action_str ="<input name='recurring_bill_id[]' id='approval_id_$billId' type='checkbox' class='approval_class' value='$billId' onclick='rec_checked($billId,3)' />";
				}else{
					if($checker_state==0){
						$action_str='CH-I';
					}elseif($checker_state==1){
						$action_str='CH-II';
					}elseif($checker_state==2){
						$action_str='CH-III';
					}
				}
				
			//	$bill_code	=	$cn->GetOne("select concat(bill_code_740,',',bill_code_kl,',',bill_code_750) from customer_bill_code where customer_id='$custId' AND conn_state='1'");
				
				if($post_send_status==0){
					$send_color = 'CCC';
					$post_send_status_str ="<span id='send_post_status_$billId' style='background-color: #999999;border-radius: 5px;color: #000;padding: 2px;text-align: center;width: 35px;'>None</span>";
				}elseif($post_send_status==1){
					$send_color = 'F00';
					if($send_dt='0000-00-00 00:00:00'){
						$send_color = 'F00';
					}
					 $post_send_status_str ="<span id='send_post_status_$billId' style='background-color: #FF9900;border-radius: 5px;color: #000;padding: 2px;text-align: center;width: 35px;'>Post</span>";		
				}elseif($post_send_status==3){
					$send_color = 'FFCC99';
					if($send_dt='0000-00-00 00:00:00'){
					//	$send_color = '9C0';
						$send_color = 'F00';
					}
					$post_send_status_str ="<span id='send_post_status_$billId' style='background-color: #CCFF00;border-radius: 5px;color: #000;padding: 2px;text-align: center;width: 35px;'>Email</span>";
				}
				
				
			
				if((in_array(7044,$_SESSION['activeRole']))){
					
					if($did_invoice_state==1){
						$terms_condition_link = "<a id='recuring_option_popup_new_$billId' href='javascript:popRecuringNew($billId)' style='background-color:#FFCC00;padding:3px;border-radius:5px' title='Update Recurring Date' ><strong>RD</strong></a>&nbsp;";
					}else{
						$terms_condition_link = "<a id='terms_condition_link_$billId' href='javascript:set_terms_condition($billId)' style='background-color:#FFCC00;padding:3px;border-radius:5px' title='Update Recurring Date' ><strong>RD</strong></a>&nbsp;";
					}
				
				$send_post_link = "<a id='send_post_link_$billId' class='tooltips' href='javascript:sendPostStatus($billId)' style='background-color:#$send_color;padding:3px;border-radius:5px' data-trigger='hover' data-original-title='Invoice Send to Post' title='Invoice Send to Post' ><strong>P</strong></a>";
				
				
				}
				
				if($did_invoice_state != $did_invoice_state_temp and $did_invoice_state==0){
					$recuring_approve_rec_str_main.="<tr valign='top' id='tr$sn'  valign='top' style='font-weight:normal' >
					<td colspan='12' bgcolor='#CC6600' style='color:#FFF;font-weight:bold;height:30px'>Normal Invoice</td>
					</tr>";
					
				}
				
				$reference_reseller_name_str='';
			$bill_code_name='';
			if($did_bill_code and $reference_reseller_name=='' and $did_invoice_state ==1){
				$bill_code_name=$cn->GetOne("SELECT bill_code_name FROM customer_bill_code WHERE customer_bill_code_id='$did_bill_code'");
			}
			
			if($bill_code_name!='' and $reference_reseller_name==''){
				if($bill_code_name==1){
					$reference_reseller_name_str="";
				}else{
					$reference_reseller_name_str=$bill_code_name;
				}
			}elseif($reference_reseller_name!=''){
				$reference_reseller_name_str=$reference_reseller_name;
			}
				
				
				if($billerId != $billerId_temp){
					$billerName = $cn->GetOne("SELECT billerName FROM biller WHERE billerId='$billerId'");
					$colorCodes = $cn->GetOne("SELECT colorCodes FROM biller WHERE billerId='$billerId'");
					$recuring_approve_rec_str_main.="<tr valign='top' id='tr$sn'  valign='top' style='font-weight:normal' >
					<td colspan='12' bgcolor='$colorCodes' style='color:#FFF;font-weight:bold;height:25px'>$billerName</td>
					</tr>";
					
				}
				
				$landviewBillLink="<a href='javascript:billsFileView($billId)' >
						<i class='fa fa-fw fa-file-pdf-o tooltips' data-toggle='modal' data-target='#customer_project_file_viewer' data-trigger='hover' data-original-title='Landscap PDF' title='Landscap PDF' style='font-size:17px; color:#455a64; width:18px'></i></a>";
						
						
				$SkipRecurringLink="<a id='terms_condition_link_$billId' href='javascript:SkipRecurring($billId)' title='Skip Recurring' ><img src='images/skip.png' ></a>";
						
						
				$row_color = $billStatus == 4 ? ";background-color:#f00" : "";
				
			$recuring_approve_rec_str_main.="<tr valign='top' id='recurring_tr_$billId'  valign='top' style='font-weight:normal$row_color' >
			    <td style='border:1px solid #d0d0d0' >$action_str</td>
				<td style='border:1px solid #d0d0d0' bgcolor='#FF99FF' ><input type='checkbox' name='print_chk[]' id='print_chk_$billId' class='print_class' value='$billId' /> </td>
				<td style='border:1px solid #d0d0d0' >$sno</td>				
				<td style='border:1px solid #d0d0d0' >$cus_invoice_no $post_send_status_str</td>
				<td style='border:1px solid #d0d0d0' >$billDate</td>
				<td style='border:1px solid #d0d0d0' >$customerName <span id='reseller_ref_cls' style='background-color: #CF0;color: #000;' >$reference_reseller_name_str</span></td>	
				<td style='border:1px solid #d0d0d0' >$fixed_total_amt</td>
				<td style='border:1px solid #d0d0d0' ><span id='fixed_next_rec_date_span_$billId'>$fixed_next_rec_date</span>(<span id='fixed_duration_span_$billId'>$fixed_duration</span>)</td>
				<td style='border:1px solid #d0d0d0' >$usage_total_amt</td>
				<td style='border:1px solid #d0d0d0' ><span id='usage_next_rec_date_span_$billId'>$usage_next_rec_date</span>(<span id='usage_duration_span_$billId'>$usage_duration</span>)</td>
				<td style='border:1px solid #d0d0d0' >$netPayment</td>
				<td style='border:1px solid #d0d0d0' >$send_post_link $landviewBillLink</td>
				</tr>";
				$sno++;
				
				$billerId_temp = $billerId;
				$did_invoice_state_temp = $did_invoice_state;
			}
		}else{
			$recuring_approve_rec_str_main .= "<tr bgcolor='#FFFFFF'><td colspan=7>No Record found</td></tr>";	
			
		}
		$recuring_approve_rec_str_main .= "</table>
	";
		
		
			$rec_duration_fixed_cbo = drawDataCombo("rec_duration_fixed","rec_duration_fixed","no","itemname",$rec_duration_fixed,"array",$rec_duration_new_arr,"style='width:160px !important;float:right;padding-right:50px'");
			
			$rec_duration_usage_cbo = drawDataCombo("rec_duration_monthly","rec_duration_monthly","no","itemname",$rec_duration_monthly,"array",$rec_duration_new_arr,"style='width:160px !important;float:right;padding-right:50px'");
		
		$current_date = date('d/m/Y',time());
		
		$groupMailLink="<button class='btn btn-success-alt btn-label' href='#' data-toggle='modal' onclick='multiple_address_print()'><i class='fa fa-print' aria-hidden='true'></i>Multiple Address print</button>";
		
	$recuring_approve_bill_list_main="
	
	<div class='alert alert-info' style='height:55px'>        
			<h1 style='margin-right:30px; float:left; font-size:24px; margin-bottom:0px'>Recurring Checker</h1>		
			<div class='options' style='float:right;margin-top: 5px;'>
				  <div class='btn-toolbar'>
					  <ul class='demo-btns'>
							
							<li><span class='newLink'>".$groupMailLink."</span></li>
							<li><span class=''>".$recuring_approve_rec_str_mainv."</span></li>
						  
					  </ul>
				  </div>
			    </div>		
			</div>
			
			
			<div class='panel panel-info' id='panel-tabletools' data-widget='{'draggable':'true'}' >
				<div class='panel-heading'>
					<h2 style='z-index:999; padding:10px 0 13px'>
						<span style='color:#ffffff'>List of Records</span>			
					</h2>
				</div>
	
			<div class='panel-body panel-no-padding'>
			<div id='tabletools_wrapper' class='dataTables_wrapper form-inline no-footer'>
			
		  <form action='' method='post' name='recuring_approve_popup_frm_mian' id='recuring_approve_popup_frm_mian'>
		  <table class='tablestyle' align='center' width='100%' cellpadding='2' cellspacing='2' border='0' >
			  <tr>
				<td>
					$recuring_approve_rec_str_main 
				</td>
			  </tr>
				
			  
			</table>
			
		  </form>
		  </div></div></div>
  
 		 <div class='terms_condition_div' id='terms_condition_slidepanel' style='overflow:hidden !important'>
			  <form action='' method='post' name='terms_condition_frm' id='terms_condition_frm'>
			  <table class='table table-striped table-bordered datatables dataTable no-footer' align='center' width='100%' border='0' cellspacing='3' cellpadding='3' >
				 <tr>
					<td valign='top' align='left' colspan='2' ><strong>Recurring Date Update</strong></td>
				  </tr>
				   <tr>
					<td valign='top' align='left' width='30%' >Recurring Date</td>
					<td valign='top' align='left' width='70%' >	
							<input type='text' name='next_recuring_date' id='next_recuring_date' value='' class='form-control' style='width:80% !important; margin-right:10px; float:left;' readonly='true'><img src='images/calendar.jpg' alt='Calendar' align='absmiddle' onClick='return showCalendar(\"next_recuring_date\", \"%d-%m-%Y\");' />
						  <input type='hidden' name='billId_terms_hd' id='billId_terms_hd' value='' />
						  <input type='hidden' name='action' id='action' value='next_recuring_date_update' />
					</td>        
				  </tr>      
				 <tr>
					<td colspan='2' align='center'><input type='button' name='terms_condition_save' value='Save' class='btn btn-success' id='terms_condition_save' />
					  &nbsp;
					  <input type='button' name='terms_condition_cancel' value='Cancel' id='terms_condition_cancel' class='btn btn-warning'  /></td>
				  </tr>
				</table>
			  </form>
			</div>
			
			
			
			<div class='payment_process_update_all_div' id='payment_process_update_all_slidepanel' style='width:40%;left:28%; position:fixed; z-index:999' >
			  <form action='' method='post' name='payment_process_update_all_frm' id='payment_process_update_all_frm'>
			  <table class='table table-striped table-bordered datatables dataTable no-footer' align='center' width='100%' border='0' cellspacing='3' cellpadding='3' >
				<tr>
					<td colspan='2'><h3 align='center' style='margin:0px'>Multiple Recurring Date Update</h3></td>       
				</tr>
				
					<tr>
				  <td align='left' valign='top'><strong>Recurring Date</strong></td>
				  <td align='left' valign='top'><input name='next_recuring_date_all' type='text' readonly='true' id='next_recuring_date_all' value='$curr_date' size='15' class='form-control' style='width:80% !important; margin-right:10px; float:left'/><img src='images/calendar.jpg' alt='Calendar' align='absmiddle' onClick='return showCalendar(\"next_recuring_date_all\", \"%d-%m-%Y\");' /></td>
				</tr>
				
						
				 <tr>
					<td colspan='2' align='center'>
			
					<input type='hidden' name='action' id='action' value='recurring_date_update_all' />
					
					<input type='button' name='payment_process_update_all_save' value='Save' class='btn btn-success' id='payment_process_update_all_save' />
					  &nbsp;
					  <input type='button' name='payment_process_update_all_cancel' value='Cancel'  id='payment_process_update_all_cancel' class='btn btn-warning'  /></td>
				  </tr>
				</table>
			  </form>
			  <i id='payment_process_update_all_close_btn' class='fa fa-fw fa-times-circle' data-trigger='hover' data-original-title='Close' title='' style='font-size:25px;color:#f77c7c;width:18px;top: 20px;right: 25px;position: absolute;cursor: pointer;display: block;float: right; background:none'></i>
			</div>
			
			
			<div class='recuring_option_div' id='recuring_option_new_slidepanel' >
  <form action='' method='post' name='recurring_new_frm' id='recurring_new_frm'>
  <table class='table table-striped table-bordered datatables dataTable no-footer' align='center' width='100%' border='0' cellspacing='3' cellpadding='3' >
	<tr>
		<td valign='middle' align='center' colspan='2' ><strong>Select New Recurring Options </strong> </td>       
	</tr>
       <tr>
        <td ><strong>Date</strong></td>
		 <td ><input name='recured_date_new' type='text' style='width:100px !important' id='recured_date_new' value=''  size='15' /><img src='images/calendar.jpg' alt='Calendar' align='absmiddle'  onClick='return showCalendar(\"recured_date_new\", \"%d/%m/%Y\");' /></td>
      </tr> 
	  
	   <tr><td  valign='top'><strong>Recurring</strong></td>
					<td width='80' valign='top'><input type='radio' name='recuring_new_rdo' id='recuring_new_active' value='1'  > Active &nbsp;&nbsp; <input type='radio' name='recuring_new_rdo' id='recuring_new_inactive' value='0'> Inactive </td>
				</tr>
		
		 <tr>
        <td ><strong>Fixed Charge Dt</strong> </td>
		 <td ><input type='checkbox' name='fixed_charge_chk' id='fixed_charge_chk' /> &nbsp;&nbsp; <input name='fixed_charge_dt' type='text' style='width:100px !important' id='fixed_charge_dt' value='' size='15' /><img src='images/calendar.jpg' alt='Calendar' align='absmiddle' onClick='return showCalendar(\"fixed_charge_dt\", \"%d/%m/%Y\");' /></td>
      </tr>
	  		
	   <tr>
        <td ><strong>Fixed Charge Duration</strong> <br/>
					Next Rec Dt : <span id='fixed_charge_next_dt'></span></td>
		 <td >$rec_duration_fixed_cbo</td>
      </tr>
	  <tr>
        <td ><strong>Usage Charge Dt</strong> </td>
		 <td ><input type='checkbox' name='usage_charge_chk' id='usage_charge_chk' /> &nbsp;&nbsp; <input name='usage_charge_dt' type='text' style='width:100px !important' id='usage_charge_dt' value='' size='15' /><img src='images/calendar.jpg' alt='Calendar' align='absmiddle' onClick='return showCalendar(\"usage_charge_dt\", \"%d/%m/%Y\");' /></td>
      </tr>
	   <tr>
        <td ><strong>Usage Charges Duration</strong><br/>
					Next Rec Dt : <span id='usage_charge_next_dt'></span></td>
		 <td >$rec_duration_usage_cbo</td>
      </tr>       
     <tr>
        <td align='center' colspan='2'> <input type='hidden' name='recurring_new_billid' id='recurring_new_billid' />
		<input type='button' name='recurring_save_new' value='Save' class='btn btn-primary' class='btn btn-success' id='recurring_save_new' />
          &nbsp;
          <input type='button' name='recuring_option_new_cancel' value='Cancel' id='recuring_option_new_cancel' class='btn btn-warning'  /></td>
      </tr>
    </table>
  </form>
  <i id='recuring_option_new_close_btn' class='fa fa-fw fa-times-circle' data-trigger='hover' data-original-title='Close' title='' style='font-size:25px;color:#f77c7c;width:18px;top: 20px;right: 25px;position: absolute;cursor: pointer;display: block;float: right;'></i>
</div>



<div class='invoice_send_details_div' id='invoice_send_details_slidepanel' >
			  <form action='' method='post' name='invoice_send_details_frm' id='invoice_send_details_frm'>
			  <table class='table table-striped table-bordered datatables dataTable no-footer' align='center' width='100%' border='0' cellspacing='3' cellpadding='3' >
				 <tr>
					<td valign='top' align='center' colspan='2' ><strong>Invoice sending method</strong></td>
				  </tr>
				   <tr>
					<td valign='top' align='left' width='30%' >Select invoice sending type</td>
					<td valign='top' align='left' width='70%' >	
							<input type='radio'	name='post_send_status'	id='post_send_status_post' value='1' /> By Post																														
							<input type='radio'	name='post_send_status'	id='post_send_status_mail' value='3' /> By Email
								<input type='radio'	name='post_send_status'	id='post_send_status_none' value='0' /> None
						  <input type='hidden' name='billId_send_hd' id='billId_send_hd' value='' />
						  <input type='hidden' name='action' id='action' value='invoice_send_details_update' />
					</td>        
				  </tr>      
				 <tr>
					<td colspan='2' align='center'><br/><br/><input type='button' name='invoice_send_details_save' value='Save' class='btn btn-success' id='invoice_send_details_save' />
					  &nbsp;
					  <input type='button' name='invoice_send_details_cancel' value='Cancel' id='invoice_send_details_cancel' class='btn btn-warning'  /></td>
				  </tr>
				</table>
			  </form>
			</div>


<div class='modal fade form-model modal_customer_file_viewer' id='customer_project_file_viewer' role='dialog' style='height:90% !important'>
    <div class='modal-dialog zoomIn animated modal_customer_project_file_viewer'> </div>
</div>
  
  ";
  

	$elements["content"]	=	$recuring_approve_bill_list_main;

	$elements["content"].="<script>
		
				$(document).ready(function(){	
				
					$('#terms_condition_cancel').click(function(){							  
						$('#terms_condition_slidepanel').fadeOut('slow');					
					});
					
					$('#payment_process_update_all_cancel').click(function(){							  
						$('#payment_process_update_all_slidepanel').fadeOut('slow');					
					});
					
					$('#payment_process_update_all_close_btn').click(function(){							  
						$('#payment_process_update_all_slidepanel').fadeOut('slow');					
					});
					
					
					$('#recuring_option_new_cancel').click(function(){							  
						$('#recuring_option_new_slidepanel').fadeOut('slow');					
					});
					
					$('#enquiry_followup_close_btn').click(function(){							  
							document.location.href='billing.php?ac=Bill';					
					});
					
					$('#invoice_send_details_cancel').click(function(){							  
						$('#invoice_send_details_slidepanel').fadeOut('slow');					
					});
					
					$('#recuring_option_new_close_btn').click(function(){							  
						$('#recuring_option_new_slidepanel').fadeOut('slow');					
					});
				
	
					 $('#approve_all').click(function(event) {  //on click
						if(this.checked) { // check select status
							$('.approval_class').each(function() { //loop through each checkbox
								this.checked = true;         
							});
						}else{
							$('.approval_class').each(function() { //loop through each checkbox
								this.checked = false;             
							});        
						}
  					  });
					  
					  
					  
					  
					  $('#recurring_save_new').click(function(){							  
			
							var recuring_rdo = $('input[name=recuring_new_rdo]:checked', '#recurring_new_frm').val()
							var billid = $('#recurring_new_billid').val();	
							var recurring_new_val = $('#recurring_new_frm').serialize();
				
								$.ajax({
									type: 'POST',
									url: 'includes/modules/ajax/updateBillParent.php',
									data: recurring_new_val+'&action=recuring_option_save_new',
									success: function(data){	
										
										var data_arr = JSON.parse(data);
										
										var rec_duration_fixed = $('#rec_duration_fixed').val();
										var rec_duration_monthly = $('#rec_duration_monthly').val();
										var recured_date_new = $('#recured_date_new').val();
										
										
										if(recuring_rdo==1){										
											$('#fixed_duration_span_'+billid).text(rec_duration_fixed);	
											$('#usage_duration_span_'+billid).text(rec_duration_monthly);
										}else{
											$('#fixed_duration_span_'+billid).text(0);	
											$('#usage_duration_span_'+billid).text(0);	
										}
										$('#fixed_next_rec_date_span_'+billid).text(data_arr['fixed_next_rec_dt']);
										$('#usage_next_rec_date_span_'+billid).text(data_arr['usage_next_rec_dt']);	
									
									}
								});	
							$('#recuring_option_new_slidepanel').fadeOut('slow');				
						
						});
						
						
						$('#invoice_send_details_save').click(function(){	
					
							  var post_send_status =  $('input:radio[name=post_send_status]:checked').val();
							  
							if(confirm('Are you sure you want to save'))
							{					  
								var follower_remark_update_val = $('#invoice_send_details_frm').serialize();
								 var billid = $('#billId_send_hd').val();					
								$.ajax({
										type:'POST',
										url: 'includes/modules/ajax/getEnquiryDetails.php',
										data: follower_remark_update_val,
										success: function(data){	
											if(post_send_status==1){
												$('#send_post_status_'+billid).css('background-color','#FF9900');	
												$('#send_post_status_'+billid).text('Post');		
											}else if(post_send_status==3){
												$('#send_post_status_'+billid).css('background-color','#CCFF00');
												$('#send_post_status_'+billid).text('Email');				
											}else{
												$('#send_post_status_'+billid).css('background-color','#999999');	
												$('#send_post_status_'+billid).text('None');			
											}
											$('#send_post_link_'+billid).css('background-color','#F00');		
											$('#invoice_send_details_slidepanel').fadeOut('slow');								
										}
								});		
							}
									
						
						});
					  
					  
					  $('#terms_condition_save').click(function(){							  
							var follower_remark_update_val = $('#terms_condition_frm').serialize();
							 var billid = $('#billId_terms_hd').val();
							  var next_recuring_date = $('#next_recuring_date').val();					
							$.ajax({
									type:'POST',
									url: 'includes/modules/ajax/updateBillParent.php',
									data: follower_remark_update_val,
									success: function(data){		
										
										if(data==1){
											$('#next_recuring_date_'+billid).text(next_recuring_date);						
											$('#terms_condition_slidepanel').fadeOut('slow');	
										}
									}
							});					
						
						});
						
						
						
						$('#payment_process_update_all_save').click(function(){		
						

							var next_recuring_date_all = $('#next_recuring_date_all').val();

							
							if(next_recuring_date_all==''){
								alert('Please enter Recurring Date');	
								$('#next_recuring_date_all').focus();
								return false;
							}
		
							var recuring_option_val = $('#recuring_approve_popup_frm_mian').serialize();
							$('#payment_process_update_all_save').attr('disabled', 'disabled');
							$.ajax({
								type: 'POST',
								url: 'includes/modules/ajax/updateBillParent.php',
								data: recuring_option_val+'&action=recurring_date_update_all&next_recuring_date_all='+next_recuring_date_all,
								success: function(data){										
									$('#payment_process_update_all_slidepanel').fadeOut('slow'); 
									$('#payment_process_update_all_save').removeAttr('disabled');			
									document.location.href='recurring_date_update.php';	
								}
							});		
							
						
						});
	
	
		});
		
		
		function billsFileView(billId){
				$.ajax({
					type: 'POST'
					, url: 'invoiceBillsForm.php'
					, data: {
						billId: billId
						, action:'file_viwer'
					}
					, success: function (data) {
						$('.modal_customer_project_file_viewer').html(data);
					}
				});
		
		}
		
		function rec_checked(billid,chk_state){
			
			if(confirm('Are you sure ?'))
			{
								
				$.ajax({
						type: 'POST',
						url: 'includes/modules/ajax/updateBillParent.php',
						data: 'billparent_id='+billid+'&chk_state='+chk_state+'&action=recurring_status_checked',
						success: function(data){	
											
							$('#approval_id_'+billid).fadeOut('slow');
							
						}
					});	
			}
			
		}

		
		function multiple_address_print(){
			
			document.recuring_approve_popup_frm_mian.action ='getAddressprinting.php';
			document.recuring_approve_popup_frm_mian.target='_blank';		
			document.recuring_approve_popup_frm_mian.submit();		
		}
		
		function SkipRecurring(billid){
			
			
			if(confirm('Are you sure you want to skip'))
			{
								
				$.ajax({
						type: 'POST',
						url: 'includes/modules/ajax/updateBillParent.php',
						data: 'billparent_id='+billid+'&action=recurring_status_skip',
						success: function(data){	
											
							$('#recurring_tr_'+billid).fadeOut('slow');
							
						}
					});	
			}
			
		}
		
		
		
		function sendPostStatus(billid){
				
			    var curr_position = $('#send_post_link_'+billid).position();	
				
				$('.invoice_send_details_div').css({'display':'none'});

				var show_pos = curr_position.top-20;
				$('.invoice_send_details_div').css({'top':+show_pos+'px'});
				
				
	
				$('#billId_send_hd').val(billid);
				$.ajax({
					type: 'POST',
					url: 'includes/modules/ajax/billParentDetails.php',
					data: 'billid='+billid+'&action=get_invoice_send_details_update',
					success: function(data){	
					
						if(data.trim()==1){												
							$('#post_send_status_post').prop('checked', 'checked');
							$('#post_send_status_mail').removeAttr('checked');
							$('#post_send_status_none').removeAttr('checked');
						}else if(data.trim()==3){												
							$('#post_send_status_post').removeAttr('checked');
							$('#post_send_status_none').removeAttr('checked');							
							$('#post_send_status_mail').prop('checked', 'checked');
						}else if(data.trim()==0){												
							$('#post_send_status_post').removeAttr('checked');
							$('#post_send_status_mail').removeAttr('checked');
							$('#post_send_status_none').prop('checked', 'checked');
						}else{
							$('#post_send_status_post').removeAttr('checked');
							$('#post_send_status_mail').removeAttr('checked');
							$('#post_send_status_none').removeAttr('checked');	
						}
						
						
					}
				});
				
				$('#invoice_send_details_slidepanel').fadeIn('slow');
				
			}
			
			
		
		function popRecuringNew(billid)
			{				
			

				var curr_position = $('#recuring_option_popup_new_'+billid).position();				
				
				var show_pos = curr_position.top-80;
				$('.recuring_option_div').css({'top':+show_pos+'px'});

						
				$('#recurring_new_billid').val(billid);
				$.ajax({
					type: 'POST',
					url: 'includes/modules/ajax/billParentDetails.php',
					data: 'billparent_id='+billid+'&action=recuring_option_new',
					success: function(data){	
						var data_arr = JSON.parse(data);						
						$('#rec_duration_fixed').val(data_arr['fixed_duration']);						
						$('#rec_duration_monthly').val(data_arr['usage_duration']);
						$('#fixed_charge_dt').val('');
						$('#usage_charge_dt').val('');
						
						
						$('#recured_date_new').val(data_arr['recured_date_show']);
						$('#fixed_charge_next_dt').text(data_arr['fixed_next_dt']);
						$('#usage_charge_next_dt').text(data_arr['usage_next_dt']);
						
						
						
						$('#fixed_charge_chk').prop('checked', false);
						$('#usage_charge_chk').prop('checked', false);
						
						if(data_arr['recuring_status']=='1'){
							$('#recuring_new_active').prop('checked', true);
							$('#recuring_new_inactive').prop('checked', false);
						}else if(data_arr['recuring_status']=='0'){
							$('#recuring_new_active').prop('checked', false);
							$('#recuring_new_inactive').prop('checked', true);
						}
						
					}
				});			
				
				$('#recuring_option_new_slidepanel').fadeIn('slow');	
					
			
				 
			}
			
			
		function set_terms_condition(billid){
				
				
				var curr_position = $('#terms_condition_link_'+billid).position();	
				
				$('.terms_condition_div').css({'display':'none'});

				var show_pos = curr_position.top-50;
				$('.terms_condition_div').css({'top':+show_pos+'px'});
				
													
				$('#next_recuring_date').val($('#next_recuring_date_'+billid).text());
				$('#billId_terms_hd').val(billid);
				
				$('#terms_condition_slidepanel').fadeIn('slow');
			}
			
			
			function get_allpayment(){
					
				$('.payment_process_update_all_div').css({'top':'100px'});
				
				$('#next_recuring_date_all').val('');
						
				$('#payment_process_update_all_slidepanel').fadeIn('slow');
				
			}
		
		</script>
	
	";
	
	
	$elements["end-of-page"]		.=	"<script type='text/javascript' src='scripts/notification_js.js'></script>";
	
	
	include_once "includes/classes/template.php";
	// instantiate a new template Parser object
	
	$tp=&new templateParser('includes/templates/template.html');
	// define/include parameters for the class
	
	
	
	include_once "includes/templates/tplDefaults.php";
	
	
	
	
	// parse template file
	$tp->parseTemplate($elements);
	// display generated page
	echo $tp->display();
}
else{
header("Location: index.php?s=".-1);	
}

?>