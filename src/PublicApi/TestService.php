<?php

namespace srag\Plugins\AssessmentTest\PublicApi;

use ILIAS\Services\AssessmentQuestion\PublicApi\Factory\ASQService;
use ILIAS\AssessmentQuestion\DomainModel\Answer\Answer;

/**
 * Class AssessmentContext
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */

class TestService extends ASQService {
    public function createTestRun(string $name, int $count) {
        
    }
    
    public function addAnswer(string $name, Answer $anser) {
        
    }
    
    public function submitTestRun(string $name) {
        
    }
    
    public function getTestResult(string $name) {
        
    }
}