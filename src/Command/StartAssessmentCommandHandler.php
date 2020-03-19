<?php

namespace srag\Plugins\AssessmentTest\Command;

use srag\CQRS\Command\CommandContract;
use srag\CQRS\Command\CommandHandlerContract;
use srag\Plugins\AssessmentTest\DomainModel\AssessmentResult;
use srag\Plugins\AssessmentTest\DomainModel\AssessmentResultRepository;
use srag\CQRS\Aggregate\DomainObjectId;

/**
 * Class StartAssessmentCommandHandler
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */
class StartAssessmentCommandHandler implements CommandHandlerContract {
    /**
     * @param $command StartAssessmentCommand
     */
    public function handle(CommandContract $command)
    {
        $assessment_result = AssessmentResult::create(
            new DomainObjectId($command->getUuid()),
            $command->getContext(),
            $command->getQuestionIds(),
            $command->getIssuingUserId());
        
        AssessmentResultRepository::getInstance()->save($assessment_result);
    }
}