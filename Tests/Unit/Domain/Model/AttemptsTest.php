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
 * Test case for class \NS\NsProtectSite\Domain\Model\Attempts.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AttemptsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \NS\NsProtectSite\Domain\Model\Attempts
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \NS\NsProtectSite\Domain\Model\Attempts();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getIpAddressReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getIpAddress()
		);
	}

	/**
	 * @test
	 */
	public function setIpAddressForStringSetsIpAddress()
	{
		$this->subject->setIpAddress('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ipAddress',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUserAgentReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getUserAgent()
		);
	}

	/**
	 * @test
	 */
	public function setUserAgentForStringSetsUserAgent()
	{
		$this->subject->setUserAgent('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'userAgent',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTimeReturnsInitialValueForDateTime()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getTime()
		);
	}

	/**
	 * @test
	 */
	public function setTimeForDateTimeSetsTime()
	{
		$dateTimeFixture = new \DateTime();
		$this->subject->setTime($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'time',
			$this->subject
		);
	}
}
