<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function listRules()
    {
        $rules = Rule::orderBy('order_index')->get();
        return view('admin.rules.index', compact('rules'));
    }

    public function createRule()
    {
        return view('admin.rules.create');
    }

    public function storeRule(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'order_index' => 'nullable|integer',
        ]);

        Rule::create($request->only('title', 'content', 'order_index'));

        return redirect()->route('admin.rules.index')->with('success', __('admin/rules.created'));
    }

    public function editRule(Rule $rule)
    {
        return view('admin.rules.edit', compact('rule'));
    }

    public function updateRule(Request $request, Rule $rule)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'order_index' => 'nullable|integer',
        ]);

        $rule->update($request->only('title', 'content', 'order_index'));

        return redirect()->route('admin.rules.index')->with('success', __('admin/rules.updated'));
    }
}
