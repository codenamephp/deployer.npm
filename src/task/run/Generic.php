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

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\npm\command\run\DecorateCommandFactory;
use de\codenamephp\deployer\npm\command\run\iNpmRunCommandFactory;

final class Generic extends AbstractRunTask {

  private string $scriptName;

  /**
   * @var array<int,string>
   */
  private array $arguments;

  /**
   * @param string $scriptName The name of the script to run, e.g. 'build'
   * @param array<int,string> $arguments Additional arguments to pass to the script
   * @param iNpmRunCommandFactory $commandFactory The factory to build the command. Will be passed to parent.
   * @param iRunner $runner The runner that runs the command. Will be passed to parent.
   */
  public function __construct(string                $scriptName,
                              public string         $taskName,
                              array                 $arguments = [],
                              public string         $taskDescription = '',
                              iNpmRunCommandFactory $commandFactory = new DecorateCommandFactory(),
                              iRunner               $runner = new WithDeployerFunctions()) {
    parent::__construct($commandFactory, $runner);
    $this->scriptName = $scriptName;
    $this->arguments = $arguments;
  }

  public function getScriptName() : string {
    return $this->scriptName;
  }

  public function getArguments() : array {
    return $this->arguments;
  }

  public function getDescription() : string {
    return $this->taskDescription;
  }

  public function getName() : string {
    return $this->taskName;
  }
}