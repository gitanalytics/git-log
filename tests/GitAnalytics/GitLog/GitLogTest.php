<?php

namespace Tests\GitAnalytics\GitLog;

class GitLogTest extends \PHPUnit_Framework_TestCase {

    public function testGetLog()
    {
        $arguments = array(
            '--all',
            '--no-merges',
            '--oneline',
            '--stat'
        );

        $log = new \GitAnalytics\GitLog\GitLog($arguments);

        $this->assertNotEmpty($log->getLog(), 'Log is not empty');
    }
}
