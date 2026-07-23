<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PollController extends Controller
{
    public function vote(Request $request, Poll $poll)
    {
        $request->validate([
            'option_id' => 'required|exists:poll_options,id'
        ]);

        $ip = $request->ip();
        $userId = auth()->id();

        // Check if already voted
        $alreadyVoted = PollVote::where('poll_id', $poll->id)
            ->where(function ($query) use ($ip, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId)->orWhere('ip_address', $ip);
                } else {
                    $query->where('ip_address', $ip);
                }
            })->exists();

        if ($alreadyVoted) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memberikan suara pada jajak pendapat ini!'
            ], 422);
        }

        DB::transaction(function () use ($poll, $request, $ip, $userId) {
            $option = PollOption::findOrFail($request->option_id);
            $option->increment('votes_count');

            PollVote::create([
                'poll_id' => $poll->id,
                'poll_option_id' => $option->id,
                'ip_address' => $ip,
                'user_id' => $userId,
            ]);
        });

        $poll->load('options');

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas partisipasi suara Anda!',
            'poll' => [
                'id' => $poll->id,
                'total_votes' => $poll->total_votes,
                'options' => $poll->options->map(function ($opt) use ($poll) {
                    $total = $poll->total_votes > 0 ? $poll->total_votes : 1;
                    return [
                        'id' => $opt->id,
                        'text' => $opt->option_text,
                        'votes' => $opt->votes_count,
                        'percentage' => round(($opt->votes_count / $total) * 100, 1)
                    ];
                })
            ]
        ]);
    }
}
