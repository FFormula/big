<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('User Signup');

$I->amOnPage('/en/user/signup');
$I->see('Sign up');

$I->fillField('UserSignupForm[email]', 'fformula@tester.info');
$I->submitForm('#user-signup-form', []);


