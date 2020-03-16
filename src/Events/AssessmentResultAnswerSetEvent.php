<?php

namespace srag\Plugins\AssessmentTest\Events;

use ILIAS\AssessmentQuestion\DomainModel\Answer\Answer;
use srag\CQRS\Event\AbstractDomainEvent;
use srag\CQRS\Aggregate\DomainObjectId;
use ilDateTime;
use srag\CQRS\Aggregate\AbstractValueObject;

/**
 * Class AssessmentResultAnswerSetEvent
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */
class AssessmentResultAnswerSetEvent extends AbstractDomainEvent {
    const KEY_QUESTION_ID = 'quid';
    const KEY_ANSWER = 'answer';
    
    /**
     * @var string
     */
    protected $question_id;
    
    /**
     * @var Answer
     */
    protected $answer;
    
    public function __construct(DomainObjectId $aggregate_id, int $initiating_user_id, string $question_id, Answer $answer) {
        $this->question_id = $question_id;
        $this->answer = $answer;
        parent::__construct($aggregate_id, new ilDateTime(), $initiating_user_id);
    }
    
    /**
     * @return string
     */
    public function getQuestionId()
    {
        return $this->question_id;
    }

    /**
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    public function getEventBody(): string
    {
        $body = [];
        $body[self::KEY_QUESTION_ID] = $this->question_id;
        $body[self::KEY_ANSWER] = $this->answer;
        return json_encode($body);
    }

    protected function restoreEventBody(string $event_body): void
    {
        $body = json_decode($event_body, true);
        $this->question_id = $body[self::KEY_QUESTION_ID];
        $this->answer = AbstractValueObject::deserialize($body[self::KEY_ANSWER]);
    }
}