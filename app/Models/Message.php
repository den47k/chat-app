<?php

namespace App\Models;

use App\Models\User;
use App\Models\MessageAttachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'sender_id',
        'receiver_id',
        'group_id',
        'conversation_id'
    ];

    public function sender () {
        return $this->belongsTo(User::class);
    }

    public function receiver () {
        return $this->belongsTo(User::class);
    }

    public function group () {
        return $this->belongsTo(User::class);
    }

    public function attachments () {
        return $this->hasMany(MessageAttachment::class);
    }
}
