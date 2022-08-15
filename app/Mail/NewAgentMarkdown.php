<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAgentMarkdown extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $detail;
    public $agent_user;
    public $agent_url;
    public $agency;

    public function __construct(User $user, $detail,$agent_user,$agency)
    {
        $this->user=$user;
        $this->detail=$detail;
        $this->agent_user=$agent_user;
        $this->agency=$agency;
        $agent_id = $this -> detail->agent_id === null || $this -> detail->agent_id===0? 1:($this -> detail->agent_id);
        $this->agent_url = "https://app.impii.co.za/agent/" . $agent_id ."/profile";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Impii Protection | Agent Assigned')
            ->from('Protection@impii.co.za', 'Impii Protection')
            ->cc('rhfaul@gmail.com')
            ->markdown('emails.agent-markdown');
    }
}
