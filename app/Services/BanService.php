<?php

namespace App\Services;

use App\Models\Ban;
use Illuminate\Http\Request;

class BanService
{
    public function search(Request $request)
    {
        $search = $request->input('search');

        $list = Ban
            ::when($search, function ($query, $search) {
                return $query
                    ->where('player_nick', 'like', "%$search%")
                    ->orWhere('player_id', 'like', "%$search%")
                    ->orWhere('player_ip', 'like', "%$search%");
            })
            ->orderBy('bid', 'desc')->paginate(50);

        return $list;
    }

    public function getById($id)
    {
        return Ban::findOrFail($id);
    }

    public function update(Ban $model, Request $request)
    {
        //todo validate
        $ban_length = (int)$request->input('ban_length');

        $ban_reason = $request->input('ban_reason');

        if ($ban_length !== -1 && $ban_length !== 0) {
            $timeDifference = time() - $model->ban_created;
            $ban_length += $timeDifference / 60;
        }

        $model->ban_length = $ban_length;
        $model->ban_reason = $ban_reason;
        $model->save();
    }
}
