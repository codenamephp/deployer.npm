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

/**
 * Interface to create a command for running npm scripts. Implementations must make sure to set the command correctly together with the script name in the
 * arguments
 */
interface iNpmRunCommandFactory {

  /**
   * Implementations MUST make sure the command gets the correct binary and command to run the script and pass on all parameters correctly
   *
   * @param string $scriptName The name of the script to run
   * @param array<int, string> $arguments Array of arguments to pass to the command with numerical indexes so the arguments can be expanded, e.g. ['--production', '--fund=false']
   * @param array<string, string> $envVars Array of env vars to pass to the command with the name as key.
   * @param bool $sudo Flag if the command should be executed as root
   * @param iRunConfiguration|null $runConfiguration The run configuration for the command. Defaults to an empty configuration
   * @return iCommand The command to run
   */
  public function build(string $scriptName, array $arguments = [], array $envVars = [], bool $sudo = false, iRunConfiguration $runConfiguration = null) : iCommand;
}