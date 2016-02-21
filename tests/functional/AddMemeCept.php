<?php 
$I = new FunctionalTester($scenario);
$I->wantTo('add a meme');
$I->amOnPage('/');
$I->click('Dodaj');
$I->canSeeInCurrentUrl('/dodaj');
$I->see('Dodaj mem', 'h1');
$I->attachFile('#meme_image_file', 'testmeme.jpg');
$I->click('[type=submit]');
$I->see('Mem został dodany', 'h1');
//to be continued