<?php

namespace Publisher\Entry\Twitter\Entity\Mode\Recommendation;

use Publisher\Mode\Recommendation\Entity\AbstractRecommendation;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Publisher\Entry\Twitter\TwitterUserEntry;

class TwitterUserRecommendation extends AbstractRecommendation
{
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        parent::loadValidatorMetadata($metadata);
        parent::addDefaultConstraints($metadata);
        parent::addScheduleNotSupportedConstraint($metadata);
    }
    
    /**
     * @{inheritdoc}
     */
    protected function getMaxLengthOfMessage()
    {
        return TwitterUserEntry::MAX_LENGTH_OF_MESSAGE;
    }
    
    /**
     * @{inheritdoc}
     */
    protected function createCompleteMessage()
    {
        $status = empty($this->title) ? $this->message : $this->title."\n".$this->message;
        $status .= empty($this->url) ?  '' : "\n".$this->url;
        
        return $status;
    }
    
}