<?php
/**
 * Copyright 2009-2014, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2009-2014, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('RecaptchaBehavior', 'Recaptcha.Model/Behavior');

/**
 * Slugged Article
 */
class RecaptchaArticle extends CakeTestModel {

/**
 * Class name.
 *
 * @var string
 */
	public $name = 'RecaptchaArticle';

/**
 * An array of names of behaviors to load.
 *
 * @var array
 */
	public $actsAs = array('Recaptcha.Recaptcha');

/**
 * Use table.
 *
 * @var mixed False or table name
 */
	public $useTable = 'articles';
}

/**
 * Recaptcha Test case
 * @property RecaptchaArticle Model
 * @property RecaptchaBehavior Behavior
 */
class RecaptchaBehaviorTest extends CakeTestCase {

/**
 * fixtures property
 *
 * @var array
 */
	public $fixtures = array('plugin.recaptcha.article');

/**
 * Creates the model instance
 *
 * @return void
 */
	public function setUp() {
		$this->Model = new RecaptchaArticle();
		$this->Behavior = new RecaptchaBehavior();
	}

/**
 * Destroy the model instance
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Model);
		unset($this->Behavior);
		ClassRegistry::flush();
	}

/**
 * testValidateCaptcha
 *
 * @return void
 */
	public function testValidateCaptcha() {
		$this->Model->validateCaptcha();
		$result = $this->Model->invalidFields();
		$this->assertTrue(empty($result));
		$this->Model->recaptcha = false;
		$this->Model->recaptchaError = 'Invalid Recaptcha';
		$result = $this->Model->invalidFields();
		$this->assertEquals($result, array('recaptcha' => array('Invalid Recaptcha')));
	}

}
