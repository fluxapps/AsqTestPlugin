<?php

namespace srag\Plugins\AssessmentTest\PublicApi;

use ILIAS\Services\AssessmentQuestion\PublicApi\Factory\ASQService;
use ILIAS\AssessmentQuestion\DomainModel\Answer\Answer;
use srag\CQRS\Command\CommandBusBuilder;
use srag\Plugins\AssessmentTest\Command\StartAssessmentCommand;
use srag\Plugins\AssessmentTest\DomainModel\AssessmentResultRepository;
use srag\CQRS\Aggregate\DomainObjectId;
use srag\Plugins\AssessmentTest\DomainModel\AssessmentContext;
use srag\Plugins\AssessmentTest\Command\AddAnswerCommand;


/**
 * Class AssessmentContext
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */

class TestService extends ASQService {
    public function createTestRun(AssessmentContext $context, array $question_ids) {
        // CreateQuestion.png
        CommandBusBuilder::getCommandBus()->handle(
            new StartAssessmentCommand(
                $this->getActiveUser(),
                $context,
                $question_ids));
    }
    
    public function addAnswer(string $name, string $question_id, Answer $answer) {
        CommandBusBuilder::getCommandBus()->handle(
            new AddAnswerCommand(
                $name, 
                $this->getActiveUser(), 
                $question_id, 
                $answer));
    }
        
    public function getAnswer(string $name, string $question_id) : Answer {
        $assessment_result = AssessmentResultRepository::getInstance()->getResultByName($name, $this->getActiveUser());
        
        return $assessment_result->getAnswer($question_id);
    }
    
    public function submitTestRun(string $name) {
        
    }
    
    public function getTestResult(string $name) {
        
    }
}