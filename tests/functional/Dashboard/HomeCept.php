<?php

/**
 * Default test case for
 *
 * @var $scenario \Codeception\Scenario
 * @var $I TestGuy
 */
$I = new TestGuy($scenario);
$I->wantTo('enter the application');
$I->amOnPage("/");
$I->see('Slick');
