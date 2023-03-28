<?php

/**
 * izi-starter
 * Developed: Tushar ahmed
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = ['id'];

    protected static $logName = 'Invoice';

    // RELATION WITH ACCOUNT HEAD
    public function head()
    {
        return $this->hasOne(AccountHead::class, 'id', 'account_head_id')
            ->select('id', 'name');
    }
    // RELATION WITH USER
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')
            ->select('id', 'name', 'email', 'mobile');
    }
    // RELATION WITH MEMBER
    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'member_id')->select('id', 'english_name');
    }

    // STORE INVOICE
    public static function store($user, $data)
    {
        $arr = [
            'user_id'           => $user->id ?? '',
            'account_head_id'   => 1,
            'invoice_date'      => date("Y-m-d"),
            'invoice_number'    => Invoice::generateInvoiceNo(),
            'amount'            => 1000,
            'status'            => "pending",
        ];
        Invoice::create($arr);
    }

    /* GET PAYMENT SUCCESS STATUS FROM SSL */
    public static function paymentSuccess($request)
    {
        $invArr = Invoice::where('invoice_number', $request->tran_id)->first();
        $accArr = Account::where('invoice_number', $request->tran_id)->first();

        // -----------invoice update------------
        $data['status']         = 'success';
        $data['bank_trans_id']  = $request->bank_tran_id ?? "";
        $data['card_type']      = $request->card_type ?? "";
        $data['payment_date']   = date('Y-m-d');
        $data['paid_amount']    = $invArr->amount ?? "";
        $res = $invArr->update($data);

        if ($invArr->account_head_id == 1) //update user status
            User::where('id', $invArr->user_id)->update(["tracking_status" => "Waiting for Approval"]);

        // -----------account create-----------
        $invArr2    = Invoice::where('invoice_number', $request->tran_id)->first()->toArray();
        $accountArr = $invArr2;
        $accountArr['invoice_id'] = $invArr2['id'];
        if (!empty($accArr)) {
            $data['amount'] = $invArr->amount ?? "";
            $accArr->update($data);
        } else {
            Account::create($accountArr);
        }

        return response()->json(true);
    }

    /*
     * GENERATE INVOICE NUMBER
     */
    public static function generateInvoiceNo()
    {
        $invoice_number = 111;
        $invoice = Invoice::latest('invoice_number')->select('invoice_number')->first();
        if ($invoice)
            $invoice_number = $invoice->invoice_number + 1;
        return $invoice_number;
    }
}
