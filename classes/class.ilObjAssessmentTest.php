<?php

use srag\Plugins\AssessmentTest\ObjectSettings\ObjectSettings;
use srag\Plugins\AssessmentTest\Utils\AssessmentTestTrait;
use srag\DIC\AssessmentTest\DICTrait;

/**
 * Class ilObjAssessmentTest
 *
 * Generated by SrPluginGenerator v1.3.5
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */
class ilObjAssessmentTest extends ilObjectPlugin
{
    use DICTrait;
    use AssessmentTestTrait;
    const PLUGIN_CLASS_NAME = ilAssessmentTestPlugin::class;
    /**
     * @var ObjectSettings
     */
    protected $object_settings;


    /**
     * ilObjAssessmentTest constructor
     *
     * @param int $a_ref_id
     */
    public function __construct(/*int*/ $a_ref_id = 0)
    {
        parent::__construct($a_ref_id);
    }


    /**
     * @inheritDoc
     */
    final public function initType()/*: void*/
    {
        $this->setType(ilAssessmentTestPlugin::PLUGIN_ID);
    }


    /**
     * @inheritDoc
     */
    public function doCreate()/*: void*/
    {
        $this->object_settings = new ObjectSettings();

        $this->object_settings->setObjId($this->id);

        self::assessmentTest()->objectSettings()->storeObjectSettings($this->object_settings);
    }


    /**
     * @inheritDoc
     */
    public function doRead()/*: void*/
    {
        $this->object_settings = self::assessmentTest()->objectSettings()->getObjectSettingsById(intval($this->id));
    }


    /**
     * @inheritDoc
     */
    public function doUpdate()/*: void*/
    {
        self::assessmentTest()->objectSettings()->storeObjectSettings($this->object_settings);
    }


    /**
     * @inheritDoc
     */
    public function doDelete()/*: void*/
    {
        if ($this->object_settings !== null) {
            self::assessmentTest()->objectSettings()->deleteObjectSettings($this->object_settings);
        }
    }


    /**
     * @inheritDoc
     *
     * @param ilObjAssessmentTest $new_obj
     */
    protected function doCloneObject(/*ilObjAssessmentTest*/ $new_obj, /*int*/ $a_target_id, /*?int*/ $a_copy_id = null)/*: void*/
    {
        $new_obj->object_settings = self::assessmentTest()->objectSettings()->cloneObjectSettings($this->object_settings);

        $new_obj->object_settings->setObjId($new_obj->id);

        self::assessmentTest()->objectSettings()->storeObjectSettings($new_obj->object_settings);
    }


    /**
     * @return bool
     */
    public function isOnline() : bool
    {
        return $this->object_settings->isOnline();
    }


    /**
     * @param bool $is_online
     */
    public function setOnline(bool $is_online = true)/*: void*/
    {
        $this->object_settings->setOnline($is_online);
    }
    
    /**
     * @return string
     */
    public function getData() : ?string
    {
        return $this->object_settings->getData();
    }
    
    /**
     * @param string $data
     */
    public function setData(string $data)
    {
        $this->object_settings->setData($data);
    }
}
