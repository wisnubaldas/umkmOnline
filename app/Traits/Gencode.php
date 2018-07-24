<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait Gencode
{
	private function generateCode($database, $char, $digitLength = 3)
    {
        $maxCodeToday = DB::table($database)->whereDate('created_at', today())->max('code');
        $today = Carbon::parse(today())->format('Ymd');
        if (is_null($maxCodeToday)) {
            return $char . $today . str_pad(1, $digitLength, '0', STR_PAD_LEFT);
        } else {
            $currentNumber = substr($maxCodeToday, strlen($char) + strlen($today), $digitLength);
            $newNumber = str_pad((int)($currentNumber + 1), $digitLength, '0', STR_PAD_LEFT);
            return $char . $today . $newNumber;
        }
    }
}