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

use de\codenamephp\deployer\base\functions\All;
use de\codenamephp\deployer\base\functions\iGet;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;

final class Generic extends AbstractRunTask {

  private string $scriptName;

  /**
   * @var array<int,string>
   */
  private array $arguments;

  /**
   * @param string $scriptName The name of the script to run, e.g. 'build'
   * @param array<int,string> $arguments Additional arguments to pass to the script that will be appended to the defaults
   * @param iRunner $runner The runner that runs the command
   * @param iGet $deployer Deployer function to access the config. Will not be set in the instance
   */
  public function __construct(string $scriptName, array $arguments = [], iRunner $runner = new WithDeployerFunctions(), iGet $deployer = new All()) {
    $this->scriptName = $scriptName;
    $this->arguments = $arguments;
    parent::__construct($runner, $deployer);
  }

  public function getScriptName() : string {
    return $this->scriptName;
  }

  public function getArguments() : array {
    return [...parent::getArguments(), ...$this->arguments];
  }
}