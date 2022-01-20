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

namespace de\codenamephp\deployer\npm\task;

use de\codenamephp\deployer\base\functions\All;
use de\codenamephp\deployer\base\functions\iGet;
use de\codenamephp\deployer\base\task\iTask;
use de\codenamephp\deployer\command\Command;
use de\codenamephp\deployer\command\iCommand;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;

/**
 * Base class for npm command setting the binary to npm
 */
abstract class AbstractNpmTask implements iTask {

  public iCommand $command;

  public function __construct(
    public iRunner $runner = new WithDeployerFunctions(),
    iGet           $deployer = new All()
  ) {
    $this->command = new Command((string) $deployer->get('npm:binary', 'npm'), [$this->getNpmCommand(), ...$this->getArguments()]);
  }

  /**
   * Gets the command for npm, e.g. install or run-script
   *
   * This will be added to the command before it's run
   *
   * @return string
   */
  abstract public function getNpmCommand() : string;

  /**
   * Gets the arguments to pass to the command. Override this and add you commands and options as needed.
   *
   * The array has to be numerical so it can be expanded in the constructor
   *
   * @return array<int,string>
   */
  public function getArguments() : array {
    return ['--prefix {{release_path}}', '--fund=false'];
  }

  public function __invoke() : void {
    $this->runner->run($this->command);
  }
}