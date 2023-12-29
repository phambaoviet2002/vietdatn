<?php

namespace App\Jobs;

use App\Mail\KichHoatHuyDon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GuiMailHuyDon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $du_lieu_Mail;

    public function __construct($du_lieu_Mail)
    {
        $this->du_lieu_Mail = $du_lieu_Mail;
    }

    public function handle()
    {
        Mail::to($this->du_lieu_Mail['email'])->send(new KichHoatHuyDon($this->du_lieu_Mail));
    }
}
