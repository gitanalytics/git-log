<?php

namespace Tests\GitAnalytics\GitLog;

use GitAnalytics\GitLog\GitLog;

class GitLogTest extends \PHPUnit_Framework_TestCase {

    public function testGetLog()
    {
        $arguments = array(
            '--all',
            '--no-merges',
            '--oneline',
            '--stat'
        );

        $log = new GitLog($arguments);

        $this->assertNotEmpty($log->getLog(), 'Log is not empty');
    }
}
