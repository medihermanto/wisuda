<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Faculty;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMailNotify;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:registrations.index|registrations.create|registration.edit|registration.delete');
    }

    public function index()
    {

        $departements = Departement::findOrFail(auth()->user()->departement_id);
        $registrations = Registration::where('faculty_id', $departements->faculty_id)->when(request()->q, function ($registrations) {
            $registrations = $registrations->where('npm', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('admin.registration.index', compact('registrations'));
    }

    public function getDepartement($id)
    {
        $data = Departement::where('faculty_id', $id)->get();
        return response()->json($data);
    }

    public function getRegistrationByID(Registration $registration)
    {
        return view('admin.registration.show', compact('registration'));
    }

    public function create()
    {
        $faculties = Faculty::latest()->get();
        $departements = Departement::latest()->get();

        return view('admin.registration.create', compact('faculties', 'departements'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'photo_profile' => 'required|mimes:png,jpg|max:2048',
            'npm' => 'required',
            'fullname' => 'required',
            'user_id' => 'required',
            'faculty_id' => 'required',
            'departement_id' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:registrations',
            'email' => 'required|unique:registrations',
            'fathers_name' => 'required',
            'mothers_name' => 'required',
            'exam_value' => 'required',
            'exam_date' => 'required',
            'title' => 'required',
            'size_toga' => 'required',
            'photo_ijazah' => 'required|mimes:pdf|max:2048',
            'photo_ktp' => 'required|mimes:pdf|max:2048',
            'photo_payment' => 'required|mimes:pdf|max:2048',
        ]);

        $user = User::findOrFail($request->input('user_id'));

        $user->update([
            'departement_id' => $request->input('departement_id'),
        ]);

        $photo_profile = $request->file('photo_profile');
        $photo_ijazah = $request->file('photo_ijazah');
        $photo_ktp = $request->file('photo_ktp');
        $photo_payment = $request->file('photo_payment');

        $photo_profile_extension = $request->file('photo_profile')->getClientOriginalExtension();
        $photo_ijazah_extension = $request->file('photo_ijazah')->getClientOriginalExtension();
        $photo_ktp_extension = $request->file('photo_ktp')->getClientOriginalExtension();
        $photo_payment_extension = $request->file('photo_payment')->getClientOriginalExtension();

        $name_photo_profile = $request->input('npm') . '_photo_profile.' . $photo_profile_extension;
        $name_photo_ijazah = $request->input('npm') . '_photo_ijazah.' . $photo_ijazah_extension;
        $name_photo_ktp = $request->input('npm') . '_photo_ktp.' . $photo_ktp_extension;
        $name_photo_payment = $request->input('npm') . '_photo_payment.' . $photo_payment_extension;

        $photo_profile->storeAs('public/registrations', $name_photo_profile);
        $photo_ijazah->storeAs('public/registrations', $name_photo_ijazah);
        $photo_ktp->storeAs('public/registrations', $name_photo_ktp);
        $photo_payment->storeAs('public/registrations', $name_photo_payment);

        $registration = Registration::create([
            'photo_profile' => $name_photo_profile,
            'npm' => $request->input('npm'),
            'fullname' => $request->input('fullname'),
            'user_id' => $request->input('user_id'),
            'faculty_id' => $request->input('faculty_id'),
            'departement_id' => $request->input('departement_id'),
            'gender' => $request->input('gender'),
            'place_of_birth' => $request->input('place_of_birth'),
            'date_of_birth' => $request->input('date_of_birth'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'fathers_name' => $request->input('fathers_name'),
            'mothers_name' => $request->input('mothers_name'),
            'exam_value' => $request->input('exam_value'),
            'title' => $request->input('title'),
            'exam_date' => $request->input('exam_date'),
            'size_toga' => $request->input('size_toga'),
            'photo_ijazah' => $name_photo_ijazah,
            'photo_ktp' => $name_photo_ktp,
            'photo_payment' => $name_photo_payment,
        ]);

        $mailData = [
            'title' => 'Registrasi Wisuda Periode I Universitas HKBP Nommensen Medan',
            'body' => 'Terimakasih sudah melakukan pendaftaran Wisuda, berikut ini adalah informasi yang anda kirimkan',
            'npm' => $request->input('npm'),
            'email' => $request->input('email'),
            'fullname' => $request->input('fullname'),
        ];

        $sendEmail = Mail::to($request->input('email'))->send(new RegisterMailNotify($mailData));

        if ($registration && $user && $sendEmail) {
            return redirect()->route('admin.registration.index')->with(['success' => 'Pendaftaran wisuda berhasil dilakukan!']);
        } else {

            return redirect()->route('admin.registration.index')->with(['error' => 'Pendaftaran wisuda gagal dilakukan!']);
        }
    }

    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        Storage::disk('local')->delete('public/registrations/' . basename($registration->photo_profile));
        Storage::disk('local')->delete('public/registrations/' . basename($registration->photo_ijazah));
        Storage::disk('local')->delete('public/registrations/' . basename($registration->photo_ktp));
        Storage::disk('local')->delete('public/registrations/' . basename($registration->photo_payment));
        $registration->delete();
        if ($registration) {
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
        // dd($registration->user_id);
        // if ($registration) {
        //     $user_id = $registration->user_id;
        //     $user_id->update([
        //         'departement_id' => ''
        //     ]);
        //     if ($user_id) {
        //         $registration->delete();
        //         if ($registration) {
        //             return response()->json([
        //                 'status' => 'success',
        //             ]);
        //         } else {
        //             return response()->json([
        //                 'status' => 'error'
        //             ]);
        //         }
        //     }
        // }
    }
}
