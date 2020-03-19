<?php

namespace srag\Plugins\AssessmentTest\Command;

use srag\CQRS\Command\CommandContract;
use srag\CQRS\Command\CommandHandlerContract;
use srag\Plugins\AssessmentTest\DomainModel\AssessmentResult;
use srag\Plugins\AssessmentTest\DomainModel\AssessmentResultRepository;
use srag\CQRS\Aggregate\DomainObjectId;

/**
 * Class AddAnswerCommandHandler
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */
class AddAnswerCommandHandler implements CommandHandlerContract {
    /**
     * @param $command AddAnswerCommand
     */
    public function handle(CommandContract $command)
    {
        /** @var $assessment_result AssessmentResult */
        $assessment_result = AssessmentResultRepository::getInstance()->getAggregateRootById(new DomainObjectId($command->getResultUuid()));
        
        $assessment_result->setAnswer($command->getQuestionId(), $command->getAnswer(), $command->getIssuingUserId());
        
        AssessmentResultRepository::getInstance()->save($assessment_result);
    }
}