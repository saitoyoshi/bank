<?php

require_once __DIR__ . '/../lib/Account.php';
require_once __DIR__ . '/../lib/Bank.php';
require_once __DIR__ . '/../lib/Customer.php';

use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase {
    public function testAddAccount() {
        $customer = new Customer('Yamda Taro', '東京都都内某所');
        $bank = new Bank();
        $bank->createAccount($customer->getName(), '123-456-789');
        $account = $bank->findAccount('123-456-789');
        $customer->addAccount($account);
        $this->assertSame(1, count($customer->getAccounts()));
    }
    public function testGetAccountByNumber() {
        $customer = new Customer('Yamda Taro', '東京都都内某所');
        $bank = new Bank();
        $bank->createAccount($customer->getName(), '123-456-789');
        $bank->createAccount($customer->getName(), '213-456-789');
        $bank->createAccount($customer->getName(), '313-456-789');
        foreach ($bank->getAccounts() as $account) {
            $customer->addAccount($account);
        }
        $account1 = $bank->findAccount('213-456-789');
        $account2 = $customer->getAccountByNumber('213-456-789');
        $this->assertSame($account1, $account2);
    }
}
