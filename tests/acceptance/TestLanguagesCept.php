<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Check Languages');

$I->amOnPage('/en');
$I->see('Русский', 'a');

$I->amOnPage('/ru');
$I->see('English', 'a');

$I->click('English');
$I->see('Welcome!');

$I->click('Русский');
$I->see('Добро пожаловать!');

