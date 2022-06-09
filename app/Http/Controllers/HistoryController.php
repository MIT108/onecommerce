<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    //
    public function Add($message, $heading){
        History::create([
            'heading' => $heading,
            'message' => $message,
            'user_id' => auth()->user()->id
        ]);
    }
}
