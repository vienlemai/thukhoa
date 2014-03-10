<?php
App::uses('Resource', 'Model');

/**
 * Resource Test Case
 *
 */
class ResourceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.resource'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Resource = ClassRegistry::init('Resource');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Resource);

		parent::tearDown();
	}

}
