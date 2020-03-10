<?php

namespace srag\Plugins\AssessmentTest\Persistence;

use srag\CQRS\Aggregate\DomainObjectId;
use srag\CQRS\Event\AbstractDomainEvent;
use srag\CQRS\Event\DomainEvent;
use srag\CQRS\Event\DomainEvents;
use srag\CQRS\Event\EventID;
use srag\CQRS\Event\EventStore;

/**
 * Class AssessmentResultEventStore
 *
 * @package srag\Plugins\AssessmentTest
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 2 <al@studer-raimann.ch>
 */
class AssessmentResultEventStore extends EventStore {
    /**
     * @param DomainEvents $events
     */
    public function commit(DomainEvents $events)
    {		/** @var DomainEvent $event */
        foreach ($events->getEvents() as $event) {
            $stored_event = new AssessmentResultEventStoreAr();
            
            $stored_event->setEventData(
                new EventID(),
                $event->getAggregateId(),
                $event->getEventName(),
                $event->getOccurredOn(),
                $event->getInitiatingUserId(),
                $event->getEventBody(),
                get_class($event));
            
            $stored_event->create();
        }
    }
    
    /**
     * @param DomainObjectId $id
     *
     * @return DomainEvents
     */
    public function getAggregateHistoryFor(DomainObjectId $id): DomainEvents {
        global $DIC;
        
        $sql = "SELECT * FROM " . AssessmentResultEventStore::STORAGE_NAME . " where aggregate_id = " . $DIC->database()->quote($id->getId(),'string');
        $res = $DIC->database()->query($sql);
        
        $event_stream = new DomainEvents();
        while ($row = $DIC->database()->fetchAssoc($res)) {
            /**@var AbstractDomainEvent $event */
            $event_name = "srag\Plugins\AssessmentTest\DomainModel\\Event\\".utf8_encode(trim($row['event_name']));
            $event = new $event_name(new DomainObjectId($row['aggregate_id']), $row['initiating_user_id'], $row['item_id']);
            $event->restoreEventBody($row['event_body']);
            $event_stream->addEvent($event);
        }
        
        return $event_stream;
    }

    public function getEventStream(?EventID $from_position): DomainEvents
    {}
}