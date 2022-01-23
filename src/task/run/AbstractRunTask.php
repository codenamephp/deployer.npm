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

namespace de\codenamephp\deployer\npm\task\run;

use de\codenamephp\deployer\base\task\iTask;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\npm\command\run\DecorateCommandFactory;
use de\codenamephp\deployer\npm\command\run\iNpmRunCommandFactory;

abstract class AbstractRunTask implements iTask {

  public function __construct(public iNpmRunCommandFactory $commandFactory = new DecorateCommandFactory(), public iRunner $runner = new WithDeployerFunctions()) {}

  abstract public function getScriptName() : string;

  /**
   * Gets the arguments to pass to the command. Override this and add you commands and options as needed.
   *
   * The array has to be numerical so it can be expanded in the constructor
   *
   * @return array<int,string>
   */
  abstract public function getArguments() : array;

  public function __invoke() : void {
    $this->runner->run($this->commandFactory->build($this->getScriptName(), $this->getArguments()));
  }
}