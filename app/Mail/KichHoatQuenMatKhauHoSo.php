<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KichHoatQuenMatKhauHoSo extends Mailable
{
    use Queueable, SerializesModels;

    protected $du_lieu;

    public function __construct($du_lieu)
    {
        $this->du_lieu = $du_lieu;
    }

    public function build()
    {
        return $this->subject('Đổi Mật Khẩu Tài Khoản Tại Website....')
            ->view('AdminRocker.page.TaiKhoan.MailKichhoatQuenMatKhauHoSo', [
                'du_lieu'   => $this->du_lieu,
            ]);
    }
}
