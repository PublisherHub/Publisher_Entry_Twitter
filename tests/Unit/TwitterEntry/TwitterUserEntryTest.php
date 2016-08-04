<?php

namespace Unit\TwitterEntry;

use Unit\Publisher\Entry\EntryTest;

class TwitterUserEntryTest extends EntryTest
{
    
    protected function getEntryClass()
    {
        return 'Publisher\\Entry\\Twitter\\TwitterUserEntry';
    }
    
    public function getValidBody()
    {
        return array(
            array(array('status' => 'foo'))
        );
    }
    
    public function getInvalidBody()
    {
        return array(
            array(array()),
            array(array('notRequired' => 'foo'))
        );
    }
    
    public function getBodyWithExceededMessage()
    {
        return array(
            array(array('status' => $this->getExceededMessage()))
        );
    }
}