<?php

namespace App\Http\Controllers;

use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Http\Request;
use App\Events\PusherBroadcast;

class PusherController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }
    public function broadcast(Request $request)
    {
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();
        return view('chat.broadcast',['message' => $request->get('message')]);
    }
    public function recive(Request $request)
    {
        return view('chat.recieve',['message' => $request->get('message')]);
    }
}
