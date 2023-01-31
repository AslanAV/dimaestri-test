<?php

namespace App\Http\Controllers;

use App\Models\OrderWithScore;
use App\Services\CountScoreFromOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrderWithScoreController extends Controller
{
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|',
            'client_id' => 'required',
            'items' => 'required',
            'status' => 'required|max:255',
        ]);
        abort_if($validator->fails(), 404);

        $scoreToOrder = CountScoreFromOrder::getScoreFromOrder($request->items);
        $data = $validator->validated();
        $orderWithScore = OrderWithScore::updateOrCreate(
            ['order_id' => $data['id']],
            [
                'client_id' => $data['client_id'],
                'items' => json_encode($data['items'], JSON_THROW_ON_ERROR),
                'status' => $data['status'],
                'scores' => $scoreToOrder,
            ]
        );

        $returnData = [
            'client_id' => $orderWithScore->client_id,
        	'scores' => $scoreToOrder,
            'order_id' => $orderWithScore->order_id,
        ];
        return response()->json($returnData);
    }
}
