<?php

namespace srag\Plugins\AssessmentTest\DomainModel;

use ILIAS\AssessmentQuestion\DomainModel\Answer\Answer;
use srag\CQRS\Aggregate\AbstractEventSourcedAggregateRoot;
use srag\CQRS\Aggregate\DomainObjectId;
use srag\CQRS\Event\Standard\AggregateCreatedEvent;
use ilDateTime;
use srag\Plugins\AssessmentTest\Events\AssessmentResultInitiatedEvent;
use srag\Plugins\AssessmentTest\Exception\AssessmentException;
use srag\Plugins\AssessmentTest\Events\AssessmentResultAnswerSetEvent;

/**
 * Class AssessmentResult
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */
class AssessmentResult extends AbstractEventSourcedAggregateRoot{
    /**
     * @var AssessmentContext
     */
    protected $context;
    
    /**
     * @var Answer[]
     */
    protected $questions;
    
    public static function create(AssessmentContext $context, array $question_ids, int $user_id) {
        $id = new DomainObjectId();
        $result = new AssessmentResult();
        $result->ExecuteEvent(
            new AggregateCreatedEvent(
                $id, 
                new ilDateTime(), 
                $user_id));
        $result->ExecuteEvent(
            new AssessmentResultInitiatedEvent(
                $id, 
                $user_id, 
                $context, 
                $question_ids));
        AssessmentResultRepository::getInstance()->save($result);
    }
       
    protected function applyAssessmentResultInitiatedEvent(AssessmentResultInitiatedEvent $event) {
        $this->context = $event->getContext();
        $this->questions = [];
        
        foreach ($event->getQuestions() as $question_id) {
            $this->questions[$question_id] = null;
        }
    }
    
    protected function applyAssessmentResultAnswerSetEvent(AssessmentResultAnswerSetEvent $event) {
        $this->questions[$event->getQuestionId()] = $event->getAnswer();
    }
    
    public function getContext() : AssessmentContext {
        return $this->context;
    }
    
    public function getAnswer(string $question_id) : Answer {
        if (array_key_exists($question_id, $this->questions)) {
            return $this->questions[$question_id];
        }
        else 
        {
            throw new AssessmentException('Question is not part of current Assesment');
        }
    }
    
    public function setAnswer(string $question_id, Answer $answer, int $initiating_user_id) {
        if (array_key_exists($question_id, $this->questions)) {
            $this->ExecuteEvent(new AssessmentResultAnswerSetEvent(
                $this->getAggregateId(), $initiating_user_id, $question_id, $answer));
        }
        else
        {
            throw new AssessmentException('Question is not part of current Assesment');
        }
    }
}