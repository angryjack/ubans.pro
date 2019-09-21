<?php

namespace App\Services;

use App\Models\Privilege;
use App\Models\PrivilegeRate;
use App\Models\Server;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class PrivilegeService
{
    use ProvidesConvenienceMethods;

    public function search(Request $request)
    {
        $search = $request->input('search');

        $list = Privilege
            ::when($search, function ($query, $search) {
                return $query
                    ->where('title', 'like', "%$search%")
                    ->orWhere('flags', 'like', "%$search%");
            })
            ->orderBy('id', 'desc')->paginate(50);

        return $list;
    }

    public function getById($id)
    {
        return Privilege::findOrFail($id);
    }

    public function getServerPrivileges(Server $server)
    {
        return $server->privileges()->where('status', 1)->get();
    }

    public function store(Request $request)
    {
        $validationRules = [
            'title' => 'required',
            'flags' => 'required',
            'server_id' => 'required',
        ];
        $this->validate($request, $validationRules);

        $model = Privilege::find($request->input('id', 0));

        if ($model === null) {
            $model = new Privilege();
        }

        $model->status = 0;
        $model->fill($request->all());
        $model->save();

        $rates = $request->input('rates', '');

        $rates = explode(',', $rates);

        //todo подумать об синхронизации
        PrivilegeRate::where('privilege_id', $model->id)->delete();

        foreach ($rates as $rate) {
            $rate = explode('-', $rate);
            if (!isset($rate[0], $rate[1])) {
                continue;
            }
            $term = (int)$rate[0];
            $price = (int)$rate[1];

            if (!is_int($price) || !is_int($term) || $term < 0 || $price < 1) {
                continue;
            }

            $rate = PrivilegeRate::firstOrCreate([
                'privilege_id' => $model->id,
                'term' => $term,
                'price' => $price
            ]);

            $model->rates()->save($rate);
        }

        return $model;
    }
}
