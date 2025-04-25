<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovedStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pdfPath;

    public function __construct($user, $pdfPath)
    {
        $this->user = $user;
        $this->pdfPath = $pdfPath;
    }
    
    public function build()
    {
        return $this->subject('Your Visa Has Been Approved')
                    ->view('emails.approved')
                    ->attach($this->pdfPath, [
                        'as' => 'Visa_Approval.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
    
}
