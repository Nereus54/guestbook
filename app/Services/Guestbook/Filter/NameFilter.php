<?php

namespace App\Services\Guestbook\Filter;

use App\Services\Guestbook\Common\IFilterName;

/**
 * Description of NameFilter
 *
 * @author marcelbobak
 */
class NameFilter extends BaseFilter implements IFilterName
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
