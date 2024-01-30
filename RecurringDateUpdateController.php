<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillingParent;
use Illuminate\Support\Facades\DB;

class RecurringDateUpdateController extends Controller
{
    function listData(Request $request)
    {

          $sesRecDate = $request->query('sesRecDate') ?? range(1, 10);

          $billerArray = array_filter($sesRecDate);

          $data = BillingParent::select(
            'billId',
            DB::raw("date_format(billDate, '%d-%m-%Y') as billDate"),
            'cus_invoice_no',
            'custId',
            'billGeneratedBy',
            'billerId',
            'did_invoice_state',
            'fixed_duration',
            'usage_duration',
            'post_send_status',
            'reference_reseller_name',
            'did_bill_code',
            'netPayment',
            'checker_state',
            DB::raw("date_format(fixed_next_rec_date,'%d-%m-%Y') as fixed_next_rec_date"),
            DB::raw("date_format(usage_next_rec_date,'%d-%m-%Y') as usage_next_rec_date"),
            DB::raw("date_format(recured_date,'%d-%m-%Y') as recured_date"),
            DB::raw("date_format(next_recuring_date,'%d-%m-%Y') as next_recuring_date"),
            'billStatus',
          )
              ->where('suspend', '0')
              ->whereIn('billerId', $billerArray)
              ->whereMonth('billDate', '=', now()->month)
              ->where(function ($query) {
                  $query->where('recuring_new_status', '1')
                      ->orWhere('recuring_status', '1');
              })
              ->where(function ($query) {
                  $query->where('fixed_next_rec_date', '<=', now()->addMonths(12))
                      ->orWhere('usage_next_rec_date', '<=', now()->addMonths(12))
                      ->orWhere('next_recuring_date', '<=', now()->addDays(30));
              })
              ->orderByDesc('did_invoice_state')
              ->orderBy('billerId')
              ->orderByDesc('recuring_new_status')
              ->get();

          return response()->json(['data' => $data]);
      }

}

