<?php

namespace App\Http\Controllers;

use App\Models\ContactLead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    function toleads()
    {
        $leads = ContactLead::orderby('id', "DESC")->paginate(20);

        return view('admin.leads.all_leads', compact('leads'));
    }

    function toleadsview($id)
    {
        $leads = ContactLead::find($id);
        if ($leads) {
            return view('admin.leads.edit_leads', compact('leads'));
        }
        return redirect()->back()->with('warning', 'Lead does Not Exist');
    }

    function toleadsdelete($id)
    {
        $leads = ContactLead::find($id);
        if ($leads) {
            $leads->delete();
            return redirect()->back()->with('success', 'Deleted Successfully');
        }
        return redirect()->back()->with('warning', 'Lead does Not Exist');
    }

    function toleadsupdate(Request $request)
    {
        $leads = ContactLead::find($request->id);
        $leads->contact_name = $request->contact_name;
        $leads->contact_email = $request->contact_email;
        $leads->contact_phone = $request->contact_phone;
        $leads->contact_subject = $request->contact_subject;
        $leads->admin_summery = $request->admin_summery;
        $leads->read_status = $request->read_status;
        $leads->status = $request->status;

        if ($leads) {
            $leads->save();
            return redirect()->back()->with('success', 'Update Successfully');
        }
        return redirect()->back()->with('warning', 'Lead does Not Exist');
    }
}
