<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $asm_name;
    public $asm_dueTime;
    public $asm_dueDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($asm_name,$asm_dueDate,$asm_dueTime)
    {
        //
        $this->asm_name = $asm_name;
        $this->asm_dueDate = $asm_dueDate;
        $this->asm_dueTime = $asm_dueTime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Assignment - '.$this->asm_name)->markdown('emails.newAssignment');
    }
}
