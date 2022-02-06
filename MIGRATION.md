# Migration

Contains all information needed to migrate between major versions

## 1.x -> 2.x

Added `\de\codenamephp\deployer\base\task\iTaskWithName` and `\de\codenamephp\deployer\base\task\iTaskWithDescription` to
`\de\codenamephp\deployer\npm\task\run\AbstractRunTask` and `\de\codenamephp\deployer\npm\task\AbstractNpmTask` classes so if you extended those you need to
implement those methods.

Also `\de\codenamephp\deployer\npm\task\run\Generic::__construct` now has a mandatory `$taskName` parameter and an optional description parameter:

```
   public function __construct(string                $scriptName,
+                              public string         $taskName,
                               array                 $arguments = [],
+                              public string         $taskDescription = '',
                               iNpmRunCommandFactory $commandFactory = new DecorateCommandFactory(),

```

so you need to update any instantiations.