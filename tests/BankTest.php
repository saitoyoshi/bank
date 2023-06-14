<?php

require_once __DIR__ . '/../lib/Account.php';
require_once __DIR__ . '/../lib/Bank.php';

use PHPUnit\Framework\TestCase;

class BankTest extends TestCase {
    public function testCreateAccount() {
        $bank = new Bank();
        $bank->createAccount('Yamada Taro', '123-456-789');
        $this->assertSame(1, count($bank->getAccounts()));
    }
    public function testFindAccount() {
        $bank = new Bank();
        $bank->createAccount('Yamada Taro', '123-456-789');
        $bank->createAccount('Suzuki Ichiro','231-456-789');
        $bank->createAccount('Tanaka Hanako', '321-456-789');
        $target = $bank->findAccount('231-456-789');
        $this->assertSame('Suzuki Ichiro', $target->getName());
    }
    public function testFindAccountThrowException() {
        $this->expectException('Exception');
        $bank = new Bank();
        $bank->createAccount('Yamada Taro', '123-456-789');
        $bank->createAccount('Suzuki Ichiro','231-456-789');
        $bank->createAccount('Tanaka Hanako', '321-456-789');
        $target = $bank->findAccount('777-777-777');
    }
    public function testTransfer() {
        $bank = new Bank();
        $bank->createAccount('Yamada Taro', '123-456-789', 1000);
        $bank->createAccount('Suzuki Ichiro','231-456-789');
        $bank->createAccount('Tanaka Hanako', '321-456-789', 1500);
        $srcAccount = $bank->findAccount('123-456-789');
        $dstAccount = $bank->findAccount('321-456-789');
        $bank->transfer('123-456-789', '321-456-789', 500);
        $this->assertSame(500, $srcAccount->getBalance());
        $this->assertSame(2000, $dstAccount->getBalance());
    }
    public function testTransferThrowException() {
        $this->expectException('Exception');
        $bank = new Bank();
        $bank->createAccount('Yamada Taro', '123-456-789', 1000);
        $bank->createAccount('Suzuki Ichiro','231-456-789');
        $bank->createAccount('Tanaka Hanako', '321-456-789', 1500);
        $srcAccount = $bank->findAccount('123-456-789');
        $dstAccount = $bank->findAccount('321-456-789');
        $bank->transfer('123-456-789', '321-456-789', 1500);
        $this->assertSame(500, $srcAccount->getBalance());
        $this->assertSame(2000, $dstAccount->getBalance());
    }
}
