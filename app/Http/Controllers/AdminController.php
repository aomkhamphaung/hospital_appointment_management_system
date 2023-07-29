<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.add_doctor');
    }

    public function upload(Request $request)
    {
        $doctor = new Doctor();
        $image = $request->file;
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $request->file->move('doctorimage', $image_name);

        $doctor->image = $image_name;
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->room = $request->room;
        $doctor->speciality = $request->speciality;
        $doctor->save();

        return redirect()->back()->with('message:', 'Doctor added successfully!');
    }

    public function showAppointments()
    {
        $datas = Appointment::all();
        return view('admin.show_appointments', compact('datas'));
    }

    public function approve($id)
    {
        $data = Appointment::find($id);
        $data->status = 'approved';
        $data->save();
        return redirect()->back();
    }

    public function cancel($id)
    {
        $data = Appointment::find($id);
        $data->status = 'canceled';
        $data->save();
        return redirect()->back();
    }

    public function showDoctors()
    {
        $doctors = Doctor::all();
        return view('admin.show_doctors', compact('doctors'));
    }

    public function deleteDoctor($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect()->back();
    }

    public function updateDoctor($id)
    {
        $data = Doctor::find($id);
        return view('admin.edit_doctor', compact('data'));
    }

    public function editDoctor(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->speciality = $request->speciality;
        $doctor->room = $request->room;
        $image = $request->file;
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $request->file->move('doctorimage', $image_name);
            $doctor->image = $image_name;
        }

        $doctor->save();

        return redirect()->back()->with('message', 'Doctor updated successfully!');
    }
}
