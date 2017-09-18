<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('User Signup');

$I->amOnPage('/user/signup');
$I->see('Sign up');

$I->fillField('UserSignupForm[Email]', 'fformula@gmail.com');
$I->click('Next');


