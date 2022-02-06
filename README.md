# deployer.npm

![Packagist Version](https://img.shields.io/packagist/v/codenamephp/deployer.npm)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/codenamephp/deployer.npm)
![Lines of code](https://img.shields.io/tokei/lines/github/codenamephp/deployer.npm)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/codenamephp/deployer.npm)
![CI](https://github.com/codenamephp/deployer.npm/workflows/CI/badge.svg)
![Packagist Downloads](https://img.shields.io/packagist/dt/codenamephp/deployer.npm)
![GitHub](https://img.shields.io/github/license/codenamephp/deployer.npm)

## What is it?

This package provides deployer tasks for npm and a basic command to run npm command line.

## Installation

Easiest way is via composer. Just run `composer require codenamephp/deployer.npm` in your cli which should install the latest version for you.

## Usage

Just use the tasks in your deployer file or create your own using the command factory or by extending the `\de\codenamephp\deployer\npm\task\AbstractNpmTask`
class.