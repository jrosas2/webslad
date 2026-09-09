<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSiteSettingsRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settingGroups' => SiteSetting::query()->orderBy('group')->orderBy('id')->get()->groupBy('group'),
        ]);
    }

    public function update(UpdateSiteSettingsRequest $request): RedirectResponse
    {
        foreach ($request->validated('settings') as $settingId => $value) {
            SiteSetting::query()->whereKey($settingId)->update(['value' => $value]);
        }

        return back()->with('status', 'Configuración actualizada correctamente.');
    }
}
