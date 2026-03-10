<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
class StatisticController extends Controller
{
    public function index()
    {
        $stats = \App\Models\Statistic::orderBy('group')->orderBy('order')->get()->groupBy('group');
        return view('admin.statistics.index', compact('stats'));
    }
    public function update(\Illuminate\Http\Request $r, \App\Models\Statistic $statistic)
    {
        $statistic->update($r->validate(['value'=>'required|string|max:100']));
        return back()->with('success', 'Statistik diperbarui!');
    }
    public function store(\Illuminate\Http\Request $r)
    {
        \App\Models\Statistic::create($r->validate(['key'=>'required|unique:statistics,key','label_id'=>'required','label_en'=>'nullable','value'=>'required','unit'=>'nullable','group'=>'required','icon'=>'nullable','color'=>'nullable','order'=>'integer|min:0']));
        return back()->with('success', 'Statistik ditambahkan!');
    }
    public function destroy(\App\Models\Statistic $statistic)
    {
        $statistic->delete();
        return back()->with('success', 'Statistik dihapus.');
    }
}
