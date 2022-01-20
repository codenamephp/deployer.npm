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

namespace de\codenamephp\deployer\npm\test\task\install;

use de\codenamephp\deployer\base\functions\iGet;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\npm\task\install\Production;
use PHPUnit\Framework\TestCase;

final class ProductionTest extends TestCase {

  private Production $sut;

  protected function setUp() : void {
    parent::setUp();

    $runner = $this->createMock(iRunner::class);
    $deployer = $this->createMock(iGet::class);
    $deployer->method('get')->with('npm:binary', 'npm')->willReturn('npm');

    $this->sut = new Production($runner, $deployer);
  }

  public function testGetArguments() : void {
    $arguments = $this->sut->getArguments();

    self::assertContains('--production', $arguments);
    self::assertContainsOnly('string', $arguments);
    self::assertGreaterThan(2, count($arguments));
  }
}
