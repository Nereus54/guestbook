<?php

namespace App\Services\Guestbook\Common;

use App\Services\Guestbook\Common\Dto\GuestbookDto;

/**
 *
 * @author marcelbobak
 */
interface IGuestbookService
{
    /**
     * Creates new guestbook entry
     * 
     * @param GuestbookDto $dto DTO for validation of input
     * @return GuestbookDto DTO of stored DB values
     * @throws \App\Services\Guestbook\Exception\ValidationException
     */
    public function createEntry(GuestbookDto $dto);
    
    /**
     * Get  paginated list of all guestbook entries
     * 
     * @return \Illuminate\Pagination\LengthAwarePaginator 
     */
    public function getList();
}
