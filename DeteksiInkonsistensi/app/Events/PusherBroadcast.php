<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $id_jadwal_konsultasi;
    public string $username;
    public string $message;
    public string $timestamp;
    public string $username_psikolog;
    public string $nama_psikolog;
    public string $username_pasien;
    public string $nama_pasien;

    public function __construct(string $id_jadwal_konsultasi, string $username, string $message, string $timestamp, string $username_psikolog, string $nama_psikolog, string $username_pasien, string $nama_pasien)
    {
        $this->id_jadwal_konsultasi = $id_jadwal_konsultasi;
        $this->username = $username;
        $this->message = $message;
        $this->timestamp = $timestamp;
        $this->username_psikolog = $username_psikolog;
        $this->nama_psikolog = $nama_psikolog;
        $this->username_pasien = $username_pasien;
        $this->nama_pasien = $nama_pasien;
    }

    public function broadcastOn(): array
    {
        return ['private.' . $this->id_jadwal_konsultasi];
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
