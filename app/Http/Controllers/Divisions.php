<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Divisions as DivisionsModel;


class Divisions extends Controller
{

    public function index()
    {
        $divisions = DivisionsModel::get();
        $data = ([
            "divisions"=> $divisions
        ]);
        return view("divisions.index",$data);
    }

    public function create()
    {
        return view("divisions.create");
    }

    public function store(Request $request)
    {
        $name = $request->name;
        DivisionsModel::create([
            'name' => $name
        ]);

        return redirect('divisions');
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $division = DivisionsModel::findOrFail($id);
        return view("divisions.edit", ["division" => $division]);

    }

    public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Temukan division sesuai ID
    $division = \App\Models\Divisions::findOrFail($id);

    // Update data
    $division->update([
        'name' => $request->name,
    ]);

    // ✅ Setelah update, kembali ke halaman divisions dengan pesan sukses
    return redirect('divisions')->with('success', 'Division updated successfully!');
}

    public function destroy(string $id)
    {
        $division = DivisionsModel::find($id);

        if ($division) {
            $division->delete();
        }

        return redirect('divisions')->with('success', 'Division deleted successfully.');
    }
}
