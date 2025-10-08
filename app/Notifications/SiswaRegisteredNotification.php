<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SiswaRegisteredNotification extends Notification
{
    use Queueable;

    public $siswa;

    public function __construct($siswa)
    {
        $this->siswa = $siswa;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Siswa Baru Terdaftar')
            ->line('Siswa baru telah mendaftar:')
            ->line('Nama: ' . $this->siswa->nama)
            ->line('NIS: ' . $this->siswa->nis)
            ->action('Lihat Data Siswa', url('/siswa'))
            ->line('Pastikan akun ini valid dan bukan spam.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'nama' => $this->siswa->nama,
            'nis'  => $this->siswa->nis,
            'pesan' => 'Siswa baru telah mendaftar ke sistem UKS.',
        ];
    }
}
