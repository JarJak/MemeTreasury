<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('see homepage');
$I->amOnPage('/');
$I->see("memy.tk");
$I->see("twój osobisty folder ze śmiesznymi obrazkami");