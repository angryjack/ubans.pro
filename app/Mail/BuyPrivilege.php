<?php

namespace App\Mail;

use App\Models\Privilege;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyPrivilege extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $privilege;

    public function __construct(User $user, Privilege $privilege)
    {
        $this->user = $user;
        $this->privilege = $privilege;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Покупка привилегии')
            ->view('mails.buy_privilege');
    }
}
