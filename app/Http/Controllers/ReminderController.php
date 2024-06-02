<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use Illuminate\Support\Facades\Auth;
use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'email' => 'required|email',
            'reminder_date' => 'required|date',
            'message' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            
        ]);
        

        // Create a new reminder with validated data
        // $reminder = new Reminder([
        //     'user_id' => Auth::id(),
        //     'email' => $validatedData['email'],
        //     'reminder_date' => $validatedData['reminder_date'],
        //     'message' => $validatedData['message'],
        //     'title' => $validatedData['title'],
        //     'description' => $validatedData['description'],
        //     'latitude' => $validatedData['latitude'],
        //     'longitude' => $validatedData['longitude'],
        // ]);

        // // Save the reminder to the database
        // $reminder->save();

        $reminder = Reminder::create($validatedData);

        // Send the reminder email
        Mail::to($reminder->email)->send(new ReminderMail($reminder));

        // Return a JSON response
        return response()->json(['success' => true, "message" => "Reminder set succesfully"], 201);

        // return response()->json($reminder, 201);
        
        

       

       

    }

    
}
/*class ReminderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'reminder_date' => 'required|date',
            'message' => 'required|string|max:255',
        ]);

        $reminder = new Reminder ([
            'user_id' => Auth::id(),
            'email' => $request->get('email'),
            'reminder_date' => $request->get('reminder_date'),
            'message' => $request->get('message'),
        ]);

        $reminder->save();

        return response()->json(['success' => 'Reminder set successfully'], 200);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
    
        $reminder = Reminder::create($validatedData);
    
        return response()->json($reminder, 201);

        
    }
}*/