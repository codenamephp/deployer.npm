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

namespace de\codenamephp\deployer\npm\test\command\run;

use de\codenamephp\deployer\command\iCommand;
use de\codenamephp\deployer\command\runConfiguration\iRunConfiguration;
use de\codenamephp\deployer\npm\command\iNpmCommandFactory;
use de\codenamephp\deployer\npm\command\run\DecorateCommandFactory;
use de\codenamephp\deployer\npm\command\WithBinaryFromDeployer;
use PHPUnit\Framework\TestCase;

final class DecorateCommandFactoryTest extends TestCase {

  private DecorateCommandFactory $sut;

  protected function setUp() : void {
    parent::setUp();

    $commandFactory = $this->createMock(iNpmCommandFactory::class);

    $this->sut = new DecorateCommandFactory($commandFactory);
  }

  public function testBuild() : void {
    $runConfiguration = $this->createMock(iRunConfiguration::class);

    $command = $this->createMock(iCommand::class);

    $this->sut->commandFactory = $this->createMock(iNpmCommandFactory::class);
    $this->sut->commandFactory->expects(self::once())->method('build')->with(
      'run',
      ['some script', 'some', 'args'],
      ['env' => 'vars'],
      true,
      $runConfiguration
    )->willReturn($command);

    self::assertSame($command, $this->sut->build('some script', ['some', 'args'], ['env' => 'vars'], true, $runConfiguration));
  }

  public function testBuild_withMinimalParameters() : void {
    $runConfiguration = $this->createMock(iRunConfiguration::class);

    $command = $this->createMock(iCommand::class);

    $this->sut->commandFactory = $this->createMock(iNpmCommandFactory::class);
    $this->sut->commandFactory->expects(self::once())->method('build')->with(
      'run',
      ['some script'],
      [],
      false,
      null
    )->willReturn($command);

    self::assertSame($command, $this->sut->build('some script'));
  }

  public function test__construct() : void {
    $commandFactory = $this->createMock(iNpmCommandFactory::class);

    $this->sut = new DecorateCommandFactory($commandFactory);

    self::assertSame($commandFactory, $this->sut->commandFactory);
  }

  public function test__construct_withoutParameters() : void {
    $this->sut = new DecorateCommandFactory();

    self::assertInstanceOf(WithBinaryFromDeployer::class, $this->sut->commandFactory);
  }
}
