<?php

namespace App\Listeners;

use App\Events\SiswaRegistered;
use App\Models\User;
use Illuminate\Support\Facades\Notification; // ← WAJIB untuk bisa pakai Notification
use App\Notifications\SiswaRegisteredNotification;

class SendSiswaRegisteredNotification
{
    /**
     * Handle the event.
     */
    public function handle(SiswaRegistered $event): void
    {
        // Ambil semua admin
        $admins = User::where('role', 'admin')->get();

        // Jika ada admin, kirim notifikasi
        if ($admins->isNotEmpty()) {
            Notification::send($admins, new SiswaRegisteredNotification($event->siswa));
        }
    }
}
