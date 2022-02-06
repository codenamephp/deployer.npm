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

namespace de\codenamephp\deployer\npm\task\run\build;

use de\codenamephp\deployer\npm\task\run\AbstractRunTask;

/**
 * Runs the build:development script. Remember to create the script in your packages.json
 */
final class Development extends AbstractRunTask {

  public const NAME = 'npm:build:development';

  public function getScriptName() : string {
    return 'build:development';
  }

  public function getArguments() : array {
    return [];
  }

  public function getDescription() : string {
    return 'Runs the npm build script that builds the assets for development (without minifying, compression, ...).';
  }

  public function getName() : string {
    return self::NAME;
  }
}