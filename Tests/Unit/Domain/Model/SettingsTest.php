<?php

namespace NS\NsProtectSite\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \NS\NsProtectSite\Domain\Model\Settings.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class SettingsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \NS\NsProtectSite\Domain\Model\Settings
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \NS\NsProtectSite\Domain\Model\Settings();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getPasswordReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getPassword()
		);
	}

	/**
	 * @test
	 */
	public function setPasswordForStringSetsPassword()
	{
		$this->subject->setPassword('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'password',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getWhitelistReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getWhitelist()
		);
	}

	/**
	 * @test
	 */
	public function setWhitelistForStringSetsWhitelist()
	{
		$this->subject->setWhitelist('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'whitelist',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStatusReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getStatus()
		);
	}

	/**
	 * @test
	 */
	public function setStatusForStringSetsStatus()
	{
		$this->subject->setStatus('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'status',
			$this->subject
		);
	}
}
