<?php

namespace Publisher\Entry\Twitter;

use Publisher\Entry\AbstractEntry;
use Publisher\Mode\Recommendation\RecommendationInterface;
use Publisher\Helper\Validator;

/*
 * @link https://dev.twitter.com/rest/reference/post/statuses/update
 */
class TwitterUserEntry extends AbstractEntry implements RecommendationInterface
{
    
    const MAX_LENGTH_OF_MESSAGE = 140;
    
    protected function defineRequestProperties()
    {
        $this->request->setPath('statuses/update.json');
        $this->request->setMethod('POST');
    }
    
    protected function validateBody(array $body)
    {
        Validator::checkRequiredParametersAreSet($body, array('status'));
        Validator::validateMessageLength(
                $body['status'],
                self::MAX_LENGTH_OF_MESSAGE
        );
    }
    
    // Implementation of MonitoredInterface
    
    public static function succeeded($response)
    {
        $object = json_decode($response);
        return (isset($object->id_str));
    }
    
    // Implementation of RecommendationInterface
    
    public function setRecommendationParameters(
        string $message,
        string $url = '',
        string $title = '',
        $date = null
    ) {
        $status = empty($title) ? $message : $title."\n".$message;
        $status .= empty($url) ?  '' : "\n".$url;
        
        $this->setBody(array(
            'status' => $status
        ));
    }

}
