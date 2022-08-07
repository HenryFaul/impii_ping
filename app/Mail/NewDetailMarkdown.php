<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewDetailMarkdown extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $detail;

    public function __construct(User $user, $detail)
    {
        $this->user=$user;
        $this->detail=$detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Impii Protection | New Security Detail')
            ->from('Protection@impii.co.za', 'Impii Protection')
            ->cc('rhfaul@gmail.com')
            ->markdown('emails.detail-markdown');
    }
}
