<?php

namespace srag\Plugins\AssessmentTest\Command;

use srag\CQRS\Command\AbstractCommand;
use srag\Plugins\AssessmentTest\DomainModel\AssessmentContext;
use srag\CQRS\Aggregate\DomainObjectId;

/**
 * Class StartAssessmentCommand
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */
class StartAssessmentCommand extends AbstractCommand {    
    /**
     * @var AssessmentContext
     */
    public $context;
    
    /**
     * @var string[]
     */
    public $question_ids;
    
    /**
     * @param int $user_id
     * @param AssessmentContext $context
     * @param array $question_ids
     */
    public function __construct(int $user_id, AssessmentContext $context, array $question_ids) {
        $this->context = $context;
        $this->question_ids = $question_ids;
        parent::__construct($user_id);
    }
   
    /**
     * @return AssessmentContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return string[] 
     */
    public function getQuestionIds() : array
    {
        return $this->question_ids;
    }
}