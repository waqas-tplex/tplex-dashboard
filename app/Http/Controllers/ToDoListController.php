<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = auth()->user()->toDos()->get();

        return Inertia::render('Todo/List', [
            'todos' => $todos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Todo/Show');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ToDoList::create(array_merge($request->all(), ['user_id' => auth()->user()->id]));

        return redirect(route('dashboard'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = ToDoList::find($id);

        return Inertia::render('Todo/Show', ['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        ToDoList::where('id', $id)->update($request->except(['ends_at_diff','badge_color', 'created_at', 'updated_at']));

        return redirect(route('dashboard'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ToDoList::find($id)->delete();
    }
}
