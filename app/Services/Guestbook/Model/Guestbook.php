<?php

namespace App\Services\Guestbook\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Guestbook
 *
 * @author marcelbobak
 */
class Guestbook extends Model
{
    protected $table = 'guestbook';

    protected $fillable = [
        'name',
        'phoneNumber',
        'message',
    ];
    
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }
}
