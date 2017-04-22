<?php

namespace App\Services\Guestbook\Filter;

use App\Services\Guestbook\Common\IFilterMessage;

/**
 * Description of MessageFilter
 *
 * @author marcelbobak
 */
class MessageFilter extends BaseFilter implements IFilterMessage
{
    public function __construct($value, array $options = [])
    {
        parent::__construct($value, $options);
    }
    
    public function filter()
    {
        $this->cleanInput();
        
        return $this->value;
    }
}
