<?php

require_once __DIR__ . '/../lib/Account.php';

use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase {
    public function testDeposit() {
        $account = new Account('Yamada Taro', '123-456-789');
        $account->deposit(1000);
        $this->assertSame(1000, $account->getBalance());
    }
    public function testWithdraw() {
        $account = new Account('Yamada Taro', '123-456-789', 1000);
        $account->withdraw(500);
        $this->assertSame(500, $account->getBalance());
    }
    public function testWithdrawThrowException() {
        $this->expectException('Exception');
        $this->expectExceptionMessage('残高よりも多くの');
        $account = new Account('Yamada Taro', '123-456-789', 1000);
        $account->withdraw(1500);
    }
}
