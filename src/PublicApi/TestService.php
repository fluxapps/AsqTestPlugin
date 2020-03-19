<?php

namespace srag\Plugins\AssessmentTest\PublicApi;

use srag\CQRS\Aggregate\DomainObjectId;
use srag\CQRS\Aggregate\Guid;
use srag\CQRS\Command\CommandBusBuilder;
use srag\Plugins\AssessmentTest\Command\AddAnswerCommand;
use srag\Plugins\AssessmentTest\Command\StartAssessmentCommand;
use srag\Plugins\AssessmentTest\DomainModel\AssessmentContext;
use srag\Plugins\AssessmentTest\DomainModel\AssessmentResultRepository;
use srag\asq\Application\Service\ASQService;
use srag\asq\Domain\Model\Answer\Answer;


/**
 * Class AssessmentContext
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */

class TestService extends ASQService {
    public function createTestRun(AssessmentContext $context, array $question_ids) : string {
        $uuid = Guid::create();
        
        // CreateQuestion.png
        CommandBusBuilder::getCommandBus()->handle(
            new StartAssessmentCommand(
                $uuid,
                $this->getActiveUser(),
                $context,
                $question_ids));
        
        return $uuid;
    }
    
    public function addAnswer(string $uuid, string $question_id, Answer $answer) {
        CommandBusBuilder::getCommandBus()->handle(
            new AddAnswerCommand(
                $uuid, 
                $this->getActiveUser(), 
                $question_id, 
                $answer));
    }
    
    public function getAnswer(string $uuid, string $question_id) : ?Answer {
        $assessment_result = AssessmentResultRepository::getInstance()->getAggregateRootById(new DomainObjectId($uuid));
        
        return $assessment_result->getAnswer($question_id);
    }
    
    public function getFirstQuestionId(string $uuid) : string {
        $assessment_result = AssessmentResultRepository::getInstance()->getAggregateRootById(new DomainObjectId($uuid));
        
        return $assessment_result->getQuestions()[0];
    }
    
    public function getPreviousQuestionId(string $uuid, string $question_id) : ?string{
        $questions = AssessmentResultRepository::getInstance()->getAggregateRootById(new DomainObjectId($uuid))->getQuestions();
        
        $current_id = array_search($question_id, $questions);
        
        if ($current_id > 0) {
            return $questions[$current_id - 1];
        }
        else {
            return null;
        }
    }
    
    public function getNextQuestionId(string $uuid, string $question_id) : ?string {
        $questions = AssessmentResultRepository::getInstance()->getAggregateRootById(new DomainObjectId($uuid))->getQuestions();
        
        $current_id = array_search($question_id, $questions);
        
        if (array_key_exists($current_id + 1, $questions)) {
            return $questions[$current_id + 1];
        }
        else {
            return null;
        }
    }
    
    public function submitTestRun(string $name) {
        
    }
    
    public function getTestResult(string $name) {
        
    }
}