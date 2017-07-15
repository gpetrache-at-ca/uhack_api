<?php

namespace LoanAss\Api;

class Info extends Api {
    protected $client_id = 'd7cb4a22-60a1-420a-863e-f6cfc64da254';
    protected $client_secret = 'hK7jQ2wX1wU2qU5lT6rB0lQ3pX7bE0bQ5jE7nF2uV0vK1nX6sW';


    public function getAtms()
    {
        return $this->request('/locators/atms');
    }

    public function getBranches()
    {
        return $this->request('/locators/branches');
    }

    public function getRates($code, $currency)
    {
        return $this->request("/interest/rates/{$code}/currencies/{$currency}");
    }
}
