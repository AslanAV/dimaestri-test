<?php

namespace App\Services;

use App\Models\Score;

class CountScoreFromOrder
{
    public static function getScoreFromOrder($items)
    {
        $scoreArticles = Score::pluck('article')->toArray();
        $scores = Score::all();

        $sumOfScores = collect($items)
            ->filter(fn ($item) => in_array($item['article'], $scoreArticles, true))

            ->map(function ($item) use ($scores) {
                $score = $scores->firstWhere('article', $item['article']);
                return $item['quantity'] * $score['quantity'];
            })

            ->pipe(function ($items) {
                return $items->sum();
            });
        return $sumOfScores;
    }
}
