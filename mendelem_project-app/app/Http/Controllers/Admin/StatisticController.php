<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statistic;

class StatisticController extends Controller
{
    public function index()
    {
        $stats = Statistic::orderBy('group')->orderBy('order')->get()->groupBy('group');
        return view('admin.statistics.index', compact('stats'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'key'      => 'required|unique:statistics,key',
            'label_id' => 'required|string|max:100',
            'label_en' => 'nullable|string|max:100',
            'value'    => 'required|string|max:100',
            'unit'     => 'nullable|string|max:50',
            'group'    => 'required|string|max:50',
            'icon'     => 'nullable|string|max:100',
            'color'    => 'nullable|string|max:20',
            'order'    => 'nullable|integer|min:0',
        ]);
        $data['order'] = $data['order'] ?? 0;
        Statistic::create($data);
        return back()->with('success', 'Statistik ditambahkan!');
    }

    public function update(Request $r, Statistic $statistic)
    {
        $statistic->update($r->validate([
            'value' => 'required|string|max:100',
        ]));
        return back()->with('success', 'Statistik diperbarui!');
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();
        return back()->with('success', 'Statistik dihapus.');
    }
}
