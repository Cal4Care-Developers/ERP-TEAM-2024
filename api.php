<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecurringCheckerController;
use App\Http\Controllers\RecurringDateUpdateController;

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




//sample
Route::get('/admin/all', [App\Http\Controllers\AdminController::class, 'getAllAdmins']);

Route::post('/recurring_checker/recurring_checker_reports', [RecurringCheckerController::class, 'fetchData']);

Route::post('/recurring_date_update/get_recurring_date_update_reports', [RecurringDateUpdateController::class, 'listData']);



// $_REQUEST['user_id']

//$api_url = $_REQUEST['api_url'];

// $req_data = json_decode($_REQUEST);

//if($_REQUEST['moduleType']=='login'){
	Route::post('/login_otp', [App\Http\Controllers\API\AuthController::class, 'login_otp']);
    Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
	Route::post('/login_qrcode', [App\Http\Controllers\API\AuthController::class, 'login_qrcode']);
	Route::post('/login_olderp', [App\Http\Controllers\API\AuthController::class, 'login_olderp']);

	Route::post('/admin_login_otp', [App\Http\Controllers\API\AuthController::class, 'admin_login_otp']);
	Route::post('/admin_login', [App\Http\Controllers\API\AuthController::class, 'admin_login']);

//-------------------------enquiry-------------------------------------------------------------------//


Route::post('/enquiry/enquiryList',[App\Http\Controllers\EnquiryController::class,'enquiryList']);
//--------------------end enquiry-----------------------------------------------------------------------//


Route::post('/reseller/resellercomm_list',[App\Http\Controllers\ResellerController::class, 'resellercomm_list']);
Route::post('/reseller/getResellerPaymentDetails',[App\Http\Controllers\ResellerController::class, 'getResellerPaymentDetails']);

	// User_mgt
    Route::post('/admin/user_list', [App\Http\Controllers\UserController::class, 'user_list']);
    Route::post('/admin/user_add_details', [App\Http\Controllers\UserController::class, 'user_add_details']);
    Route::post('/admin/user_details_save', [App\Http\Controllers\UserController::class, 'user_details_save']);
    Route::post('/admin/user_edit_details', [App\Http\Controllers\UserController::class, 'user_edit_details']);
    Route::post('/admin/user_details_update', [App\Http\Controllers\UserController::class, 'user_details_update']);
    Route::post('/admin/user_enable_disable', [App\Http\Controllers\UserController::class, 'user_enable_disable']);
	Route::post('/admin/user_pwd_reset', [App\Http\Controllers\UserController::class, 'user_pwd_reset']);
    Route::post('/admin/user_delete', [App\Http\Controllers\UserController::class, 'user_delete']);
	Route::post('/admin/user_signature_deleted', [App\Http\Controllers\UserController::class, 'user_signature_deleted']);
	Route::post('/admin/user_salary_delete', [App\Http\Controllers\UserController::class, 'user_salary_delete']);


    Route::post('/common/profile_details', [App\Http\Controllers\CommonController::class, 'profile_details']);
 	Route::post('/common/qrcode_update', [App\Http\Controllers\CommonController::class, 'qrcode_update']);
	Route::post('/common/google_auth_check', [App\Http\Controllers\CommonController::class, 'google_auth_check']);

//}
// if($_REQUEST['moduleType']=='customer'){
    Route::post('/customer/getCustomerCode',[App\Http\Controllers\CustomerController::class, 'getCustomerCode']);
  // Route::get('/customer/getCustomerCode',[App\Http\Controllers\CustomerController::class, 'getCustomerCode']);
    Route::post('/customer/get_det', [App\Http\Controllers\CustomerController::class, 'get_det']);
    Route::post('/customer/get_reseller_det', [App\Http\Controllers\CustomerController::class, 'get_reseller_det']);
    Route::post('/customer/add_customer', [App\Http\Controllers\CustomerController::class, 'add_customer']);
    Route::post('/customer/save', [App\Http\Controllers\CustomerController::class, 'CustomerSave']);
    // Route::post('/customer/{customerId}/edit', [App\Http\Controllers\CustomerController::class, 'edit']);
    Route::post('/customer/edit', [App\Http\Controllers\CustomerController::class, 'edit']);
    Route::post('/customer/update', [App\Http\Controllers\CustomerController::class, 'update']);
    Route::post('/customer/special_edit', [App\Http\Controllers\CustomerController::class, 'special_edit']);
    Route::post('/customer/special_update', [App\Http\Controllers\CustomerController::class, 'special_update']);
    Route::post('/customer/invoice_share_edit', [App\Http\Controllers\CustomerController::class, 'invoice_share_edit']);
    Route::post('/customer/invoice_share_update', [App\Http\Controllers\CustomerController::class, 'invoice_share_update']);
    Route::post('/customer/customer_status_update', [App\Http\Controllers\CustomerController::class, 'customer_status_update']);
    Route::post('/customer/reseller_status_update', [App\Http\Controllers\CustomerController::class, 'reseller_status_update']);
    Route::post('/customer/emp_status_update', [App\Http\Controllers\CustomerController::class, 'emp_status_update']);
    Route::post('/customer/cal4catel_customer_create', [App\Http\Controllers\CustomerController::class, 'cal4catel_customer_create']);
    Route::post('/customer/customer_bill_code_edit', [App\Http\Controllers\CustomerController::class, 'customer_bill_code_edit']);
    Route::post('/customer/customer_bill_code_insert', [App\Http\Controllers\CustomerController::class, 'customer_bill_code_insert']);
    Route::post('/customer/call4tel_address_details', [App\Http\Controllers\CustomerController::class, 'call4tel_address_details']);
    Route::post('/customer/call4tel_address_save', [App\Http\Controllers\CustomerController::class, 'call4tel_address_save']);
    Route::post('/customer/mrvoip_address_details', [App\Http\Controllers\CustomerController::class, 'mrvoip_address_details']);
    Route::post('/customer/mrvoip_address_save', [App\Http\Controllers\CustomerController::class, 'mrvoip_address_save']);
    Route::post('/customer/mconnect_address_details', [App\Http\Controllers\CustomerController::class, 'mconnect_address_details']);
    Route::post('/customer/mconnect_address_save', [App\Http\Controllers\CustomerController::class, 'mconnect_address_save']);
	Route::post('/customer/customer_name_search', [App\Http\Controllers\CustomerController::class, 'customer_name_search']);
	Route::post('/customer/customer_delete', [App\Http\Controllers\CustomerController::class, 'customer_delete']);
    Route::post('/customer/customer_share', [App\Http\Controllers\CustomerController::class, 'customer_share']);
    Route::post('/customer/customer_share_update', [App\Http\Controllers\CustomerController::class, 'customer_share_update']);
    Route::post('/customer/customer_account_manager', [App\Http\Controllers\CustomerController::class, 'customer_account_manager']);
    Route::post('/customer/customer_account_manager_update', [App\Http\Controllers\CustomerController::class, 'customer_account_manager_update']);
	Route::post('/customer/get_billcode_details', [App\Http\Controllers\CustomerController::class, 'get_billcode_details']);
    Route::post('/customer/billcode_details_update', [App\Http\Controllers\CustomerController::class, 'billcode_details_update']);
    Route::post('/customer/customer_email_template', [App\Http\Controllers\CustomerController::class, 'customer_email_template']);
	Route::post('/customer/get_customer_authendication_details', [App\Http\Controllers\CustomerController::class, 'get_customer_authendication_details']);
	Route::post('/customer/customer_file_attachment_save',[App\Http\Controllers\CustomerController::class, 'customer_file_attachment_save']);
	Route::post('/customer/customer_file_attachment_delete',[App\Http\Controllers\CustomerController::class, 'customer_file_attachment_delete']);
	Route::post('/customer/customer_landscape_mail',[App\Http\Controllers\CustomerController::class, 'customer_landscape_mail']);
    Route::post('/customer/account_manager_edit',[App\Http\Controllers\CustomerController::class, 'account_manager_edit']);
	Route::post('/customer/account_manager_update',[App\Http\Controllers\CustomerController::class, 'account_manager_update']);
	Route::post('/customer/customer_quick_mail',[App\Http\Controllers\CustomerController::class, 'customer_quick_mail']);
	Route::post('/customer/nx32_customer_create',[App\Http\Controllers\CustomerController::class, 'nx32_customer_create']);
	Route::post('/customer/bill_code_details',[App\Http\Controllers\CustomerController::class, 'bill_code_details']);
	Route::post('/customer/getCmsDepartment',[App\Http\Controllers\CustomerController::class, 'getCmsDepartment']);




    Route::post('/sendemail/', [App\Http\Controllers\SendEmailController::class, 'index']);
    Route::post('/sendemail/customer_contract_mail', [App\Http\Controllers\SendEmailController::class, 'customer_contract_mail']);
    Route::post('/sendemail/customer_contract_biz_mail', [App\Http\Controllers\SendEmailController::class, 'customer_contract_biz_mail']);
	Route::post('/sendemail/customer_landscape_mail', [App\Http\Controllers\SendEmailController::class, 'customer_landscape_mail']);
    Route::post('/sendemail/quotation_sendmail',[App\Http\Controllers\SendEmailController::class, 'quotation_sendmail']);
	Route::post('/quotation/excel_export', [App\Http\Controllers\QuotationController::class, 'excel_export']);




    Route::post('/quotation/quotation_list', [App\Http\Controllers\QuotationController::class, 'quotation_list']);
    Route::post('/quotation/create_popup', [App\Http\Controllers\QuotationController::class, 'create_popup']);
    Route::post('/quotation/add_quotation', [App\Http\Controllers\QuotationController::class, 'add_quotation']);
	Route::post('/quotation/insert_quotation',[App\Http\Controllers\QuotationController::class, 'insert_quotation']);
	Route::post('/quotation/edit_quotation',[App\Http\Controllers\QuotationController::class, 'edit_quotation']);
	Route::post('/quotation/update_quotation',[App\Http\Controllers\QuotationController::class, 'update_quotation']);
	Route::post('/quotation/edit_enquiry_popup_quotation',[App\Http\Controllers\QuotationController::class, 'edit_enquiry_popup_quotation']);
	Route::post('/quotation/showQuotation',[App\Http\Controllers\QuotationController::class, 'showQuotation']);
	// MR View Quotation

	Route::get('/quotation/show_quotation_pdf',[App\Http\Controllers\QuotationController::class, 'show_quotation_pdf']);
	// MR View Quotation
    // vaithee
    Route::post('/quotation/get_template_maincontent', [App\Http\Controllers\QuotationController::class, 'get_template_maincontent']);
    Route::post('/quotation/get_quotation_terms_condition', [App\Http\Controllers\QuotationController::class, 'get_quotation_terms_condition']);
    Route::post('/quotation/get_customercbo_quat_no', [App\Http\Controllers\QuotationController::class, 'get_customercbo_quat_no']);
    Route::post('/quotation/quot_customer_name', [App\Http\Controllers\QuotationController::class, 'quot_customer_name']);
    Route::post('/quotation/quot_customer_details', [App\Http\Controllers\QuotationController::class, 'quot_customer_details']);
    Route::post('/quotation/quot_tax_dropdown', [App\Http\Controllers\QuotationController::class, 'quot_tax_dropdown']);
    Route::post('/quotation/delete_quotation', [App\Http\Controllers\QuotationController::class, 'delete_quotation']);
    Route::post('/quotation/quotation_shared_person', [App\Http\Controllers\QuotationController::class, 'quotation_shared_person']);
    Route::post('/quotation/quotation_shared_user_update', [App\Http\Controllers\QuotationController::class, 'quotation_shared_user_update']);
    Route::post('/quotation/quotation_permission_user', [App\Http\Controllers\QuotationController::class, 'quotation_permission_user']);
    Route::post('/quotation/get_template_name', [App\Http\Controllers\QuotationController::class, 'get_template_name']);
 	Route::post('/quotation/sendmail_popup_quot',[App\Http\Controllers\QuotationController::class, 'sendmail_popup_quot']);
    Route::post('/quotation/get_email_quotation_template',[App\Http\Controllers\QuotationController::class, 'get_email_quotation_template']);
    Route::post('/quotation/temaplete_name_update', [App\Http\Controllers\QuotationController::class, 'temaplete_name_update']);
    Route::post('/quotation/get_actualcost_quotation_details', [App\Http\Controllers\QuotationController::class, 'get_actualcost_quotation_details']);
    Route::post('/quotation/quotation_attachment_details', [App\Http\Controllers\QuotationController::class, 'quotation_attachment_details']);
    Route::post('/quotation/quotation_attachment_save', [App\Http\Controllers\QuotationController::class, 'quotation_attachment_save']);
    Route::post('/quotation/quotation_attachment_delete', [App\Http\Controllers\QuotationController::class, 'quotation_attachment_delete']);
    Route::post('/quotation/transaction_enquiry_command', [App\Http\Controllers\QuotationController::class, 'transaction_enquiry_command']);
    Route::post('/quotation/transaction_enquiry_command_save', [App\Http\Controllers\QuotationController::class, 'transaction_enquiry_command_save']);
    Route::post('/quotation/set_small_task', [App\Http\Controllers\QuotationController::class, 'set_small_task']);
    Route::post('/quotation/quotation_convert_to_proformainvoice', [App\Http\Controllers\QuotationController::class, 'quotation_convert_to_proformainvoice']);
    Route::post('/quotation/biller_dropdown', [App\Http\Controllers\QuotationController::class, 'biller_dropdown']);
	Route::post('/quotation/delete_quotation_child', [App\Http\Controllers\QuotationController::class, 'delete_quotation_child']);
    Route::post('/quotation/update_actualcost_quotation_value', [App\Http\Controllers\QuotationController::class, 'update_actualcost_quotation_value']);
	Route::post('/quotation/duplicate_enquiry_popup_quotation', [App\Http\Controllers\QuotationController::class, 'duplicate_enquiry_popup_quotation']);
    Route::post('/quotation/duplicate_quotation', [App\Http\Controllers\QuotationController::class, 'duplicate_quotation']);
    Route::post('/quotation/quotation_send_to_approval', [App\Http\Controllers\QuotationController::class, 'quotation_send_to_approval']);
    Route::post('/quotation/user_name_search', [App\Http\Controllers\QuotationController::class, 'user_name_search']);
	Route::post('/quotation/product_name_auto', [App\Http\Controllers\QuotationController::class, 'product_name_auto']);
	Route::post('/quotation/product_name_auto_fill', [App\Http\Controllers\QuotationController::class, 'product_name_auto_fill']);
    Route::post('/quotation/currency_change', [App\Http\Controllers\QuotationController::class, 'currency_change']);
	Route::post('/quotation/get_tax_percent_val', [App\Http\Controllers\QuotationController::class, 'get_tax_percent_val']);
	Route::post('/quotation/quotation_add_signature', [App\Http\Controllers\QuotationController::class, 'quotation_add_signature']);
    Route::post('/quotation/quotation_add_signature_edit', [App\Http\Controllers\QuotationController::class, 'quotation_add_signature_edit']);
	// Route::post('/quotation/quotation_add_tax', [App\Http\Controllers\QuotationController::class, 'quotation_add_tax']);

    // vaithee


    Route::post('/customer_contract/customer_contract_list',[App\Http\Controllers\CusContractController::class, 'customer_contract_list']);
    Route::post('/customer_contract/customer_contract_add',[App\Http\Controllers\CusContractController::class, 'customer_contract_add']);
	Route::post('/customer_contract/customer_contract_save',[App\Http\Controllers\CusContractController::class, 'customer_contract_save']);
    Route::post('/customer_contract/customer_contract_edit_group',[App\Http\Controllers\CusContractController::class, 'customer_contract_edit_group']);
	Route::post('/customer_contract/customer_contract_group_update',[App\Http\Controllers\CusContractController::class, 'customer_contract_group_update']);
    Route::post('/customer_contract/customer_contract_generate_file',[App\Http\Controllers\CusContractController::class, 'customer_contract_generate_file']);
	Route::post('/customer_contract/customer_contract_get_master_file',[App\Http\Controllers\CusContractController::class, 'customer_contract_get_master_file']);
    Route::post('/customer_contract/customer_contract_get_attachment_file',[App\Http\Controllers\CusContractController::class, 'customer_contract_get_attachment_file']);
	Route::post('/customer_contract/customer_contract_attachment_file_save',[App\Http\Controllers\CusContractController::class, 'customer_contract_attachment_file_save']);
	Route::post('/customer_contract/customer_contract_biz_fileDetails',[App\Http\Controllers\CusContractController::class, 'customer_contract_biz_fileDetails']);


	 Route::post('/proforma/proforma_invoice_list', [App\Http\Controllers\ProformaInvoiceController::class, 'proforma_invoice_list']);
     Route::post('/proforma/add_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'add_proforma_invoice']);
	 Route::post('/proforma/get_customer_inv_details', [App\Http\Controllers\ProformaInvoiceController::class, 'get_customer_inv_details']);
	 Route::post('/proforma/edit_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'edit_proforma_invoice']);
	 Route::post('/proforma/update_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'update_proforma_invoice']);
 	 Route::post('/proforma/get_proforma_biller_details', [App\Http\Controllers\ProformaInvoiceController::class, 'get_proforma_biller_details']);
	Route::post('/proforma/get_currency_values', [App\Http\Controllers\ProformaInvoiceController::class, 'get_currency_values']);
    Route::post('/proforma/insert_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'insert_proforma_invoice']);
 	Route::post('/proforma/customer_address_details', [App\Http\Controllers\ProformaInvoiceController::class, 'customer_address_details']);
 	Route::post('/proforma/customer_address_details_billcode', [App\Http\Controllers\ProformaInvoiceController::class, 'customer_address_details_billcode']);
	Route::post('/proforma/tax_dropdown', [App\Http\Controllers\ProformaInvoiceController::class, 'tax_dropdown']);
	Route::post('/proforma/proforma_invoice_payment_details', [App\Http\Controllers\ProformaInvoiceController::class, 'proforma_invoice_payment_details']);
	Route::post('/proforma/proforma_invoice_payment_update', [App\Http\Controllers\ProformaInvoiceController::class, 'proforma_invoice_payment_update']);

	Route::post('/proforma/terms_condition_get', [App\Http\Controllers\ProformaInvoiceController::class, 'terms_condition_get']);
    Route::post('/proforma/terms_condition_update', [App\Http\Controllers\ProformaInvoiceController::class, 'terms_condition_update']);
	Route::post('/proforma/invoice_type_get', [App\Http\Controllers\ProformaInvoiceController::class, 'invoice_type_get']);
    Route::post('/proforma/invoice_type_update', [App\Http\Controllers\ProformaInvoiceController::class, 'invoice_type_update']);
 /*	Route::post('/proforma/update_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'update_proforma_invoice']);
	Route::post('/proforma/delete_billing_child', [App\Http\Controllers\ProformaInvoiceController::class, 'delete_billing_child']);
	Route::post('/proforma/edit_did_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'edit_did_proforma_invoice']);
 	Route::post('/proforma/insert_did_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'insert_did_proforma_invoice']);*/

	Route::post('/proforma/update_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'update_proforma_invoice']);
	Route::post('/proforma/delete_billing_child', [App\Http\Controllers\ProformaInvoiceController::class, 'delete_billing_child']);
	Route::post('/proforma/edit_did_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'edit_did_proforma_invoice']);
 	Route::post('/proforma/insert_did_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'insert_did_proforma_invoice']);
Route::post('/proforma/update_did_proforma_invoice', [App\Http\Controllers\ProformaInvoiceController::class, 'update_did_proforma_invoice']);


Route::post('/invoice/yearValueFilter', [App\Http\Controllers\InvoiceController::class, 'yearValueFilter']);
	 Route::post('/invoice/invoice_list', [App\Http\Controllers\InvoiceController::class, 'invoice_list']);
	 Route::post('/invoice/add_invoice', [App\Http\Controllers\InvoiceController::class, 'add_invoice']);
	 Route::post('/invoice/get_customer_inv_details', [App\Http\Controllers\InvoiceController::class, 'get_customer_inv_details']);
	 Route::post('/invoice/edit_invoice', [App\Http\Controllers\InvoiceController::class, 'edit_invoice']);
 	 Route::post('/invoice/update_invoice', [App\Http\Controllers\InvoiceController::class, 'update_invoice']);
	Route::post('/invoice/update_proforma_invoice', [App\Http\Controllers\InvoiceController::class, 'update_proforma_invoice']);
	Route::post('/invoice/get_biller_details', [App\Http\Controllers\InvoiceController::class, 'get_biller_details']);
	Route::post('/invoice/get_currency_values', [App\Http\Controllers\InvoiceController::class, 'get_currency_values']);
	Route::post('/invoice/insert_invoice', [App\Http\Controllers\InvoiceController::class, 'insert_invoice']);
	Route::post('/invoice/customer_address_details', [App\Http\Controllers\InvoiceController::class, 'customer_address_details']);
	Route::post('/invoice/tax_dropdown', [App\Http\Controllers\InvoiceController::class, 'tax_dropdown']);
	Route::post('/invoice/invoice_payment_details', [App\Http\Controllers\InvoiceController::class, 'invoice_payment_details']);
	Route::post('/invoice/invoice_payment_update', [App\Http\Controllers\InvoiceController::class, 'invoice_payment_update']);




	Route::post('/invoice/terms_condition_get', [App\Http\Controllers\InvoiceController::class, 'terms_condition_get']);
	Route::post('/invoice/terms_condition_update', [App\Http\Controllers\InvoiceController::class, 'terms_condition_update']);
	Route::post('/invoice/invoice_type_get', [App\Http\Controllers\InvoiceController::class, 'invoice_type_get']);
	Route::post('/invoice/invoice_type_update', [App\Http\Controllers\InvoiceController::class, 'invoice_type_update']);
	Route::post('/invoice/delete_billing_child', [App\Http\Controllers\InvoiceController::class, 'delete_billing_child']);
	Route::post('/invoice/reccuring_details', [App\Http\Controllers\InvoiceController::class, 'reccuring_details']);
	Route::post('/invoice/update_reccuring_details', [App\Http\Controllers\InvoiceController::class, 'update_reccuring_details']);
	Route::post('/invoice/invoice_to_proforma', [App\Http\Controllers\InvoiceController::class, 'invoice_to_proforma']);
	Route::post('/invoice/invoice_to_delivery_order', [App\Http\Controllers\InvoiceController::class, 'invoice_to_delivery_order']);
	Route::post('/invoice/revenue_details', [App\Http\Controllers\InvoiceController::class, 'revenue_details']);
	Route::post('/invoice/revenue_details_update', [App\Http\Controllers\InvoiceController::class, 'revenue_update']);
	Route::post('/invoice/invoice_notes_get', [App\Http\Controllers\InvoiceController::class, 'invoice_notes_get']);
	Route::post('/invoice/invoice_notes_update', [App\Http\Controllers\InvoiceController::class, 'invoice_notes_update']);
	Route::post('/invoice/invoice_attachment_details', [App\Http\Controllers\InvoiceController::class, 'invoice_attachment_details']);
	Route::post('/invoice/invoice_attachment_save', [App\Http\Controllers\InvoiceController::class, 'invoice_attachment_save']);
	Route::post('/invoice/invoice_attachment_delete', [App\Http\Controllers\InvoiceController::class, 'invoice_attachment_delete']);
	Route::post('/invoice/local_to_export', [App\Http\Controllers\InvoiceController::class, 'local_to_export']);
    Route::post('/invoice/duplicate_invoice', [App\Http\Controllers\InvoiceController::class, 'duplicate_invoice']);
	Route::post('/invoice/get_invoice_send_details', [App\Http\Controllers\InvoiceController::class, 'get_invoice_send_details']);
	Route::post('/invoice/invoice_send_details_update', [App\Http\Controllers\InvoiceController::class, 'invoice_send_details_update']);
	Route::post('/invoice/get_invoice_licence_details', [App\Http\Controllers\InvoiceController::class, 'get_invoice_licence_details']);
    Route::post('/invoice/get_actualcost_details', [App\Http\Controllers\InvoiceController::class, 'get_actualcost_details']);
    Route::post('/invoice/update_actualcost_details', [App\Http\Controllers\InvoiceController::class, 'update_actualcost_details']);
 	Route::post('/invoice/reseller_name_details', [App\Http\Controllers\InvoiceController::class, 'reseller_name_details']);
	Route::post('/invoice/get_reseller_commission_details', [App\Http\Controllers\InvoiceController::class, 'get_reseller_commission_details']);
	Route::post('/invoice/update_reseller_commission_details', [App\Http\Controllers\InvoiceController::class, 'update_reseller_commission_details']);

	Route::post('/invoice/invoice_to_quotation', [App\Http\Controllers\InvoiceController::class, 'invoice_to_quotation']);
Route::post('/invoice/getStatus', [App\Http\Controllers\InvoiceController::class, 'getStatus']);

// vaithee - 14-02-23
   Route::post('/invoice/invoice_list', [App\Http\Controllers\InvoiceController::class, 'invoice_list']);
   Route::post('/invoice/inv_reseller_name', [App\Http\Controllers\InvoiceController::class, 'inv_reseller_name']);

   Route::post('/invoice/invoice_shared_person', [App\Http\Controllers\InvoiceController::class, 'invoice_shared_person']);
   Route::post('/invoice/invoice_shared_update', [App\Http\Controllers\InvoiceController::class, 'invoice_shared_update']);
   Route::post('/invoice/post_send_status_get', [App\Http\Controllers\InvoiceController::class, 'post_send_status_get']);
   Route::post('/invoice/post_send_status_update', [App\Http\Controllers\InvoiceController::class, 'post_send_status_update']);
   Route::post('/invoice/invoice_to_did', [App\Http\Controllers\InvoiceController::class, 'invoice_to_did']);
   Route::post('/invoice/did_to_invoice', [App\Http\Controllers\InvoiceController::class, 'did_to_invoice']);
   Route::post('/invoice/invoice_add_signature', [App\Http\Controllers\InvoiceController::class, 'invoice_add_signature']);
   Route::post('/invoice/invoice_add_signature_edit', [App\Http\Controllers\InvoiceController::class, 'invoice_add_signature_edit']);
   Route::post('/invoice/previous_due_set_details', [App\Http\Controllers\InvoiceController::class, 'previous_due_set_details']);
   Route::post('/invoice/getSuspendInvoiceList', [App\Http\Controllers\InvoiceController::class, 'getSuspendInvoiceList']);
   Route::post('/invoice/deleteSuspendList', [App\Http\Controllers\InvoiceController::class, 'deleteSuspendList']);
   Route::post('/invoice/deleteMultipleSuspendList', [App\Http\Controllers\InvoiceController::class, 'deleteMultipleSuspendList']);

 Route::post('/invoice/get_credit_note_details', [App\Http\Controllers\InvoiceController::class, 'get_credit_note_details']);
 Route::post('/invoice/get_edit_payment_process', [App\Http\Controllers\InvoiceController::class, 'get_edit_payment_process']);
 Route::post('/invoice/update_payment_process', [App\Http\Controllers\InvoiceController::class, 'update_payment_process']);


   Route::post('/invoice/suspend_invoice', [App\Http\Controllers\InvoiceController::class, 'suspend_invoice']);
   Route::post('/invoice/send_invoice_details', [App\Http\Controllers\InvoiceController::class, 'send_invoice_details']);
   Route::post('/invoice/invoice_details_sendmail', [App\Http\Controllers\InvoiceController::class, 'invoice_details_sendmail']);

   Route::post('/invoice/proforma_convert_to_invoice', [App\Http\Controllers\InvoiceController::class, 'proforma_convert_to_invoice']);
   Route::get('/invoice/getBillpdf', [App\Http\Controllers\InvoicePdfController::class, 'getBillpdf']);
   Route::get('/invoice/getDidBillpdf', [App\Http\Controllers\DidInvoicePdfController::class, 'getDidBillpdf']);


	Route::post('/purchaseorder/purchase_order_list', [App\Http\Controllers\PurchaseOrderController::class, 'purchase_order_list']);
	Route::post('/purchaseorder/biller_change_details', [App\Http\Controllers\PurchaseOrderController::class, 'biller_change_details']);
	Route::post('/purchaseorder/add_purchase_order', [App\Http\Controllers\PurchaseOrderController::class, 'add_purchase_order']);
	Route::post('/purchaseorder/vendor_name_details', [App\Http\Controllers\PurchaseOrderController::class, 'vendor_name_details']);
    Route::post('/purchaseorder/vendor_address_details', [App\Http\Controllers\PurchaseOrderController::class, 'vendor_address_details']);
    Route::post('/purchaseorder/insert_purchaseorder', [App\Http\Controllers\PurchaseOrderController::class, 'insert_purchaseorder']);
    Route::post('/purchaseorder/edit_purchase_order', [App\Http\Controllers\PurchaseOrderController::class, 'edit_purchase_order']);
	Route::post('/purchaseorder/update_purchase_order', [App\Http\Controllers\PurchaseOrderController::class, 'update_purchase_order']);
	Route::get('/purchaseorder/getPurchaseOrderPdfShow', [App\Http\Controllers\PurchaseOrderPdfController::class, 'getPurchaseOrderPdfShow']);
	Route::post('/purchaseorder/delete_purchase_order', [App\Http\Controllers\PurchaseOrderController::class, 'delete_purchase_order']);
	Route::post('/purchaseorder/po_send_to_approval', [App\Http\Controllers\PurchaseOrderController::class, 'po_send_to_approval']);
	Route::post('/purchaseorder/tax_details_cbo', [App\Http\Controllers\PurchaseOrderController::class, 'tax_details_cbo']);
	Route::post('/purchaseorder/delete_purchase_order_child', [App\Http\Controllers\PurchaseOrderController::class, 'delete_purchase_order_child']);



   Route::post('/deliveryorder/delivery_order_list', [App\Http\Controllers\DeliveryOrderController::class, 'delivery_order_list']);
   Route::post('/deliveryorder/delivery_order_customername', [App\Http\Controllers\DeliveryOrderController::class, 'delivery_order_customername']);
	Route::post('/deliveryorder/get_customer_invoice', [App\Http\Controllers\DeliveryOrderController::class, 'get_customer_invoice']);
	Route::post('/deliveryorder/add_delivery_order', [App\Http\Controllers\DeliveryOrderController::class, 'add_delivery_order']);
	Route::post('/deliveryorder/edit_delivery_order', [App\Http\Controllers\DeliveryOrderController::class, 'edit_delivery_order']);
	Route::post('/deliveryorder/edit_duplicate_delivery_order', [App\Http\Controllers\DeliveryOrderController::class, 'edit_duplicate_delivery_order']);
	Route::post('/deliveryorder/biller_change_details', [App\Http\Controllers\DeliveryOrderController::class, 'biller_change_details']);
	Route::post('/deliveryorder/delete_delivery', [App\Http\Controllers\DeliveryOrderController::class, 'delete_delivery']);
	Route::post('/deliveryorder/insert_delivery_order', [App\Http\Controllers\DeliveryOrderController::class, 'insert_delivery_order']);
    Route::post('/deliveryorder/update_delivery_order', [App\Http\Controllers\DeliveryOrderController::class, 'update_delivery_order']);
	Route::get('/deliveryorder/getDOpdfShow', [App\Http\Controllers\DOPdfController::class, 'getDOpdfShow']);
	Route::post('/deliveryorder/shared_delivery', [App\Http\Controllers\DeliveryOrderController::class, 'shared_delivery']);


// vaithee - 14-02-23


// vaithee - 6-8-22
    Route::post('/customer_contract/customer_contract_remarks',[App\Http\Controllers\CusContractController::class, 'customer_contract_remarks']);
    Route::post('/customer_contract/contract_comments_save',[App\Http\Controllers\CusContractController::class, 'contract_comments_save']);
    Route::post('/customer_contract/delete_individual',[App\Http\Controllers\CusContractController::class, 'delete_individual']);
    Route::post('/customer_contract/group_delete',[App\Http\Controllers\CusContractController::class, 'group_delete']);
    Route::post('/customer_contract/invoice_attachment',[App\Http\Controllers\CusContractController::class, 'invoice_attachment']);
    Route::post('/customer_contract/save_invoice_contract_details',[App\Http\Controllers\CusContractController::class, 'save_invoice_contract_details']);
    Route::post('/customer_contract/contract_classification_list',[App\Http\Controllers\CusContractController::class, 'contract_classification_list']);
    Route::post('/customer_contract/contract_classification_save',[App\Http\Controllers\CusContractController::class, 'contract_classification_save']);
    Route::post('/customer_contract/contract_classification_delete',[App\Http\Controllers\CusContractController::class, 'contract_classification_delete']);
    Route::post('/customer_contract/contract_classification_edit',[App\Http\Controllers\CusContractController::class, 'contract_classification_edit']);
    Route::post('/customer_contract/contract_classification_update',[App\Http\Controllers\CusContractController::class, 'contract_classification_update']);
    Route::post('/customer/view_customer_details', [App\Http\Controllers\CustomerController::class, 'view_customer_details']);
    Route::post('/customer/get_customer_nx32_permission', [App\Http\Controllers\CustomerController::class, 'get_customer_nx32_permission']);
    Route::post('/customer/customer_nx32_update', [App\Http\Controllers\CustomerController::class, 'customer_nx32_update']);
    Route::post('/customer/get_file_attachment_details', [App\Http\Controllers\CustomerController::class, 'get_file_attachment_details']);
    Route::post('/customer/delete_file_attachment', [App\Http\Controllers\CustomerController::class, 'delete_file_attachment']);
// vaithee - 6-8-22

	Route::post('/customer_contract/contract_master_file_list',[App\Http\Controllers\CusContractController::class, 'contract_master_file_list']);
    Route::post('/customer_contract/contract_master_file_add',[App\Http\Controllers\CusContractController::class, 'contract_master_file_add']);
    Route::post('/customer_contract/contract_master_file_delete',[App\Http\Controllers\CusContractController::class, 'contract_master_file_delete']);


Route::post('/customer_contract/contract_details_list',[App\Http\Controllers\CusContractController::class, 'contract_details_list']);
Route::post('/customer_contract/contract_details_add',[App\Http\Controllers\CusContractController::class, 'contract_details_add']);
Route::post('/customer_contract/contract_details_save',[App\Http\Controllers\CusContractController::class, 'contract_details_save']);
Route::post('/customer_contract/contract_details_edit',[App\Http\Controllers\CusContractController::class, 'contract_details_edit']);
Route::post('/customer_contract/contract_details_update',[App\Http\Controllers\CusContractController::class, 'contract_details_update']);
Route::post('/customer_contract/contract_details_delete',[App\Http\Controllers\CusContractController::class, 'contract_details_delete']);
Route::post('/customer_contract/contract_biz_file_send_form',[App\Http\Controllers\CusContractController::class, 'contract_biz_file_send_form']);
Route::post('/customer_contract/customer_contract_update_bizzFile',[App\Http\Controllers\CusContractController::class, 'customer_contract_update_bizzFile']);
Route::post('/customer_contract/customer_contract_approve_status',[App\Http\Controllers\CusContractController::class, 'customer_contract_approve_status']);
Route::post('/customer_contract/customer_contract_approve_update',[App\Http\Controllers\CusContractController::class, 'customer_contract_approve_update']);

Route::post('/customer_contract/customer_contract_attachment_delete',[App\Http\Controllers\CusContractController::class, 'customer_contract_attachment_delete']);


Route::post('/transaction_entry/transaction_entry_list',[App\Http\Controllers\TransactionEntryController::class, 'transaction_entry_list']);
Route::post('/transaction_entry/purchase_entry_addnew',[App\Http\Controllers\TransactionEntryController::class, 'purchase_entry_addnew']);
Route::post('/transaction_entry/purchase_entry_save',[App\Http\Controllers\TransactionEntryController::class, 'purchase_entry_save']);
Route::post('/transaction_entry/purchase_entry_edit',[App\Http\Controllers\TransactionEntryController::class, 'purchase_entry_edit']);
Route::post('/transaction_entry/purchase_entry_update',[App\Http\Controllers\TransactionEntryController::class, 'purchase_entry_update']);
Route::post('/transaction_entry/purchase_entry_delete',[App\Http\Controllers\TransactionEntryController::class, 'purchase_entry_delete']);
Route::post('/transaction_entry/edit_file_atttachment_delete',[App\Http\Controllers\TransactionEntryController::class, 'edit_file_atttachment_delete']);
Route::post('/transaction_entry/payment_entry_invoice_no',[App\Http\Controllers\TransactionEntryController::class, 'payment_entry_invoice_no']);
Route::post('/transaction_entry/payment_entry_payment_details',[App\Http\Controllers\TransactionEntryController::class, 'payment_entry_payment_details']);
Route::post('/transaction_entry/petty_cash_save',[App\Http\Controllers\TransactionEntryController::class, 'petty_cash_save']);
Route::post('/transaction_entry/petty_cash_edit',[App\Http\Controllers\TransactionEntryController::class, 'petty_cash_edit']);
Route::post('/transaction_entry/petty_cash_update',[App\Http\Controllers\TransactionEntryController::class, 'petty_cash_update']);
Route::post('/transaction_entry/logistics_save',[App\Http\Controllers\TransactionEntryController::class, 'logistics_save']);

Route::post('/transaction_entry/invoice_payment_save',[App\Http\Controllers\TransactionEntryController::class, 'invoice_payment_save']);
Route::post('/transaction_entry/invoice_payment_edit',[App\Http\Controllers\TransactionEntryController::class, 'invoice_payment_edit']);

Route::post('/addproduct_stock/get_prodoct_entry_stock_name',[App\Http\Controllers\ProductStockEntryController::class, 'get_prodoct_entry_stock_name']);
Route::post('/product_stock/get_product_serial_state',[App\Http\Controllers\ProductStockEntryController::class, 'get_product_serial_state']);

Route::post('/transaction_entry/add_new_stock_save',[App\Http\Controllers\ProductStockEntryController::class, 'add_new_stock_save']);
Route::post('/transaction_entry/editNewStock',[App\Http\Controllers\ProductStockEntryController::class, 'editNewStock']);
Route::post('/transaction_entry/product_entry_update',[App\Http\Controllers\ProductStockEntryController::class, 'product_entry_update']);


Route::post('/transaction_approval/quotation_approval',[App\Http\Controllers\TransactionApproval::class, 'quotation_approval']);
Route::post('/transaction_approval/get_quotation_comments',[App\Http\Controllers\TransactionApproval::class, 'get_quotation_comments']);
Route::post('/transaction_approval/update_quotation_comments',[App\Http\Controllers\TransactionApproval::class, 'update_quotation_comments']);
Route::post('/transaction_approval/quotation_approved',[App\Http\Controllers\TransactionApproval::class, 'quotation_approved']);
Route::post('/transaction_approval/quotation_rejected',[App\Http\Controllers\TransactionApproval::class, 'quotation_rejected']);

Route::post('/transaction_approval/main_approval',[App\Http\Controllers\TransactionApproval::class, 'main_approval']);
Route::post('/transaction_approval/main_approved',[App\Http\Controllers\TransactionApproval::class, 'main_approved']);


 Route::post('/pdf/pdf_test',[App\Http\Controllers\PdfController::class, 'index']);

// vaithee 28-2-23
 Route::post('/license/api_key_list', [App\Http\Controllers\LicenseController::class, 'api_key_list']);
 Route::post('/license/apikey_status_change', [App\Http\Controllers\LicenseController::class, 'apikey_status_change']);
 Route::post('/license/overall_apikey_status', [App\Http\Controllers\LicenseController::class, 'overall_apikey_status']);
 Route::post('/license/update_overall_apikey_status', [App\Http\Controllers\LicenseController::class, 'update_overall_apikey_status']);
 Route::post('/license/credit_data_check', [App\Http\Controllers\LicenseController::class, 'credit_data_check']);
 Route::post('/license/dcare_credit_data_check', [App\Http\Controllers\LicenseController::class, 'dcare_credit_data_check']);
// vaithee 28-2-23





	Route::post('/did/did_invoice_list', [App\Http\Controllers\DidController::class, 'did_invoice_list']);
     Route::post('/did/insert_did_invoice', [App\Http\Controllers\DidController::class, 'insert_did_invoice']);
     Route::post('/did/invoice_list', [App\Http\Controllers\DidController::class, 'invoice_list']);
	 Route::post('/did/add_invoice', [App\Http\Controllers\DidController::class, 'add_invoice']);
	 Route::post('/did/get_customer_inv_details', [App\Http\Controllers\DidController::class, 'get_customer_inv_details']);
	 Route::post('/did/edit_did_invoice', [App\Http\Controllers\DidController::class, 'edit_did_invoice']);
 	 Route::post('/did/update_invoice', [App\Http\Controllers\DidController::class, 'update_invoice']);
	 Route::post('/did/update_proforma_invoice', [App\Http\Controllers\DidController::class, 'update_proforma_invoice']);
	 Route::post('/did/get_biller_details', [App\Http\Controllers\DidController::class, 'get_biller_details']);
	Route::post('/did/get_currency_values', [App\Http\Controllers\DidController::class, 'get_currency_values']);
	Route::post('/did/insert_invoice', [App\Http\Controllers\DidController::class, 'insert_invoice']);
	Route::post('/did/customer_address_details', [App\Http\Controllers\DidController::class, 'customer_address_details']);
	Route::post('/did/tax_dropdown', [App\Http\Controllers\DidController::class, 'tax_dropdown']);
	Route::post('/did/invoice_payment_details', [App\Http\Controllers\DidController::class, 'invoice_payment_details']);
	Route::post('/did/invoice_payment_update', [App\Http\Controllers\DidController::class, 'invoice_payment_update']);




	Route::post('/did/terms_condition_get', [App\Http\Controllers\DidController::class, 'terms_condition_get']);
	Route::post('/did/terms_condition_update', [App\Http\Controllers\DidController::class, 'terms_condition_update']);
	Route::post('/did/invoice_type_get', [App\Http\Controllers\DidController::class, 'invoice_type_get']);
	Route::post('/did/invoice_type_update', [App\Http\Controllers\DidController::class, 'invoice_type_update']);
	Route::post('/did/delete_billing_child', [App\Http\Controllers\DidController::class, 'delete_billing_child']);
	Route::post('/did/reccuring_details', [App\Http\Controllers\DidController::class, 'reccuring_details']);
	Route::post('/did/update_reccuring_details', [App\Http\Controllers\DidController::class, 'update_reccuring_details']);
	Route::post('/did/invoice_to_proforma', [App\Http\Controllers\DidController::class, 'invoice_to_proforma']);
	Route::post('/did/invoice_to_delivery_order', [App\Http\Controllers\DidController::class, 'invoice_to_delivery_order']);
	Route::post('/did/revenue_details', [App\Http\Controllers\DidController::class, 'revenue_details']);
	Route::post('/did/revenue_details_update', [App\Http\Controllers\DidController::class, 'revenue_update']);
	Route::post('/did/invoice_notes_get', [App\Http\Controllers\DidController::class, 'invoice_notes_get']);
	Route::post('/did/invoice_notes_update', [App\Http\Controllers\DidController::class, 'invoice_notes_update']);
	Route::post('/did/invoice_attachment_details', [App\Http\Controllers\DidController::class, 'invoice_attachment_details']);
	Route::post('/did/invoice_attachment_save', [App\Http\Controllers\DidController::class, 'invoice_attachment_save']);
	Route::post('/did/invoice_attachment_delete', [App\Http\Controllers\DidController::class, 'invoice_attachment_delete']);
	Route::post('/did/local_to_export', [App\Http\Controllers\DidController::class, 'local_to_export']);
    Route::post('/did/duplicate_invoice', [App\Http\Controllers\DidController::class, 'duplicate_invoice']);
	Route::post('/did/get_invoice_send_details', [App\Http\Controllers\DidController::class, 'get_invoice_send_details']);
	Route::post('/did/invoice_send_details_update', [App\Http\Controllers\DidController::class, 'invoice_send_details_update']);
	Route::post('/did/get_invoice_licence_details', [App\Http\Controllers\DidController::class, 'get_invoice_licence_details']);
    Route::post('/did/get_actualcost_details', [App\Http\Controllers\DidController::class, 'get_actualcost_details']);
    Route::post('/did/update_actualcost_details', [App\Http\Controllers\DidController::class, 'update_actualcost_details']);
 	Route::post('/did/reseller_name_details', [App\Http\Controllers\DidController::class, 'reseller_name_details']);
	Route::post('/did/get_reseller_commission_details', [App\Http\Controllers\DidController::class, 'get_reseller_commission_details']);
	Route::post('/did/update_reseller_commission_details', [App\Http\Controllers\DidController::class, 'update_reseller_commission_details']);

	Route::post('/did/invoice_to_quotation', [App\Http\Controllers\DidController::class, 'invoice_to_quotation']);
Route::post('/did/getStatus', [App\Http\Controllers\DidController::class, 'getStatus']);

// vaithee - 14-02-23
   Route::post('/did/inv_reseller_name', [App\Http\Controllers\DidController::class, 'inv_reseller_name']);

   Route::post('/did/invoice_shared_person', [App\Http\Controllers\DidController::class, 'invoice_shared_person']);
   Route::post('/did/invoice_shared_update', [App\Http\Controllers\DidController::class, 'invoice_shared_update']);
   Route::post('/did/post_send_status_get', [App\Http\Controllers\DidController::class, 'post_send_status_get']);
   Route::post('/did/post_send_status_update', [App\Http\Controllers\DidController::class, 'post_send_status_update']);
   Route::post('/did/invoice_to_did', [App\Http\Controllers\DidController::class, 'invoice_to_did']);
   Route::post('/did/did_to_invoice', [App\Http\Controllers\DidController::class, 'did_to_invoice']);
   Route::post('/did/invoice_add_signature', [App\Http\Controllers\DidController::class, 'invoice_add_signature']);
   Route::post('/did/invoice_add_signature_edit', [App\Http\Controllers\DidController::class, 'invoice_add_signature_edit']);
   Route::post('/did/previous_due_set_details', [App\Http\Controllers\DidController::class, 'previous_due_set_details']);
   Route::post('/did/getSuspendInvoiceList', [App\Http\Controllers\DidController::class, 'getSuspendInvoiceList']);
   Route::post('/did/deleteSuspendList', [App\Http\Controllers\DidController::class, 'deleteSuspendList']);
   Route::post('/did/deleteMultipleSuspendList', [App\Http\Controllers\DidController::class, 'deleteMultipleSuspendList']);

   Route::post('/did/get_did_usage_charge', [App\Http\Controllers\DidController::class, 'get_did_usage_charge']);

   Route::post('/did/suspend_invoice', [App\Http\Controllers\DidController::class, 'suspend_invoice']);
   Route::post('/did/send_invoice_details', [App\Http\Controllers\DidController::class, 'send_invoice_details']);
   Route::post('/did/invoice_details_sendmail', [App\Http\Controllers\DidController::class, 'invoice_details_sendmail']);

   Route::post('/did/proforma_convert_to_invoice', [App\Http\Controllers\DidController::class, 'proforma_convert_to_invoice']);
   Route::get('/did/getBillpdf', [App\Http\Controllers\InvoicePdfController::class, 'getBillpdf']);
   Route::get('/did/getDidBillpdf', [App\Http\Controllers\DidInvoicePdfController::class, 'getDidBillpdf']);



/*-------------------------global search--------------------*/
   Route::post('/global/getCustomerCode', [App\Http\Controllers\GlobalController::class, 'getCustomerCode']);
     Route::post('/global/getCustomerName', [App\Http\Controllers\GlobalController::class, 'getCustomerName']);
     Route::post('/global/getDidNumber', [App\Http\Controllers\GlobalController::class, 'getDidNumber']);
     Route::post('/global/getLicenseNumber', [App\Http\Controllers\GlobalController::class, 'getLicenseNumber']);
     Route::post('/global/globalSearchAll', [App\Http\Controllers\GlobalController::class, 'globalSearchAll']);
     Route::post('/global/getMenuList', [App\Http\Controllers\GlobalController::class, 'getMenuList']);
  Route::post('/global/get_contract', [App\Http\Controllers\GlobalController::class, 'get_contract']);
  Route::post('/global/get_did_number_customer', [App\Http\Controllers\GlobalController::class, 'get_did_number_customer']);
  Route::post('/global/get_license_number_customer', [App\Http\Controllers\GlobalController::class, 'get_license_number_customer']);



Route::post('/reseller/getResellerPaymentDetails',[App\Http\Controllers\ResellerController::class, 'getResellerPaymentDetails']);
Route::post('/reseller/resellercomm_list',[App\Http\Controllers\ResellerController::class, 'resellercomm_list']);
Route::post('/reseller/edit_resellercomm_list',[App\Http\Controllers\ResellerController::class, 'edit_resellercomm_list']);
Route::post('/reseller/updateResellerComm',[App\Http\Controllers\ResellerController::class, 'updateResellerComm']);
Route::post('/reseller/delete_reseller_payment',[App\Http\Controllers\ResellerController::class, 'delete_reseller_payment']);
Route::post('/reseller/get_reseller_payment_list',[App\Http\Controllers\ResellerController::class, 'get_reseller_payment_list']);
Route::post('/reseller/reseller_comm_shared_option_update',[App\Http\Controllers\ResellerController::class, 'reseller_comm_shared_option_update']);
Route::post('/reseller/getResellerPermissionList',[App\Http\Controllers\ResellerController::class, 'getResellerPermissionList']);
Route::post('/reseller/getResellerGrossAmount',[App\Http\Controllers\ResellerController::class, 'getResellerGrossAmount']);
Route::post('/reseller/reseller_comm_update',[App\Http\Controllers\ResellerController::class, 'reseller_comm_update']);
Route::post('/reseller/getResellerNames',[App\Http\Controllers\ResellerController::class, 'getResellerNames']);
Route::post('/reseller/resellercomm_search_list',[App\Http\Controllers\ResellerController::class, 'resellercomm_search_list']);
Route::post('/reseller/getPaymentmethod',[App\Http\Controllers\ResellerController::class, 'getPaymentmethod']);
Route::post('/reseller/updateAllResellerAmount',[App\Http\Controllers\ResellerController::class, 'updateAllResellerAmount']);

// }

// Route::post('', [App\Http\Controllers\API\AuthController::class, 'login']);


/*

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Route::post('Customer/save', 'CustomerController@save')->name('Customer.save');
//Route::resource('Customer', 'CustomerController');

Route::post('/customer/save', [App\Http\Controllers\CustomerController::class, 'CustomerSave']);
// http://127.0.0.1:8000/api/customer/3/edit
Route::post('/customer/{customer_id}/edit', [App\Http\Controllers\CustomerController::class, 'edit']);

// http://127.0.0.1:8000/api/customer/3/update
Route::post('/customer/{customer_id}/update', [App\Http\Controllers\CustomerController::class, 'update']);

Route::post('/customer/get_det', [App\Http\Controllers\CustomerController::class, 'get_det']);


*/


// Routes for











//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});
