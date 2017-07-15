# uhack_api

Sample Usage
```
<?php

require_once './vendor/autoload.php';

$info_api = new LoanAss\Api\Info();

$info_api->getAtms();
$info_api->getBranches();

$consumer_api = new LoanAss\Api\Consumer();

$term = 72;
$price = 500000;
$dp = 10;

$consumer_api->computeAutoLoan($term, $price, $dp);
$consumer_api->computeHousingLoan($term, $price, $dp);

$financial_api = new LoanAss\Api\Financial();

$account1 = $financial_api->createTestAccount("Mark Macaso");
$account2 = $financial_api->createTestAccount("Leonel Tomes");
$account3 = $financial_api->createTestAccount('Giovanni Petrache');

$financial_api->fundsTransfer('001', $account1->account_no, "PHP", $account2->account_no, "PHP", 50000);

$account_info = $financial_api->getAccountInfo($account1->account_no);
```
