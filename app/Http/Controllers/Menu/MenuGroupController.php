<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuGroupRequest;
use App\Http\Requests\UpdateMenuGroupRequest;
use App\Models\MenuGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class MenuGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $menuGroups = DB::table('menu_groups')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('position')
            ->paginate(10);
        return view('menu.menu-group.index', compact('menuGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('menu.menu-group.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuGroupRequest $request)
    {
        //
        $maxPosition = MenuGroup::max('position') ?? 0;
        $data = $request->validated();
        $data['position'] = $maxPosition + 1;
        MenuGroup::create($data);
        return redirect()->route('menu-group.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuGroup  $menuGroup
     * @return \Illuminate\Http\Response
     */
    public function show(MenuGroup $menuGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuGroup  $menuGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuGroup $menuGroup)
    {
        //
        return view('menu.menu-group.edit', compact('menuGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuGroup  $menuGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuGroupRequest $request, MenuGroup $menuGroup)
    {
        //
        $data = $request->validated();
        $menuGroup->update($data);
        return redirect()->route('menu-group.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuGroup  $menuGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuGroup $menuGroup)
    {
        //
        $menuGroup->delete();
        return redirect()->route('menu-group.index')->with('success', 'Data berhasil dihapus');
    }

    public function moveUp($id)
    {
        $menuGroup = MenuGroup::findOrFail($id);
        $previousMenuGroup = MenuGroup::where('position', '<', $menuGroup->position)
            ->orderBy('position', 'desc')
            ->first();

        if ($previousMenuGroup) {
            $tempPosition = $menuGroup->position;
            $menuGroup->position = $previousMenuGroup->position;
            $previousMenuGroup->position = $tempPosition;

            $menuGroup->save();
            $previousMenuGroup->save();

            return redirect()->back()->with('success', 'Menu group moved up successfully.');
        }

        return redirect()->back()->with('error', 'Failed to move menu group up.');
    }

    public function moveDown($id)
    {
        $menuGroup = MenuGroup::findOrFail($id);
        $nextMenuGroup = MenuGroup::where('position', '>', $menuGroup->position)
            ->orderBy('position', 'asc')
            ->first();

        if ($nextMenuGroup) {
            $tempPosition = $menuGroup->position;
            $menuGroup->position = $nextMenuGroup->position;
            $nextMenuGroup->position = $tempPosition;

            $menuGroup->save();
            $nextMenuGroup->save();

            return redirect()->back()->with('success', 'Menu group moved down successfully.');
        }

        return redirect()->back()->with('error', 'Failed to move menu group down.');
    }
}
