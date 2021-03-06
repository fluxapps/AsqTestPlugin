<?php

namespace srag\Plugins\AssessmentTest\ObjectSettings;

use srag\Plugins\AssessmentTest\Utils\AssessmentTestTrait;
use ilAssessmentTestPlugin;
use ilObjAssessmentTest;
use ilObjAssessmentTestGUI;
use srag\DIC\AssessmentTest\DICTrait;

/**
 * Class Factory
 *
 * Generated by SrPluginGenerator v1.3.5
 *
 * @package srag\Plugins\AssessmentTest\ObjectSettings
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */
final class Factory
{
    use DICTrait;
    use AssessmentTestTrait;
    const PLUGIN_CLASS_NAME = ilAssessmentTestPlugin::class;
    /**
     * @var self
     */
    protected static $instance = null;


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * Factory constructor
     */
    private function __construct()
    {
    }


    /**
     * @return ObjectSettings
     */
    public function newInstance() : ObjectSettings
    {
        $object_settings = new ObjectSettings();

        return $object_settings;
    }


    /**
     * @param ilObjAssessmentTestGUI $parent
     * @param ilObjAssessmentTest    $object
     *
     * @return ObjectSettingsFormGUI
     */
    public function newFormInstance(ilObjAssessmentTestGUI $parent, ilObjAssessmentTest $object) : ObjectSettingsFormGUI
    {
        $form = new ObjectSettingsFormGUI($parent, $object);

        return $form;
    }
}
