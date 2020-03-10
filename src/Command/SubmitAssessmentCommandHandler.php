<?php

namespace srag\Plugins\AssessmentTest\Command;

use srag\CQRS\Command\CommandContract;
use srag\CQRS\Command\CommandHandlerContract;

/**
 * Class SubmitAssessmentCommandHandler
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */
class SubmitAssessmentCommandHandler implements CommandHandlerContract {
    /**
     * @param $command SubmitAssessmentCommand
     */
    public function handle(CommandContract $command)
    {
        
    }
}