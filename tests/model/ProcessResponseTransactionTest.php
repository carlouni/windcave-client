<?php
use Gccm\WindcaveClient\model\ProcessResponseTransaction;

use PHPUnit\Framework\TestCase;

final class ProcessResponseTransactionTest extends TestCase
{
    public function testToXml(): void
    {
        $generateRequest = new ProcessResponseTransaction();
        $generateRequest->setData([
            'PxPayUserId' => 'SampleUserId',
            'PxPayKey' => 'abcdef1234567890abcdef1234567890abcdef1234567890abcdef1234567890',
            'Response' => '00008400001853747f2bc6ded6012345'
        ]);
        $this->assertXmlStringEqualsXmlString(
            $generateRequest->toXml(),
            "<ProcessResponse><PxPayUserId>SampleUserId</PxPayUserId><PxPayKey>abcdef1234567890abcdef1234567890abcdef1234567890abcdef1234567890</PxPayKey><Response>00008400001853747f2bc6ded6012345</Response></ProcessResponse>"
        );
    }

    public function testThrowsExceptionIfInvalidField(): void
    {
        $this->expectException(RuntimeException::class);
        $generateRequest = new ProcessResponseTransaction();
        $generateRequest->setData([
            'InvalidField' => 'This is invalid'
        ]);
    }
}
