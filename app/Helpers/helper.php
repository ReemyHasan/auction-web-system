<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function snake_to_title($value): string
{
    return Str::title(str_replace('_', ' ', $value));
}


function diffForHumans($date)
{
    return Carbon::parse($date)->diffForHumans();
}

function showDateTime($date,$format = 'Y-m-d h:i A')
{
    return Carbon::parse($date)->translatedFormat($format);
}
function OTPCode($length = 6)
{
    if ($length == 0)
        return 0;
    $min = pow(10, $length - 1);
    $max = (int)($min - 1) . '9';
    return random_int($min, $max);
}


function getPublicFileUrl(?string $path): ?string
{
    if (!$path || !Storage::disk('public')->exists($path)) {
        return null;
    }

    return asset('storage/' . ltrim($path, '/'));
}

function saveFile($file, string $directory): string
{
    return $file->store($directory, 'public');
}

