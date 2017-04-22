<?php

namespace App\Http\Controllers;

use App\Services\Guestbook\Common\IGuestbookService;
use App\Services\Guestbook\Common\Dto\GuestbookDto;
use App\Services\Guestbook\Exception\ValidationException;
use Illuminate\Http\Request;

/**
 * Description of GuestbookController
 *
 * @author marcelbobak
 */
class GuestbookController extends Controller
{
    private $guestbookService;
    
    public function __construct(IGuestbookService $guestbookService)
    {
        $this->guestbookService = $guestbookService;
    }
    
    public function showGuestbook()
    {
        $list = $this->guestbookService->getList()->toArray();
        
        return view('guestbook.show', compact('list'));
    }
    
    public function addEntry(Request $request)
    {
        $params = $request->only('name', 'phoneNumber', 'message');
        
        try {
            $dto = new GuestbookDto($params);
            
            $response = $this->guestbookService->createEntry($dto);
            
        } catch(ValidationException $e) {
            return redirect()->to('/guestbook')->with('error', $e->getMessage());
        }
        
        return redirect()->to('/guestbook');
    }
    
    public function about()
    {
        return view('guestbook.about');
    }
}
