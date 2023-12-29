<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KichHoatHoanTat extends Mailable
{
    use Queueable, SerializesModels;

    protected $du_lieu;

    /**
     * Create a new message instance.
     */
    public function __construct($du_lieu)
    {
        $this->du_lieu = $du_lieu;
    }

    public function build()
    {
        return $this->subject('[ GUCCI ] Đơn hàng của bạn đã được hoàn tất!')
            ->view('Trang-Khach-Hang.page.MailKichHoatHoanTat', [
                'du_lieu' => $this->du_lieu,
            ]);
    }
}
