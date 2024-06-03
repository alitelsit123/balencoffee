<?php

namespace App\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $transaction;

    public function __construct($transaction)
    {
        parent::__construct();

        $this->transaction = $transaction;
    }

    public function getSnapToken()
    {
        $invoiceId = $this->transaction->id.time();
        $this->transaction->provider_id = $invoiceId;
        $this->transaction->save();
        $params = [
            'transaction_details' => [
                'order_id' => $invoiceId,
                'gross_amount' => $this->transaction->total,
            ],
            'item_details' => $this->transaction->detailProducts->map(function($item) {
              return [
                'id' => $item->product->id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
              ];
            }),
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
    public function getStatus() {
      try {
        $status = \Midtrans\Transaction::status($this->transaction->provider_id);
        if ($status->transaction_status == 'pending') {
          if ($this->transaction->status == 'pending') {
            $this->transaction->status = 'waiting';
            $this->transaction->save();
            return true;
          }
        }
      } catch (\Throwable $th) {
        return false;
      }
      return false;
    }
}
