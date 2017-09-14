<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Check Languages');

$I->amOnPage('/');
$I->see('English', 'a');
$I->see('Русский', 'a');

$I->click('English');
$I->see('Welcome');

$I->click('Русский');
$I->see('Добро пожаловать');

