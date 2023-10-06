<?php
// app/Mail/ConfirmationMail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function build()
    {
        return $this->view('emails.confirmation')
                    ->with('response', $this->response);
    }
}
