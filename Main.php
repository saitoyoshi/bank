<?php

require_once __DIR__ . '/lib/Account.php';
require_once __DIR__ . '/lib/Bank.php';
require_once __DIR__ . '/lib/Customer.php';

class Main {
    public function run() {
        $bank = new Bank();

        $customer = new Customer("Yamada Taro", "123-456 Tokyo");

        $bank->createAccount($customer->getName(), '123-456-789');
        $bank->createAccount($customer->getName(), '987-654-321');

        $accounts = $bank->getAccounts();
        foreach ($accounts as $account) {
            $customer->addAccount($account);
        }
        $customer->getAccounts()[0]->deposit(3000);
        $customer->getAccounts()[1]->deposit(2000);

        $customer->getAccounts()[0]->withdraw(1000);
        $bank->transfer('123-456-789', '987-654-321', 1000);

        echo $customer->getAccountByNumber('123-456-789')->getBalance() . PHP_EOL;
        echo $customer->getAccountByNumber('987-654-321')->getBalance() . PHP_EOL;
    }
}

$main = new Main();
$main->run();
