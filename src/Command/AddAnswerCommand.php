<?php

namespace srag\Plugins\AssessmentTest\Command;

use srag\CQRS\Command\AbstractCommand;
use ILIAS\AssessmentQuestion\DomainModel\Answer\Answer;

/**
 * Class AddAnswerCommand
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */
class AddAnswerCommand extends AbstractCommand {
    /**
     * @var string
     */
    public $assessment_name;
    
    /**
     * @var string
     */
    public $question_id;
    
    /**
     * @var Answer
     */
    public $answer;
    
    /**
     * @param string $assessment_name
     * @param string $question_id
     * @param Answer $answer
     */
    public function __construct(string $assessment_name, int $user_id, string $question_id, Answer $answer) {
        $this->assessment_name = $assessment_name;
        $this->question_id = $question_id;
        $this->answer = $answer;
        parent::__construct($user_id);
    }
    
    /**
     * @return string
     */
    public function getAssessmentName() : string
    {
        return $this->assessment_name;
    }
    
    public function getUserId() : int 
    {
        return $this->user_id;
    }
    
    /**
     * @return string
     */
    public function getQuestionId() : string
    {
        return $this->question_id;
    }
    
    /**
     * @return Answer
     */
    public function getAnswer() : Answer
    {
        return $this->answer;
    }
}