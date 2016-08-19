<?php

namespace Unit\Publisher\Entry\Twitter\Entity\Mode\Recommendation;

use Unit\Publisher\Mode\Recommendation\Entity\AbstractRecommendationTest;
use Publisher\Entry\Twitter\Entity\Mode\Recommendation\TwitterUserRecommendation;
use Publisher\Entry\Twitter\TwitterUserEntry;

class TwitterUserRecommendationTest extends AbstractRecommendationTest
{
    
    public function getValidData()
    {
        return array(
            array(
                array(
                    'message' => "abcdefghijklmnopqrstToday #Unit 123",
                    'title' => "Today #Unit 123",
                    'url' => 'http://www.example.com',
                    'date' => null
                )
            ),
            array(
                array(// test special characters
                    'message' => "#@><´'°~!§%&ßöäüÄÜÖµ\"+-*^$/(\\)=}{[]",
                    'title' => "#@><´'°~!§%&ßöäüÄÜÖµ\"+-*^$/(\\)=}{[]",
                    'url' => '',
                    'date' => null
                )
            )
        );
    }
    
    public function getInvalidData()
    {
        return array(
            array(
                array(// invalid since Twitter doesn't support scheduled publishing per API
                    'message' => "Today #Unit 123",
                    'title' => "Testing",
                    'url' => 'http://www.example.com',
                    'date' => 946684800 // invalid
                ),
                1
            )
        );
    }
    
    public function getExeecedMessageData()
    {
        $max = TwitterUserEntry::MAX_LENGTH_OF_MESSAGE;
        $title = '1234567890'; // 10 characters
        $url = 'http://www.example.com'; // 22 characters
        
        /* 
         * Characters arrangement:
         * 10 for title
         * 22 for url
         * 1 for break between title and url
         * 1 for break between message and url
         */
        $messageLength = $max - 10 - 22 - 1 - 1;
        $message = '';
        //add one additional character so we exceed $max
        for ($i = 0; $i < $messageLength+1; $i++) {
            $message .= 'c';
        }
         
        // .'b' => missing breaks
        $dataSet1 = array(
            'message' => $message,
            'title' => $title,
            'url' => $url,
            'date' => null
        );
        $dataSet2 = array(
            'message' => $title.'b'.$message,
            'title' => '',
            'url' => $url,
            'date' => null
        );
        $dataSet3 = array(
            'message' => $message.'b'.$url,
            'title' => $title,
            'url' => '',
            'date' => null
        );
        $dataSet4 = array(
            'message' => $title.'b'.$message.'b'.$url,
            'title' => '',
            'url' => '',
            'date' => null
        );
        
        return array(
            array($dataSet1),
            array($dataSet2),
            array($dataSet3),
            array($dataSet4)
        );
    }
    
    /**
     * @return AbstractRecommendation
     */
    protected function createRecommendation()
    {
        return new TwitterUserRecommendation();
    }
    
}