<?php

namespace App\Services\Guestbook\Filter;

use App\Services\Guestbook\Filter\FilterOptions;

/**
 * Description of BaseFilter
 *
 * @author marcelbobak
 */
abstract class BaseFilter
{
    protected $value;
    
    protected $options;
    
    protected $defaultOptions = [
        FilterOptions::FILTER_STRIP_TAGS => false,
        FilterOptions::FILTER_URLS => false,
        FilterOptions::FILTER_ALLOWED_TAGS => [],
    ];
    
    public function __construct($value, array $options = [])
    {
        $this->value = $value;
        
        if ( !empty($options) ) {
            $this->setOptions($options);
        }
    }
    
    protected function setOptions(array $options)
    {
        $this->options = $this->defaultOptions;
        
        if ( count($options) >0 ) {
            $this->options = array_merge($this->defaultOptions, $options);
        }
        
        if ( !empty($this->options[FilterOptions::FILTER_ALLOWED_TAGS]) ) {
            $this->options[FilterOptions::FILTER_ALLOWED_TAGS] = join('', $this->options[FilterOptions::FILTER_ALLOWED_TAGS]);
        }
    }

    protected function cleanInput()
    {
        if ( !empty($this->options) ) {
            if ( $this->options[FilterOptions::FILTER_URLS] === true ) {
                $this->value = $this->stripUrls($this->value);
            }
            
            if ( count($this->options[FilterOptions::FILTER_ALLOWED_TAGS]) > 0 ) {
                $this->value = strip_tags($this->value, $this->options[FilterOptions::FILTER_ALLOWED_TAGS]);
                $this->value = htmlspecialchars($this->value);
            }
            
            if ( $this->options[FilterOptions::FILTER_STRIP_TAGS] === true )
                $this->value = strip_tags($this->value);
        }
        
        $this->value = trim($this->value);
        $this->value = $this->sanitazeWhiteSpaces($this->value);
    }
    
    protected function stripUrls($value)
    {
        $value = preg_replace("/(https:\/\/|http:\/\/)?(www\.)(.*?)(\.)([a-zA-Z]){2,3}((\/)?[[:alnum:][:punct:]]*)/", "", $value);
        $value = preg_replace("/(https:\/\/|http:\/\/)(.*?)(\.)([a-zA-Z]){2,3}((\/)?[[:alnum:][:punct:]]*)/", "", $value);
        
        return $value;
    }
    
    protected function sanitazeWhiteSpaces($value)
    {
        return preg_replace('/\s+/', ' ', $value);
    }
}
