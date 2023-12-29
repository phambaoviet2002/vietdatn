<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KichHoatLienHe extends Mailable
{
    use Queueable, SerializesModels;

    protected $du_lieu;

    public function __construct($du_lieu)
    {
        $this->du_lieu = $du_lieu;
    }

    public function build()
    {
        return $this->subject('Cảm ơn đã gửi liên hệ cho chúng tôi')
            ->view('Trang-Khach-Hang.page.MailKichHoatLienHe', [
                'du_lieu'   => $this->du_lieu,
            ]);
    }
}
