<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\monitoring;
use App\Models\Pakan;
use App\Models\User;

class PageController extends Controller
{
    public function profileView()
    {
        return view('page.profile.profile');
    }

    public function changePasswordView()
    {
        return view('page.profile.change_password');
    }

    public function loginView()
    {
        return view('page.auth.login');
    }

    public function dashboardView()
    {
        $latestMonitoringData = Monitoring::latest('created_at')->first();
        $latestPakanData = Pakan::latest('created_at')->first();

        return view('page.menu.dashboard', [
            'data'  => $latestMonitoringData,
            'pakan' => $latestPakanData,
        ]);
    }

    public function analisisView()
    {
        $now = now();
        $twoDaysAgo = $now->subDays(2);

        $records = Monitoring::where('created_at', '>=', $twoDaysAgo)
            ->whereRaw("HOUR(created_at) % 2 = 0") // Filter for every two hours
            ->orderBy('created_at', 'asc')
            ->get();

        // Prepare data for chart
        $labels = $records->map(function ($record) {
            return $record->created_at->format('d M H:i');
        });

        $temperatures = $records->pluck('temperature');
        $phLevels = $records->pluck('ph');
        $tdsLevels = $records->pluck('tds');
        $heights = $records->pluck('tinggi_air');

        return view('page.menu.analisis', compact('labels', 'temperatures', 'phLevels', 'tdsLevels', 'heights'));
    }

    public function controlView()
    {
        $pakan = Pakan::findOrFail(1);
        return view('page.menu.control', compact('pakan'));
    }

    public function deviceView()
    {
        return view('page.menu.device');
    }

    public function listUserView()
    {
        $users = User::all(); // Fetch all users from the database

        return view('page.menu.data_user', ['users' => $users]);
    }

    public function formAddUser()
    {
        return view('page.user.form_add');
    }

    public function formEditUser($id)
    {
        $user = User::find($id);
        return view('page.user.form_edit', compact('user'));
    }
}
