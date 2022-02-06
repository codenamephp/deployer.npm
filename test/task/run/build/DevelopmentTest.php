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

namespace de\codenamephp\deployer\npm\test\task\run\build;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\npm\command\run\iNpmRunCommandFactory;
use de\codenamephp\deployer\npm\task\run\build\Development;
use PHPUnit\Framework\TestCase;

final class DevelopmentTest extends TestCase {

  private Development $sut;

  protected function setUp() : void {
    parent::setUp();

    $commandFactory = $this->createMock(iNpmRunCommandFactory::class);
    $runner = $this->createMock(iRunner::class);

    $this->sut = new Development($commandFactory, $runner);
  }

  public function testGetScriptName() : void {
    self::assertEquals('build:development', $this->sut->getScriptName());
  }

  public function testGetName() : void {
    self::assertEquals(Development::NAME, $this->sut->getName());
  }

  public function testGetDescription() : void {
    self::assertEquals('Runs the npm build script that builds the assets for development (without minifying, compression, ...).', $this->sut->getDescription());
  }
}
