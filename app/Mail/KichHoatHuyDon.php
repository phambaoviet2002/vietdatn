<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KichHoatHuyDon extends Mailable
{
    use Queueable, SerializesModels;

    protected $du_lieu;

    public function __construct($du_lieu)
    {
        $this->du_lieu = $du_lieu;
    }

    public function build()
    {
        return $this->subject('Bạn đã hủy đặt hàng ở shop GUCCI')
            ->view('Trang-Khach-Hang.page.MailKichHoatHuyDon', [
                'du_lieu' => $this->du_lieu,
            ]);
    }
}
