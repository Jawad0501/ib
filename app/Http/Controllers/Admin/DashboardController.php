<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Helpers\QuoteStage;
use App\Helpers\QuoteStatus;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request)
    {
        // \Illuminate\Support\Facades\Artisan::call('storage:link');
        $this->authorize('show_dashboard');
        $ordered_quotes = Quote::stage(QuoteStage::ORDER)->get();
        $total_amount = 0;
        foreach($ordered_quotes as $quote){
            foreach($quote->items as $item){
                $total_amount = $total_amount + $item->total;
            }
        }

        $due_quotes = Quote::stage(QuoteStage::ORDER)->where('invoice_status', '!=', 'paid')->get();
        $due_amount = 0;

        foreach($due_quotes as $quote){
            if($quote->invoice_status == 'unpaid'){
                foreach($quote->items as $item){
                    $due_amount = $due_amount + $item->total;
                }
            }
            else{

                $paid_amount = $quote->paid_amount;
                $items_total = 0;

                foreach($quote->items as $item){
                    $items_total = $items_total + $item->total;
                }

                $due_amount = $due_amount + ($items_total - $paid_amount);
            }
        }

        $paid_quotes = Quote::stage(QuoteStage::ORDER)->where('invoice_status', '!=', 'unpaid')->get();
        $total_paid = 0;

        foreach($paid_quotes as $quote){
            $total_paid = $total_paid + $quote->paid_amount;
        }

        $paid_invoices = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->get();
        $unpaid_invoices = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'unpaid')->get();
        $partially_paid_invoices = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'partially paid')->get();

        $paid_in_january = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '01')->get();
        $total_income_in_january = $paid_in_january->sum('paid_amount');

        $paid_in_february = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '02')->get();
        $total_income_in_february = $paid_in_february->sum('paid_amount');

        $paid_in_march = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '02')->get();
        $total_income_in_march = $paid_in_march->sum('paid_amount');

        $paid_in_april = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '04')->get();
        $total_income_in_april = $paid_in_april->sum('paid_amount');

        $paid_in_may = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '05')->get();
        $total_income_in_may = $paid_in_may->sum('paid_amount');

        $paid_in_june = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '06')->get();
        $total_income_in_june = $paid_in_june->sum('paid_amount');

        $paid_in_july = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '07')->get();
        $total_income_in_july = $paid_in_july->sum('paid_amount');

        $paid_in_august = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '08')->get();
        $total_income_in_august = $paid_in_august->sum('paid_amount');

        $paid_in_september = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '09')->get();
        $total_income_in_september = $paid_in_september->sum('paid_amount');

        $paid_in_october = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '10')->get();
        $total_income_in_october = $paid_in_october->sum('paid_amount');

        $paid_in_november = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '11')->get();
        $total_income_in_november = $paid_in_november->sum('paid_amount');

        $paid_in_december = Quote::stage(QuoteStage::ORDER)->where('invoice_status', 'paid')->whereMonth('created_at', '12')->get();
        $total_income_in_december = $paid_in_december->sum('paid_amount');

        $yearly_income = [$total_income_in_january, $total_income_in_february, $total_income_in_march, $total_income_in_april, $total_income_in_may, $total_income_in_june, $total_income_in_july, $total_income_in_august, $total_income_in_september, $total_income_in_october, $total_income_in_november, $total_income_in_december];


        return view('admin.dashboard', compact('total_amount', 'due_amount', 'total_paid', 'paid_invoices', 'unpaid_invoices', 'partially_paid_invoices', 'yearly_income'));
    }
}
