<?php declare(strict_types=1);
/*
 *   Copyright 2022 Bastian Schwarz <bastian@codename-php.de>.
 *
 *   Licensed under the Apache License, Version 2.0 (the "License");
 *   you may not use this file except in compliance with the License.
 *   You may obtain a copy of the License at
 *
 *         http://www.apache.org/licenses/LICENSE-2.0
 *
 *   Unless required by applicable law or agreed to in writing, software
 *   distributed under the License is distributed on an "AS IS" BASIS,
 *   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *   See the License for the specific language governing permissions and
 *   limitations under the License.
 */

namespace de\codenamephp\deployer\npm\test\task;

use de\codenamephp\deployer\base\functions\iGet;
use de\codenamephp\deployer\command\Command;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\npm\task\AbstractNpmTask;
use PHPUnit\Framework\TestCase;

final class AbstractNpmTaskTest extends TestCase {

  private AbstractNpmTask $sut;

  protected function setUp() : void {
    parent::setUp();

    $runner = $this->createMock(iRunner::class);
    $deployer = $this->createMock(iGet::class);
    $deployer->method('get')->with('npm:binary', 'npm')->willReturn('npm');

    $this->sut = $this->getMockForAbstractClass(AbstractNpmTask::class, [$runner, $deployer]);
  }

  public function test__construct() : void {
    $runner = $this->createMock(iRunner::class);
    $deployer = $this->createMock(iGet::class);
    $deployer->method('get')->with('npm:binary', 'npm')->willReturn('npm');

    $this->sut = $this->getMockForAbstractClass(AbstractNpmTask::class, [$runner, $deployer]);

    self::assertSame($runner, $this->sut->runner);
    self::assertEquals(new Command('npm', ['', '--prefix {{release_path}}', '--fund=false']), $this->sut->command);
  }

  public function test__construct_withNonStringFromGet() : void {
    $runner = $this->createMock(iRunner::class);
    $deployer = $this->createMock(iGet::class);
    $deployer->method('get')->with('npm:binary', 'npm')->willReturn(null);

    $this->sut = $this->getMockForAbstractClass(AbstractNpmTask::class, [$runner, $deployer]);

    self::assertSame($runner, $this->sut->runner);
    self::assertEquals(new Command('', ['', '--prefix {{release_path}}', '--fund=false']), $this->sut->command);
  }

  public function test__invoke() : void {
    $this->sut->runner = $this->createMock(iRunner::class);
    $this->sut->runner->expects(self::once())->method('run')->with($this->sut->command);

    $this->sut->__invoke();
  }

  public function testGetArguments() : void {
    self::assertEquals(['--prefix {{release_path}}', '--fund=false'], $this->sut->getArguments());
  }
}
