<?php
/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\Samples\Logging\Tests;

use Google\Cloud\Samples\Logging\DeleteLoggerCommand;
use Google\Cloud\Samples\Logging\WriteCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Functional tests for DeleteLoggerCommand.
 */
class DeleteLoggerCommandTest extends \PHPUnit_Framework_TestCase
{
    /* @var $hasCredentials boolean */
    protected static $hasCredentials;
    /* @var $projectId mixed|string */
    private $projectId;

    public static function setUpBeforeClass()
    {
        $path = getenv('GOOGLE_APPLICATION_CREDENTIALS');
        self::$hasCredentials = $path && file_exists($path) &&
            filesize($path) > 0;
    }

    public function setUp()
    {
        if (!self::$hasCredentials) {
            $this->markTestSkipped('No application credentials were found.');
        }

        if (!$this->projectId = getenv('GOOGLE_PROJECT_ID')) {
            $this->markTestSkipped('No project ID');
        }
        $application = new Application();
        $application->add(new WriteCommand());
        $commandTester = new CommandTester($application->get('write'));
        $commandTester->execute(
            [
                '--project' => $this->projectId,
                '--logger' => 'my_test_logger',
                'message' => 'Test Message'
            ],
            ['interactive' => false]
        );
        sleep(2);
    }

    public function testDeleteLogger()
    {
        $application = new Application();
        $application->add(new DeleteLoggerCommand());
        $commandTester = new CommandTester($application->get('delete-logger'));
        $commandTester->execute(
            ['--project' => $this->projectId, '--logger' => 'my_test_logger'],
            ['interactive' => false]
        );
        $this->expectOutputRegex(
            sprintf("/Deleted a logger '%s'./", 'my_test_logger')
        );
    }
}
