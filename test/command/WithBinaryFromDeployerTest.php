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

namespace de\codenamephp\deployer\npm\test\command;

use de\codenamephp\deployer\base\functions\All;
use de\codenamephp\deployer\base\functions\iGet;
use de\codenamephp\deployer\command\Command;
use de\codenamephp\deployer\command\runConfiguration\iRunConfiguration;
use de\codenamephp\deployer\command\runConfiguration\SimpleContainer;
use de\codenamephp\deployer\npm\command\WithBinaryFromDeployer;
use PHPUnit\Framework\TestCase;

final class WithBinaryFromDeployerTest extends TestCase {

  private WithBinaryFromDeployer $sut;

  protected function setUp() : void {
    parent::setUp();

    $deployer = $this->createMock(iGet::class);

    $this->sut = new WithBinaryFromDeployer($deployer);
  }

  public function test__construct() : void {
    $deployer = $this->createMock(iGet::class);

    $this->sut = new WithBinaryFromDeployer($deployer);

    self::assertSame($deployer, $this->sut->deployer);
  }

  public function test__construct_withoutParameters() : void {
    $this->sut = new WithBinaryFromDeployer();

    self::assertInstanceOf(All::class, $this->sut->deployer);
  }

  public function testBuild() : void {
    $this->sut->deployer = $this->createMock(iGet::class);
    $this->sut->deployer->expects(self::once())->method('get')->with('npm:binary', 'npm')->willReturn(123);

    $runConfiguration = $this->createMock(iRunConfiguration::class);

    $command = $this->sut->build('some command', ['arg1', 'arg2'], ['some' => 'env'], true, $runConfiguration);

    self::assertInstanceOf(Command::class, $command);
    self::assertEquals('123', $command->binary);
    self::assertEquals(['--prefix {{release_path}}', '--fund=false', 'some command', 'arg1', 'arg2'], $command->arguments);
    self::assertEquals(['some' => 'env'], $command->envVars);
    self::assertTrue($command->sudo);
    self::assertSame($runConfiguration, $command->runConfiguration);
  }

  public function testBuild_withDefaults() : void {
    $this->sut->deployer = $this->createMock(iGet::class);
    $this->sut->deployer->expects(self::once())->method('get')->with('npm:binary', 'npm')->willReturn(null);

    $command = $this->sut->build('');

    self::assertInstanceOf(Command::class, $command);
    self::assertEquals('', $command->binary);
    self::assertEquals(['--prefix {{release_path}}', '--fund=false', ''], $command->arguments);
    self::assertEquals([], $command->envVars);
    self::assertFalse($command->sudo);
    self::assertInstanceOf(SimpleContainer::class, $command->runConfiguration);
  }
}
