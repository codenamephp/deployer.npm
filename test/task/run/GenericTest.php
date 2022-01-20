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

use de\codenamephp\deployer\base\functions\iGet;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\npm\task\run\Generic;
use PHPUnit\Framework\TestCase;

final class GenericTest extends TestCase {

  private Generic $sut;

  protected function setUp() : void {
    parent::setUp();

    $runner = $this->createMock(iRunner::class);
    $deployer = $this->createMock(iGet::class);
    $deployer->method('get')->with('npm:binary', 'npm')->willReturn('npm');

    $this->sut = new Generic('', [], $runner, $deployer);
  }

  public function test__construct() : void {
    $scriptName = 'some script';
    $runner = $this->createMock(iRunner::class);
    $deployer = $this->createMock(iGet::class);
    $deployer->method('get')->with('npm:binary', 'npm')->willReturn('npm');

    $this->sut = new Generic($scriptName, ['some', 'arguments'], $runner, $deployer);

    $arguments = $this->sut->getArguments();

    self::assertEquals($scriptName, $this->sut->getScriptName());
    self::assertSame($runner, $this->sut->runner);
    self::assertContains('some', $arguments);
    self::assertContains('arguments', $arguments);
    self::assertGreaterThan(4, count($arguments));
  }
}
