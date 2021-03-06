<?php
namespace Redaxscript\Tests;

use Redaxscript\Mailer;

/**
 * MailerTest
 *
 * @since 2.2.0
 *
 * @package Redaxscript
 * @category Tests
 * @author Henry Ruhs
 */

class MailerTest extends TestCaseAbstract
{
	/**
	 * providerMailer
	 *
	 * @since 2.2.0
	 *
	 * @return array
	 */

	public function providerMailer()
	{
		return $this->getProvider('tests/provider/mailer.json');
	}

	/**
	 * testMessage
	 *
	 * @since 2.2.0
	 *
	 * @param array $toArray
	 * @param array $fromArray
	 * @param string $subject
	 * @param mixed $body
	 * @param array $attachmentArray
	 *
	 * @dataProvider providerMailer
	 */

	public function testMessage($toArray = [], $fromArray = [], $subject = null, $body = null, $attachmentArray = [])
	{
		/* setup */

		$mailer = new Mailer();
		$mailer->init($toArray, $fromArray, $subject, $body, $attachmentArray);

		/*compare */

		$this->assertTrue(is_bool($mailer->send()));
	}
}
