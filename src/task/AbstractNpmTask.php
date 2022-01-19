<?php declare(strict_types=1);

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
    $this->command = new Command((string) $deployer->get('npm:binary', 'npm'), [$this->getNpmCommand(), '--prefix {{release_path}}']);
  }

  /**
   * Gets the command for npm, e.g. install or run-script
   *
   * This will be added to the command before it's run
   *
   * @return string
   */
  abstract public function getNpmCommand() : string;

  public function __invoke() : void {
    $this->runner->run($this->command);
  }
}