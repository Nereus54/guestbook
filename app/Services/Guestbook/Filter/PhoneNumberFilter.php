<?php

namespace App\Services\Guestbook\Filter;

use App\Services\Guestbook\Common\IFilterPhoneNumber;
use App\Services\Guestbook\Exception\FilterException;

/**
 * Description of PhoneNumberFilter
 *
 * @author marcelbobak
 */
class PhoneNumberFilter extends BaseFilter implements IFilterPhoneNumber
{
    const EXCEPTION_NON_VALID_SLOVAK_NUMBER = 'Phone number is not a valid Slovak phone number.';
    
    public function __construct($value, array $options = [])
    {
        parent::__construct($value, $options);
    }
    
    public function filter()
    {
        $this->cleanInput();
        
        if ( $this->isValidSlovakPhoneNumber($this->value) === false ) {
            throw new FilterException(self::EXCEPTION_NON_VALID_SLOVAK_NUMBER);
        }
        
        return $this->value;
    }
    
    /**
     * Checks whether given string is a valid Slovakia phone number
     * 
     * @param string $value phone number
     * @return boolean TRUE if  given string is valid Slovakia phone number otherwise FALSE
     * @see https://en.wikipedia.org/wiki/Telephone_numbers_in_Slovakia
     */
    private function isValidSlovakPhoneNumber($value)
    {
        $isValid = false;
        
        $value = str_replace(' ', '', $value);
        
        // is valid mobile phone number ?
        if ( preg_match('/^(\+421|00421)?(\(0\)|0)?(9[0-5]{1}[0-9]{1})([0-9]){6}$/', $value, $mobileNumberMatches) ) {
            $isValid = true;
        } 
        // is valid landline phone number ?
        elseif ( preg_match('/^(\+421|00421)?(\(0\)|0)?(2|31|32|33|34|35|36|37|38|41|42|43|44|45|46|47|48|51|52|53|54|55|56|57|58)(\/)?([0-9]){7}$/', $value, $landlineNubmerMatches) ) {
            $isValid = true;
        }
        
        return $isValid;
    }
}
