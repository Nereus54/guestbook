<?php

namespace Tests\Guestbook;

use Tests\TestCase;
use App\Services\Guestbook\Common\Dto\GuestbookDto;
use App\Services\Guestbook\GuestbookService;

/**
 * Description of GuestbookServiceTest
 *
 * @author marcelbobak
 */
class GuestbookServiceTest extends TestCase
{
    private $service;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->service = new GuestbookService();
    }

    public function testCreateEntrySuccess()
    {
        $dto = new GuestbookDto();
        $dto->setName('Joe');
        $dto->setPhoneNumber('+421 (0) 905 123 456');
        $dto->setMessage("Test message");
        
        $response = $this->service->createEntry($dto);
        
        $this->assertInstanceOf(GuestbookDto::class, $response);
        
        $this->assertEquals($dto->getName(), $response->getName());
        $this->assertEquals($dto->getPhoneNumber(), $response->getPhoneNumber());
        $this->assertEquals($dto->getMessage(), $response->getMessage());
    }
    
    public function testCreateEntryFailEmptyDto()
    {
        $this-> expectException(\App\Services\Guestbook\Exception\ValidationException::class);
        
        $response = $this->service->createEntry(new GuestbookDto());
    }
    
    public function testCreateEntryFailMobileNumber()
    {
        $this-> expectException(\App\Services\Guestbook\Exception\ValidationException::class);
        
        $dto = new GuestbookDto();
        $dto->setName('Joe');
        $dto->setPhoneNumber('1905 123 456');
        $dto->setMessage("Test message");
        
        $response = $this->service->createEntry($dto);
    }
    
    public function testCreateEntryFailLandlineNumber()
    {
        $this-> expectException(\App\Services\Guestbook\Exception\ValidationException::class);
        
        $dto = new GuestbookDto();
        $dto->setName('Joe');
        $dto->setPhoneNumber('00421 99 55 54 444');
        $dto->setMessage("Test message");
        
        $response = $this->service->createEntry($dto);
    }
    
    public function testGetList()
    {
        $reponse = $this->service->getList();
        
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $reponse);
        
        $this->assertEquals(false, $reponse->isEmpty());
        
        $this->assertEquals(1, $reponse->count());
    }
}
