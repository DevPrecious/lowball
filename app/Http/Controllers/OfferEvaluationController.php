<?php

namespace App\Http\Controllers;

use App\Models\SavedOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferEvaluationController extends Controller
{
    public function evaluate(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'salary' => 'required|numeric',
        ]);

        $prompt = <<<PROMPT
You are an expert tech compensation negotiator. 
Evaluate this job offer:
- Job Title: {$validated['job_title']}
- Company: {$validated['company_name']}
- Location: {$validated['location']}
- Salary Offered: \${$validated['salary']}

Return a raw JSON object with exactly these keys:
- "lowball_score": integer between 0 and 100 (0=insulting, 100=strong offer).
- "lowball_label": string containing exactly one of: "Strong Offer", "Fair", or "Insulting".
- "strategy": string containing a short, encouraging 2-sentence negotiation strategy.
- "rebuttals": array of exactly 3 strings, each being a 1-sentence persuasive rebuttal based on market/skills to use in negotiation.
- "what_not_to_say": array of exactly 3 strings, each being a 1-sentence warning of what NOT to say and why (e.g. "Don't apologize for asking. (It weakens your position)").
- "phone_script": string containing a short, highly professional 2-3 sentence conversational script the user can read if they negotiate live over the phone based on their specific details.

Output ONLY valid JSON, do not include markdown formatting like ```json.
PROMPT;

        try {
            $client = \Gemini::client(env('GEMINI_API_KEY'));
            $response = $client->generativeModel('gemini-2.5-flash')->generateContent($prompt);
            $jsonString = trim($response->text());

            // Clean up possible markdown code blocks if the AI includes them anyway
            $jsonString = str_replace(['```json', '```'], '', $jsonString);

            $data = json_decode(trim($jsonString), true);

            if (!$data) {
                $offer = auth()->user()->savedOffers()->create([
                    'job_title' => $validated['job_title'],
                    'company_name' => $validated['company_name'],
                    'location' => $validated['location'],
                    'salary' => $validated['salary'],
                    'lowball_score' => 50,
                    'lowball_label' => 'Fair',
                    'strategy' => 'Unable to generate strategy. Please try negotiating higher.',
                    'rebuttals' => [
                        "I believe my current market value is higher.",
                        "I bring specialized skills to this role.",
                        "I am looking for a base that reflects the cost of living."
                    ],
                    'warnings' => [
                        "I have another offer for $200k so you need to match it. (Too aggressive)",
                        "I'm sorry to ask, but is there any room for negotiation? (Don't apologize)",
                        "I just need more money because my rent increased. (Personal needs aren't leverage)"
                    ],
                    'phone_script' => "Hi, thanks so much for the offer. However, based on my research and experience, I was looking closer to a higher base. Is there flexibility here?",
                ]);
            } else {
                $offer = auth()->user()->savedOffers()->create([
                    'job_title' => $validated['job_title'],
                    'company_name' => $validated['company_name'],
                    'location' => $validated['location'],
                    'salary' => $validated['salary'],
                    'lowball_score' => $data['lowball_score'] ?? 50,
                    'lowball_label' => $data['lowball_label'] ?? 'Fair',
                    'strategy' => $data['strategy'] ?? 'Please try negotiating for higher equity or base pay based on your market value.',
                    'rebuttals' => $data['rebuttals'] ?? [
                        "I believe my current market value is higher.",
                        "I bring specialized skills to this role.",
                        "I am looking for a base that reflects the cost of living."
                    ],
                    'warnings' => $data['what_not_to_say'] ?? [
                        "I have another offer for $200k so you need to match it. (Too aggressive)",
                        "I'm sorry to ask, but is there any room for negotiation? (Don't apologize)",
                        "I just need more money because my rent increased. (Personal needs aren't leverage)"
                    ],
                    'phone_script' => $data['phone_script'] ?? "Hi, thanks so much for the offer. Based on my research and experience, I was looking for a higher base salary. Is there flexibility here?",
                ]);
            }

            return redirect()->route('comparison', ['offer' => $offer->id]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'API Error: ' . $e->getMessage()])->withInput();
        }
    }
}
