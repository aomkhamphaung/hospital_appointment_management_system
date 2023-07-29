<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){
        if(Auth::id()){
            if(Auth::user()->usertype =='0'){
                $doctors = Doctor::all();
                return view('user.home', compact('doctors'));
            }else{
                return view('admin.home');
            }
        }
        else{
            return redirect()->back();
        }
    }

    public function index(){
        if(Auth::id()){
            return redirect('home');
        }else{
            $doctors = Doctor::all();
            return view('user.home', compact('doctors'));
        }        
    }

    public function appointment(Request $request){
        // dd($request->all());
        $appointment = new Appointment;
        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->date = $request->date;
        $appointment->doctor = $request->doctor;
        $appointment->message = $request->message;
        $appointment->status = 'In progress';
        if(Auth::id()){
            $appointment->user_id = Auth::user()->id;
        }
        $appointment->save();

        // dd($appointment);

        return redirect()->back()->with('message', 'Appointment request successful. We will contact you soon.');
    }

    public function myAppointment(){
        if(Auth::id()){
            $userid = Auth::user()->id;
            $appoints = DB::table('appointments')->where('user_id', $userid)->get();
            return view('user.myappointment', compact('appoints'));
        }else{
            return redirect()->back();
        }
    }

    public function cancelAppointment($id){
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->back();
    }
}
 