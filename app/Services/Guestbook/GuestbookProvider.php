<?php

namespace App\Services\Guestbook;

use App\Services\Guestbook\Common\IGuestbookService;
use App\Services\Guestbook\Common\IFilterName;
use App\Services\Guestbook\Common\IFilterPhoneNumber;
use App\Services\Guestbook\Common\IFilterMessage;
use App\Services\Guestbook\Filter\NameFilter;
use App\Services\Guestbook\Filter\PhoneNumberFilter;
use App\Services\Guestbook\Filter\MessageFilter;
use App\Services\Guestbook\GuestbookService;
use Illuminate\Support\ServiceProvider;

/**
 * Description of GuestbookProvider
 *
 * @author marcelbobak
 */
class GuestbookProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IGuestbookService::class, GuestbookService::class);
        
        $this->app->bind(IFilterName::class, function($app, $params)  {
            $value = $params[0];
            $options = (!empty($params[1])) ? $params[1] : [];
            
            return new NameFilter($value, $options);
        });
        
        $this->app->bind(IFilterPhoneNumber::class, function($app, $params)  {
            $value = $params[0];
            $options = (!empty($params[1])) ? $params[1] : [];
            
            return new PhoneNumberFilter($value, $options);
        });
        
        $this->app->bind(IFilterMessage::class, function($app, $params)  {
            $value = $params[0];
            $options = (!empty($params[1])) ? $params[1] : [];
            
            return new MessageFilter($value, $options);
        });
    }
}
