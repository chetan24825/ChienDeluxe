<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Order;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use PDF;

class OrderController extends Controller
{

    function toorder()
    {
        $orders = Order::orderby('id', "DESC")->paginate(12);
        return view('admin.orders.order', compact('orders'));
    }

    function toorderview($id)
    {
        $order = Order::find($id);
        return view('admin.orders.view', compact('order'));
    }

    function toorderedit(Request $request, $id)
    {
        $product = Order::find($id);
        $originalJson = $product->products;
        $originalData = json_decode($originalJson, true);
        $productNames = $request->input('product_name', []);
        $quantities = $request->input('quantity', []);
        $amounts = $request->input('amount', []);

        foreach ($productNames as $productId => $productName) {
            if (isset($originalData[$productId])) {
                $originalData[$productId]['quantity'] = $quantities[$productId] ?? 0;
                $originalData[$productId]['net_amount'] = $amounts[$productId] ?? 0;
                $originalData[$productId]['product_name'] = $productName ?? '';
            }
        }

        $updatedJson = json_encode($originalData);

        $product->user_name = $request->user_name;
        $product->email = $request->email;
        $product->phone = $request->phone;
        $product->state = $request->state;
        $product->city = $request->city;
        $product->pincode = $request->pincode;
        $product->address = $request->address;
        $product->payment_by = $request->payment_by;
        $product->status = $request->status;
        
         if ($request->net_amount) {
            $product->net_amount = $request->net_amount;
        }
        
        $product->payment_status = $request->payment_status;

        $product->courier_company = $request->courier_company;
        $product->tracking_no = $request->tracking_no;
        $product->courier_date = $request->courier_date;

        $product->shipping_address = json_encode($request->shipping_address);

        $product->coupon_code = $request->coupon_code;
        $product->coupon_code_amount = $request->coupon_code_amount;
        $product->main_amount = $request->main_amount;
        $product->products = $updatedJson;
        if ($product->save()) {
            if (($product->status == 1) && ($product->income_distribute == 0)) {
                $order = Order::find($id);
                $distributeamount = OrderDistributeamount($originalData);
                levelCommision($order->user_id, $distributeamount, $order->id);
                $order->income_distribute = 1;
                $order->save();
                Mail::to(['chetankumar24825@gmail.com', $order->email])->send(new InvoiceMail($product));
            }
            return redirect()->back()->with('success', 'Update Successfully');
        }
        return redirect()->back()->with('error', 'Record Does not Exist');
    }


    function tolead()
    {
        $leads = Lead::orderby('id', "DESC")->paginate(12);
        return view('admin.orders.leads', compact('leads'));
    }

    function toleadview($id)
    {
        $leads = Lead::where('id', $id)->first();
        return view('admin.orders.leadview', compact('leads'));
    }

    function toleaddelete($id)
    {
        try {
            $leads = Lead::find($id);
            if ($leads->delete()) {
                return redirect()->back()->with('success', 'Delete Successfully');
            }
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // function generatePDF(Request $request, $id)
    // {
    //     $order = Order::find($id);
    //     $html = view('mail.invoice', compact('order'))->render();
    //     $pdf = PDF::loadHtml($html)
    //         ->setPaper('a4', 'portrait')
    //         ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    //     return $pdf->download("#" . $order->user_name . "_" . $order->order_id . ".pdf");
    // }
    
    public function generatePDF(Request $request, $id)
    {
        
        $order = Order::findOrFail($id);
        $html = view('mail.invoice', compact('order'))->render();
        $pdf = PDF::loadHtml($html)
            ->setPaper('a4', 'portrait')
            ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream("#" . $order->user_name . "_" . $order->order_id . ".pdf");
    }
}
