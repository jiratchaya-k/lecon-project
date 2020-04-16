<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $asm_id;
    public $asm_name;
    public $asm_dueTime;
    public $asm_dueDate;
    public $asm_section;
    public $asm_subject;
    public $std_name;
    public $std_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($asm_id,$asm_name,$asm_dueDate,$asm_dueTime,$asm_section,$asm_subject,$std_name,$std_id)
    {
        //
        $this->asm_id = $asm_id;
        $this->asm_name = $asm_name;
        $this->asm_dueDate = $asm_dueDate;
        $this->asm_dueTime = $asm_dueTime;
        $this->asm_section = $asm_section;
        $this->asm_subject = $asm_subject;
        $this->std_name = $std_name;
        $this->std_id = $std_id;
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
