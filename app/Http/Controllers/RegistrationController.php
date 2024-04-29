<?php

namespace App\Http\Controllers;

use App\DataTables\AthletesDataTable;
use App\Models\Athlete;
use App\Models\User;
use App\Rules\AlphNumCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use stdClass;

class RegistrationController extends Controller
{
    public function index()
    {
        $athlete = new Athlete();
        $title = 'Create Athlete';
        $url = url('/register');
        $data = compact('url', 'title', 'athlete');
        return view('form')->with($data);
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'title' => ['required', new AlphNumCheck],
            'date' => 'required|date',
            'link' => 'required|url',
            'register_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'join_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'level' => 'required',
            'coach_name' => 'required',
            'coach_description' => 'required|string',
            'coach_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'language' => 'required',
            'session_time' => 'required|date_format:H:i',
            'session_label' => 'required',
            'session_type' => 'required',
            'description' => 'required|string',
            'dos_and_donts' => 'nullable|string',
            'health_details' => 'nullable|string',
            'faqs' => 'nullable|string'
        ]);

        $file1 = Str::random(20) . '.' . $request->file('register_image')->getClientOriginalExtension();
        $request->file('register_image')->storeAs('public/uploads', $file1);

        $file2 = Str::random(20) . '.' . $request->file('join_image')->getClientOriginalExtension();
        $request->file('join_image')->storeAs('public/uploads', $file2);

        $file3 = Str::random(20) . '.' . $request->file('coach_image')->getClientOriginalExtension();
        $request->file('coach_image')->storeAs('public/uploads', $file3);

        try {
            $athlete = new Athlete();
            $athlete->title = $validateData['title'];
            $athlete->date = $validateData['date'];
            $athlete->link = $validateData['link'];
            $athlete->register_image = $file1;
            $athlete->join_image = $file2;
            $athlete->level = $validateData['level'];
            $athlete->coach_name = $validateData['coach_name'];
            $athlete->coach_description = $validateData['coach_description'];
            $athlete->coach_image = $file3;
            $athlete->language = $validateData['language'];
            $athlete->session_time = $validateData['session_time'];
            $athlete->session_label = $validateData['session_label'];
            $athlete->session_type = $validateData['session_type'];
            $athlete->description = $validateData['description'];
            $athlete->dos_and_donts = $validateData['dos_and_donts'];
            $athlete->health_details = $validateData['health_details'];
            $athlete->faqs = $validateData['faqs'];
            $athlete->save();
            return redirect('/athletes')->with('success', 'Successfully created Athlete');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving the data.');
        }
    }
    public function athletes(AthletesDataTable $dataTable)
    {
        //     $athletesWithStatus1 = Athlete::where('status', 1)->get();
        //     $athletesWithoutStatus1 = Athlete::where('status', '!=', 1)->get();
        //     $athlete = $athletesWithStatus1->merge($athletesWithoutStatus1);

        return $dataTable->render('athletes');

        // $athlete = Athlete::orderBy('id', 'desc')->get();
        // $data = compact('athlete');
        // return view('athletes')->with($data);
    }

    public function edit($id)
    {
        $athlete = Athlete::find($id);

        if (is_null($athlete)) {
            return redirect('/athletes');
        } else {
            $title = 'Update Athlete';
            $url = url('athletes/update') . '/' . $id;
            $data = compact('athlete', 'url', 'title');
            return view('form')->with($data);
        }
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'link' => 'required|url',
            'register_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:5120',
            'join_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:5120',
            'level' => 'required',
            'coach_name' => 'required',
            'coach_description' => 'required|string',
            'coach_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:5120',
            'language' => 'required',
            'session_time' => 'required|date_format:H:i',
            'session_label' => 'required',
            'session_type' => 'required',
            'description' => 'required|string',
            'dos_and_donts' => 'nullable|string',
            'health_details' => 'nullable|string',
            'faqs' => 'nullable|string'
        ]);

        if (isset($request['register_image'])) {
            $file1 = Str::random(20) . '.' . $request->file('register_image')->getClientOriginalExtension();
            $request->file('register_image')->storeAs('public/uploads', $file1);
        }

        if (isset($request['join_image'])) {
            $file2 = Str::random(20) . '.' . $request->file('join_image')->getClientOriginalExtension();
            $request->file('join_image')->storeAs('public/uploads', $file2);
        }

        if (isset($request['coach_image'])) {
            $file3 = Str::random(20) . '.' . $request->file('coach_image')->getClientOriginalExtension();
            $request->file('coach_image')->storeAs('public/uploads', $file3);
        }

        $athlete = Athlete::find($id);
        $athlete->title = $validateData['title'];
        $athlete->date = $validateData['date'];
        $athlete->link = $validateData['link'];
        if ($request['register_image']) {
            $athlete->register_image = $file1;
        }
        if ($request['join_image']) {
            $athlete->join_image = $file2;
        }
        $athlete->level = $validateData['level'];
        $athlete->coach_name = $validateData['coach_name'];
        $athlete->coach_description = $validateData['coach_description'];
        if ($request['coach_image']) {
            $athlete->coach_image = $file3;
        }
        $athlete->language = $validateData['language'];
        $athlete->session_time = $validateData['session_time'];
        $athlete->session_label = $validateData['session_label'];
        $athlete->session_type = $validateData['session_type'];
        $athlete->description = $validateData['description'];
        $athlete->dos_and_donts = $validateData['dos_and_donts'];
        $athlete->health_details = $validateData['health_details'];
        $athlete->faqs = $validateData['faqs'];
        $athlete->save();
        return redirect('/athletes')->with('success', 'Successfully Updated Athlete');
    }

    public function status($id)
    {
        $athlete = Athlete::find($id);
        if ($athlete->status == 0) {
            $athlete->status = 1;
        } else {
            $athlete->status = 0;
        }
        $athlete->save();
        return redirect('/athletes');
    }

    public function login()
    {
        return view('login');
    }

    public function signup()
    {
        return view('register');
    }

    public function createUser(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        ]);
        $user = new User();
        $user->email = $validate['email'];
        $user->password = $validate['password'];
        $user->save();
        $request->session()->put('user_name', $request['email']);
        return redirect('/athletes');
    }

    public function signin(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];
        $user = User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                // Password matches, authentication successful
                // echo "Authentication successful for user: " . $user->email;

                $request->session()->put('user_name', $request['email']);
                return redirect('/athletes');
            } else {
                // echo 'Failed';
                return redirect('/login')->withErrors(['failure' => 'Invalid Credentials']);
            }
        }
    }

    public function logout()
    {
        session()->forget('user_name');
        return redirect('/login');
    }
}
