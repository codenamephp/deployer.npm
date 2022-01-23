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

namespace de\codenamephp\deployer\npm\test\task\run;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\npm\command\run\iNpmRunCommandFactory;
use de\codenamephp\deployer\npm\task\run\Generic;
use PHPUnit\Framework\TestCase;

final class GenericTest extends TestCase {

  private Generic $sut;

  protected function setUp() : void {
    parent::setUp();

    $commandFactory = $this->getMockForAbstractClass(iNpmRunCommandFactory::class);
    $runner = $this->createMock(iRunner::class);

    $this->sut = new Generic('', [], $commandFactory, $runner);
  }

  public function test__construct() : void {
    $scriptName = 'some script';
    $commandFactory = $this->getMockForAbstractClass(iNpmRunCommandFactory::class);
    $runner = $this->createMock(iRunner::class);
    $arguments = ['some', 'arguments'];

    $this->sut = new Generic($scriptName, $arguments, $commandFactory, $runner);

    $arguments = $this->sut->getArguments();

    self::assertEquals($scriptName, $this->sut->getScriptName());
    self::assertEquals($arguments, $this->sut->getArguments());
    self::assertSame($runner, $this->sut->runner);
    self::assertSame($commandFactory, $this->sut->commandFactory);
  }
}
