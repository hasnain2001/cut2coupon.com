<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function index($userId = null)
    {
        $authId = Auth::id();

        // 1. Find user IDs you've talked with
        $chatUserIds = Message::where('sender_id', $authId)
                        ->orWhere('receiver_id', $authId)
                        ->pluck('sender_id', 'receiver_id')
                        ->flatten()
                        ->unique()
                        ->filter(fn($id) => $id != $authId)
                        ->values()
                        ->all();

        // 2. Get chatted users first
        $chattedUsers = User::whereIn('id', $chatUserIds)->get();

        // 3. Get not yet chatted users
        $otherUsers = User::where('id', '!=', $authId)
                          ->whereNotIn('id', $chatUserIds)
                          ->get();

        return view('chat.index', compact('chattedUsers', 'otherUsers'));
    }

    public function chat($userId = null)
    {
        $users = User::where('id', '!=', Auth::id())->get(); // all users except me

        $messages = collect();
        $otherUser = null;

        if ($userId) {
            // Get the other user's details
            $otherUser = User::find($userId);

            // Get messages between current user and selected user
            $messages = Message::where(function ($query) use ($userId) {
                    $query->where('sender_id', Auth::id())
                        ->where('receiver_id', $userId);
                })
                ->orWhere(function ($query) use ($userId) {
                    $query->where('sender_id', $userId)
                        ->where('receiver_id',Auth::id());
                })
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return view('chat.chat', compact('users', 'messages', 'userId', 'otherUser'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $user = Auth::user();

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($user, $message))->toOthers(); // if you are using broadcasting (Pusher or Laravel Echo)

        return redirect()->route('chat.index', ['userId' => $request->receiver_id])
                         ->with('success', 'Message sent successfully.');
    }


    public function fetchMessages($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id',Auth::id())->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)->where('receiver_id',Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }
    public function getNewMessages(Request $request)
{
    $lastMessageId = $request->input('last_message_id', 0);
    $receiverId = $request->input('receiver_id');

    $messages = Message::with('sender')
        ->where(function($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', Auth::id());
        })
        ->where('id', '>', $lastMessageId)
        ->orderBy('created_at', 'asc')
        ->get();

    return response()->json([
        'messages' => $messages
    ]);
}

}
