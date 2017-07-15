<?php

namespace UnionBank\Api;

class Consumer extends Api {
    protected $client_id = 'e568818e-597a-4ba2-9754-393d43944393';
    protected $client_secret = 'tA5uG4sG8mM4wS2hY3rY3dN0sI6nI7vB2tF4eV2bJ1oY3cO1pD';

    public function computeHousingLoan($term, $price, $dp)
    {
        $query = [
            'term' => $term,
            'price' => $price,
            'dp' => $dp,''
        ];

        return $this->request("/housing/loans/compute", $query);
    }

    public function computeAutoLoan($term, $price, $dp)
    {
        $query = [
            'term' => $term,
            'price' => $price,
            'dp' => $dp,''
        ];

        return $this->request("/auto/loans/compute", $query);
    } 
}
