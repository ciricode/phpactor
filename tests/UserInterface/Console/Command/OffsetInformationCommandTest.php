<?php

namespace Phpactor\Tests\UserInterface\Console\Command;

use Phpactor\Tests\UserInterface\SystemTestCase;

class OffsetInformationCommandTest extends SystemTestCase
{
    public function setUp()
    {
        $this->initWorkspace();
        $this->loadProject('Animals');
    }

    /**
     * @testdox It provides information about the thing under the cursor.
     */
    public function testProvideInformationForOffset()
    {
        $process = $this->phpactor('offset:info lib/Badger.php 137');
        $this->assertSuccess($process);
        $this->assertContains('type: Animals\Badger\Carnivorous', $process->getOutput());
        $this->assertContains('Badger/Carnivorous.php', $process->getOutput());
    }

    /**
     * @testdox It provides information about the thing under the cursor as JSON
     */
    public function testProvideInformationForOffsetAsJson()
    {
        $process = $this->phpactor('offset:info lib/Badger.php 137 --format=json');
        $this->assertSuccess($process);
        $this->assertContains('{"type":"Animals', $process->getOutput());
    }

    /**
     * @testdox It throws an exception if an invalid format is passed
     */
    public function testProvideInformationForOffsetAsInvalid()
    {
        $process = $this->phpactor('offset:info lib/Badger.php 137 --format=foobar');
        $this->assertFailure($process, 'Invalid format');
    }
}
