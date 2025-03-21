<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ScheduleController extends Controller
{
    public function index()
    {
        return view("admin.schedules.index", [
            "schedules" => Schedule::all(),
        ]);
    }

    public function export()
    {
        $schedules = Schedule::all();
        $spreadsheet = new Spreadsheet();
        $asheet = $spreadsheet->getActiveSheet();
        $asheet->setCellValue("A1", "id");
        $asheet->setCellValue("B1", "start");
        $asheet->setCellValue("C1", "end");
        $asheet->setCellValue("D1", "friend_name");
        $asheet->setCellValue("E1", "friend_npm");
        $asheet->setCellValue("F1", "verification_code");
        $asheet->setCellValue("G1", "user_id");

        foreach($schedules as $key => $schedule) {
            $key += 2;
            $asheet->setCellValue("A".$key, $schedule->id);
            $asheet->setCellValue("B".$key, $schedule->start);
            $asheet->setCellValue("C".$key, $schedule->end);
            $asheet->setCellValue("D".$key, $schedule->friend_name);
            $asheet->setCellValue("E".$key, $schedule->friend_npm);
            $asheet->setCellValue("G".$key, $schedule->user_id);
            $asheet->setCellValue("F".$key, $schedule->verification_code);
        }

        $xlsx = new Xlsx($spreadsheet);
        $filename =  Storage::path("schedules-table");
        $xlsx->save($filename);
        return response()->download($filename)->deleteFileAfterSend();
    }

    public function create()
    {
        return view("admin.schedules.create");
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Schedule $schedule)
    {
        //
    }

    public function edit(Schedule $schedule)
    {
        //
    }

    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    public function destroy(Schedule $schedule)
    {
        Schedule::destroy($schedule->id);
        return redirect("schedules.index")->with("success", "Successfully deleting a schedules");
    }
}
