<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use Modules\Admin\Models\ContactUs;
use Modules\Admin\Models\Touch;
use Modules\Admin\Models\Complaint;


class ContactUsController extends Controller
{



    /**
     * Show the ContactUs Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getContactUs()
    {
        // Get Touch
        // return "dfd";
        $touch = Touch::latest()->first();
        $mainPageTitle = 'contactus' ;
        return view('front.contactUs', compact('touch','mainPageTitle'));
    }

    /**
     * Show the ContactUs Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function postContactUs(Request $request)
    {
        // Validate Form
        $this->validateContactUs($request);

        // Create New Row
        ContactUs::create($request->all());

        return redirect()->route('contactUs')->with('status', __('lang.contactUsDone'));

    }

    /**
     * Show the Complaint Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getComplaint()
    {
        return view('front.complaints');
    }


    /**
     * Show the Complaint Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSuggest()
    {
        return view('front.complaints');
    }


    /**
     * Show the ContactUs Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function postComplaintSuggest(Request $request)
    {
        // Validate Form
        $this->validateComplaint($request);

        // Create New Row
        Complaint::create($request->all());

        if ($request->complaints_type == '0') {

            return redirect()->route('complaint')->with('status', __('lang.contactUsDone'));

        } else {

            return redirect()->route('suggest')->with('status', __('lang.contactUsDone'));
        }



    }

    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateContactUs(Request $request)
    {
        Validator::make($request->all(), [
            'contact_us_name' => 'required|string|max:100',
            'contact_us_email' => 'required|email|max:100',
            'contact_us_phone' => 'required|max:100',
            'contact_us_text' => 'required|string',
        ])->validate();
    }


    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateComplaint(Request $request)
    {
        Validator::make($request->all(), [
            'complaints_name' => 'required|string|max:100',
            'complaints_email' => 'required|email|max:100',
            'complaints_type' => 'required|numeric',
            'complaints_message' => 'required|string',
        ])->validate();
    }



}
