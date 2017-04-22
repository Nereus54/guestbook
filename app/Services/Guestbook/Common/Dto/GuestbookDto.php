<?php

namespace App\Services\Guestbook\Common\Dto;

use App\Services\Guestbook\Common\IFilterName;
use App\Services\Guestbook\Common\IFilterPhoneNumber;
use App\Services\Guestbook\Common\IFilterMessage;
use App\Services\Guestbook\Exception\FilterException;
use App\Services\Guestbook\Exception\ValidationException;
use App\Services\Guestbook\Filter\FilterOptions;

/**
 * Description of GuestbookDto
 *
 * @author marcelbobak
 */
class GuestbookDto extends BaseDto
{
    protected static $rules = [
        'name' => 'required|max:40',
        'phoneNumber' => 'required|max:30',
        'message' => 'required|min:1|max:500',
    ];

    protected static $messages = [
        //
    ];

    public function getName()
    {
        return $this->getParameter('name');
    }
    
    public function setName($value)
    {
        $filter = app()->makeWith(IFilterName::class, [
            $value,
            [
                FilterOptions::FILTER_STRIP_TAGS => true,
                FilterOptions::FILTER_URLS => true,
            ]
        ]);
        
        $value = $filter->filter();
        
        return $this->setParameter('name', $value);
    }
    
    public function getPhoneNumber()
    {
        return $this->getParameter('phoneNumber');
    }
    
    public function setPhoneNumber($value)
    {
        $filter = app()->makeWith(IFilterPhoneNumber::class, [
            $value,
            [
                FilterOptions::FILTER_STRIP_TAGS => true,
            ]
        ]);
        
        try {
            $value = $filter->filter();
        } catch(FilterException $e) {
            throw new ValidationException($e->getMessage());
        }
        
        return $this->setParameter('phoneNumber', $value);
    }
    
    public function getMessage()
    {
        return $this->getParameter('message');
    }
    
    public function setMessage($value)
    {
        $filter = app()->makeWith(IFilterMessage::class, [
            $value,
            [
                FilterOptions::FILTER_STRIP_TAGS => true,
                FilterOptions::FILTER_URLS => true,
                FilterOptions::FILTER_ALLOWED_TAGS => [
                        '<b>',
                        '<i>',
                        '<u>',
                        '<br>',
                    ]
            ]
        ]);
        
        $value = $filter->filter();
        
        return $this->setParameter('message', $value);
    }
}
