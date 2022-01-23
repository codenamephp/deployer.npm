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

namespace de\codenamephp\deployer\npm\command\run;

use de\codenamephp\deployer\command\iCommand;
use de\codenamephp\deployer\command\runConfiguration\iRunConfiguration;
use de\codenamephp\deployer\npm\command\iNpmCommandFactory;
use de\codenamephp\deployer\npm\command\WithBinaryFromDeployer;

/**
 * Just decorates a command factory to build the command and makes sure the script name and "run" are passed on correctly using the arguments
 */
final class DecorateCommandFactory implements iNpmRunCommandFactory {

  public function __construct(public iNpmCommandFactory $commandFactory = new WithBinaryFromDeployer()) {}

  public function build(string $scriptName, array $arguments = [], array $envVars = [], bool $sudo = false, iRunConfiguration $runConfiguration = null) : iCommand {
    return $this->commandFactory->build('run', [$scriptName, ...$arguments], $envVars, $sudo, $runConfiguration);
  }
}