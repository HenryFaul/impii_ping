<?php

namespace App\Mail;

use App\Models\Emergency;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEmegencyMarkdown extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;
    public $emergency;

    public function __construct(User $user, $emergency)
    {
        $this->user=$user;
        $this->emergency=$emergency;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Impii Protection | New Emergency')
            ->from('Protection@impii.co.za', 'Impii Protection')
            ->cc('rhfaul@gmail.com')
            ->markdown('emails.emergency-markdown');
    }
}
