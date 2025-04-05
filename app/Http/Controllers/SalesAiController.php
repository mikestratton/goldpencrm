<?php

namespace App\Http\Controllers;

use App\Models\AiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use OpenAI\Laravel\Facades\OpenAI;

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

//        $response = OpenAI::chat()->create([
//            'model' => 'gpt-3.5-turbo',
//            'messages' => [
//                ['role' => 'user', 'content' => 'Hello!'],
//            ],
//        ]);
//
//        $response->choices[0]->message->content; // Hello! How can I assist you today?

        $response = OpenAI::chat()->create([
                    "model" => "gpt-3.5-turbo",
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
                ])->choices[0]->message->content;

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

    public function destroy(AiResponse $aiResponse)
    {
        // Check if the user owns this response
        if ($aiResponse->user_id !== auth()->id()) {
            abort(403);
        }

        $aiResponse->delete();
        return redirect()->route('pitches.index')->with('success', 'Pitch deleted successfully!');
    }

    public function edit(AiResponse $pitch)
    {
        if ($pitch->user_id !== auth()->id()) {
            abort(403);
        }

        return view('salesai.edit', compact('pitch'));
    }

    public function update(Request $request, AiResponse $pitch)
    {
        if ($pitch->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'prompt' => 'required|string',
            'response' => 'required|string'
        ]);

        $pitch->update($validated);

        return redirect()->route('salesai.edit', $pitch);
    }
}
