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

use de\codenamephp\deployer\command\iCommand;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\npm\command\iNpmCommandFactory;
use de\codenamephp\deployer\npm\task\AbstractNpmTask;
use PHPUnit\Framework\TestCase;

final class AbstractNpmTaskTest extends TestCase {

  private AbstractNpmTask $sut;

  protected function setUp() : void {
    parent::setUp();

    $commandFactory = $this->createMock(iNpmCommandFactory::class);
    $runner = $this->createMock(iRunner::class);

    $this->sut = $this->getMockForAbstractClass(AbstractNpmTask::class, [$commandFactory, $runner]);
  }

  public function test__construct() : void {
    $commandFactory = $this->createMock(iNpmCommandFactory::class);
    $runner = $this->createMock(iRunner::class);

    $this->sut = $this->getMockForAbstractClass(AbstractNpmTask::class, [$commandFactory, $runner]);

    self::assertSame($commandFactory, $this->sut->commandFactory);
    self::assertSame($runner, $this->sut->runner);
  }

  public function test__invoke() : void {
    $this->sut->expects(self::once())->method('getArguments')->willReturn(['arg1', 'arg2']);
    $this->sut->expects(self::once())->method('getNpmCommand')->willReturn('some command');

    $command = $this->createMock(iCommand::class);

    $this->sut->commandFactory = $this->createMock(iNpmCommandFactory::class);
    $this->sut->commandFactory->expects(self::once())->method('build')->with('some command', ['arg1', 'arg2'])->willReturn($command);

    $this->sut->runner = $this->createMock(iRunner::class);
    $this->sut->runner->expects(self::once())->method('run')->with($command);

    $this->sut->__invoke();
  }
}
