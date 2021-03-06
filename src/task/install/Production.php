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

namespace de\codenamephp\deployer\npm\task\install;

/**
 * Runs an install and sets --production so devDependencies will be skipped for production
 */
final class Production extends AbstractInstallTask {

  public const NAME = 'npm:install';

  public function getArguments() : array {
    return ['--production'];
  }

  public function getDescription() : string {
    return 'Runs npm install with the production flag to dev dependencies are not installed.';
  }

  public function getName() : string {
    return self::NAME;
  }
}