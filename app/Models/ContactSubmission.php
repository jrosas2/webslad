<?php

namespace App\Models;

use App\ContactSubmissionStatus;
use Database\Factories\ContactSubmissionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['submission_token', 'name', 'company', 'position', 'email', 'phone', 'estimated_users', 'needs', 'message', 'status', 'ip_address'])]
class ContactSubmission extends Model
{
    /** @use HasFactory<ContactSubmissionFactory> */
    use HasFactory;

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'needs' => 'array',
            'status' => ContactSubmissionStatus::class,
        ];
    }
}
