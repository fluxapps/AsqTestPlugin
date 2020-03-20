<?php

namespace srag\CustomInputGUIs\AssessmentTest\CheckboxInputGUI;

use ilCheckboxInputGUI;
use ilTableFilterItem;
use srag\DIC\AssessmentTest\DICTrait;

/**
 * Class CheckboxInputGUI
 *
 * @package srag\CustomInputGUIs\AssessmentTest\CheckboxInputGUI
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class CheckboxInputGUI extends ilCheckboxInputGUI implements ilTableFilterItem
{

    use DICTrait;
}
