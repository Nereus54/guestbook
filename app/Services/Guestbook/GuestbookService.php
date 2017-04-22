<?php

namespace App\Services\Guestbook;

use App\Services\Guestbook\Common\IGuestbookService;
use App\Services\Guestbook\Common\Dto\GuestbookDto;
use App\Services\Guestbook\Model\Guestbook;

/**
 * Description of GuestbookService
 *
 * @author marcelbobak
 */
class GuestbookService implements IGuestbookService
{
    public function createEntry(GuestbookDto $dto)
    {
        $dto->validate();
        
        $guestbook = new Guestbook();
        $guestbook->setAttribute('name', $dto->getName());
        $guestbook->setAttribute('phoneNumber', $dto->getPhoneNumber());
        $guestbook->setAttribute('message', $dto->getMessage());
        $guestbook->save();
        
        return new GuestbookDto($guestbook->toArray());
    }
    
    public function getList()
    {
        $paginatedList = Guestbook::orderBy('id', 'desc')->paginate();
        
        return $paginatedList;
    }
}
