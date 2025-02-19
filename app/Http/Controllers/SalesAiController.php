<?php

namespace App\Http\Controllers;

use App\Models\AiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SalesAiController extends Controller
{
    public function index()
    {

    }

    public function process(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        $prompt = $request->input('prompt');

        $response = Http::withToken(config('services.openai.secret'))
            ->post('https://api.openai.com/v1/chat/completions',
                [
                    "model" => "gpt-4o-mini",
                    "messages" => [
                        [
                            "role" => "system",
                            "content" => "You are a helpful assistant."
                        ],
                        [
                            "role" => "user",
                            "content" => $prompt,
                        ],
                    ],
                ])->json('choices.0.message.content');

        return view('salesai', ['response' => $response, 'original_prompt' => $prompt]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'edited_response' => 'required|string',
            'original_prompt' => 'required|string',
        ]);
        $user_id = auth()->id();
//        dd($user_id);
        AiResponse::create([
            'user_id' => $user_id,
            'prompt' => $request->input('original_prompt'),
            'response' => $request->input('edited_response'),
        ]);

        return redirect()->route('salesai')->with('success', 'Response saved!');
    }
}
