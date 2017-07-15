<?php

namespace LoanAss\Api;

class Financial extends Api {
    protected $client_id = '45f703c8-47fa-4cff-b5b0-317ea4f15d6f';
    protected $client_secret = 'dG0eQ3sJ2iI6tG0nU7tL1aF5dS4qW7uT2kU5jP0iS0iR5dE1eW';

    public function createTestAccount($account_name)
    {
        $query = ['accountName' => $account_name];

        return $this->request("/test/accounts", $query, 'POST', true)[0];
    } 

    public function getAccountInfo($account_number)
    {
        return $this->request("/accounts/{$account_number}")[0];
    }

    public function fundsTransfer($transaction_id, 
        $source_account, $source_currency,
        $target_account, $target_currency,
        $amount)
    {
        $query = [
            "channel_id"        => "UHAC_TEAM",
            "transaction_id"    => $transaction_id,
            "source_account"    => $source_account,
            "source_currency"   => $source_currency,
            "target_account"    => $target_account,
            "target_currency"   => $target_currency,
            "amount"            => $amount,
        ];

        return $this->request("/transfers/initiate", $query, "POST", true);
    }
}
