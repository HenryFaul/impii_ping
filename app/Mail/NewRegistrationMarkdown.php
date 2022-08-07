<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewRegistrationMarkdown extends Mailable implements  ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $voucher;
    public function __construct(User $user, Voucher $voucher)
    {
        $this->user=$user;
        $this->voucher=$voucher;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->subject('Impii Protection | New registration')
            ->from('Protection@impii.co.za', 'Impii Protection')
             ->cc('rhfaul@gmail.com')
            ->markdown('emails.registration-markdown');
    }
}
