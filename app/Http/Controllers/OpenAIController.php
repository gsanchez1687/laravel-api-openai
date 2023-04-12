<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class OpenAIController extends Controller
{

    private const MODEL_DEFAUTL = "text-davinci-003";

    public function index(Request $request){
        
        $client = OpenAI::client(config('services.openai.key'));

        if($request->search){

            $response = $client->completions()->create([
                'model' => self::MODEL_DEFAUTL,
                'prompt' => $request->search,
                'max_tokens' => 4000,
                'temperature' => 0,
            ]);
            $completions = $response->toArray();
            $result = $completions['choices'][0]['text'];

            return view('openai.index', [
                'result' => $result
            ]);
        }

        return view('openai.index');
    }
}
