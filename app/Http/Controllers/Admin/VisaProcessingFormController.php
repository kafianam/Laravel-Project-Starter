<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaProcessingForm;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisaProcessingFormController extends Controller
{
    public function index()
    {
        $forms = VisaProcessingForm::with('service')->latest()->get();
        return view('visa_processing.index', compact('forms'));
    }

    public function create()
    {
        $services = Service::all();
        return view('visa_processing.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['passport_copy', 'ticket_copy', 'hotel_booking', 'other_doc']);
    
        // Handle files
        if ($request->hasFile('passport_copy')) {
            $data['passport_copy'] = $request->file('passport_copy')->store('documents', 'public');
        }
        if ($request->hasFile('ticket_copy')) {
            $data['ticket_copy'] = $request->file('ticket_copy')->store('documents', 'public');
        }
        if ($request->hasFile('hotel_booking')) {
            $data['hotel_booking'] = $request->file('hotel_booking')->store('documents', 'public');
        }
        if ($request->hasFile('other_doc')) {
            $data['other_doc'] = $request->file('other_doc')->store('documents', 'public');
        }
    
        // Handle advance_purchase checkboxes
        $data['advance_purchase'] = $request->input('advance_purchase', []);
    
        VisaProcessingForm::create($data);
    
        return redirect()->route('visa_processing.index')->with('success', 'Visa form submitted successfully.');
    }
    

    public function show($id)
    {
        $visaProcessingForm = VisaProcessingForm::findOrFail($id);
        
        return view('visa_processing.show', compact('visaProcessingForm'));
    }
    

    public function edit(VisaProcessingForm $visa_processing)
    {
        $services = Service::all();
        return view('visa_processing.edit', compact('visa_processing', 'services'));
    }

    public function update(Request $request, VisaProcessingForm $visa_processing)
    {
        $data = $request->all();

        // Update only if new files uploaded
        if ($request->hasFile('passport_copy')) {
            $data['passport_copy'] = $request->file('passport_copy')->store('files');
        }

        if ($request->hasFile('ticket_copy')) {
            $data['ticket_copy'] = $request->file('ticket_copy')->store('files');
        }

        if ($request->hasFile('hotel_booking')) {
            $data['hotel_booking'] = $request->file('hotel_booking')->store('files');
        }

        if ($request->hasFile('other_doc')) {
            $data['other_doc'] = $request->file('other_doc')->store('files');
        }

        $data['advance_purchase'] = $request->input('advance_purchase');

        $visa_processing->update($data);

        return redirect()->route('visa_processing.index')->with('success', 'Form updated successfully.');
    }

    public function destroy(VisaProcessingForm $visa_processing)
    {
        $visa_processing->delete();
        return redirect()->route('visa_processing.index')->with('success', 'Form deleted successfully.');
    }
}
