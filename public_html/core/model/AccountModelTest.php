<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 26/11/15
 * Time: 17:34
 */
class AccountModelTest extends PHPUnit_Framework_TestCase {

    public function testTest() {
        $model = new AccountModel();
        $res = $model->removeUtente("sds");
        $this->assertEquals("hell", "ss");
    }
}
