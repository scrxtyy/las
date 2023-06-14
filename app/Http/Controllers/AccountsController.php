<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use App\Models\User;
use Auth;
use App\Models\Leave_Application;
use Hash;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use TCPDF;

class AccountsController extends Controller
{
    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->route('users')->with('success', 'Employee deleted successfully');
    }
    public function approve(Request $request, $id)
    {
        $ticket = Leave_Application::find($id);
        if (!$ticket) {
            return back()->with('error', 'Ticket not found.');
        }
        $ticket->authorizedBy = Auth::user()->id; 
        $ticket->status = 'APPROVED';
        $ticket->save();
        return back()->with('success', 'Ticket approved successfully.');
    }

    public function delete(Request $request, $id)
    {
        $ticket = Leave_Application::find($id);

        if (!$ticket) {
            return back()->with('error', 'Ticket not found.');
        }
        $ticket->status = 'REJECTED';
        $ticket->save();
        return back()->with('success', 'Ticket rejected successfully.');
    }
    public function createUsers(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'empLastName' => $request->empLastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'empDept' => $request->empDept,
            'empStatus' => $request->empStatus,
            'usertype' => $request->usertype,
            'empID' => $request->empID,
        ]);
        if (!$user){
            return redirect()->route('users')->with('error', 'Sorry, there was a problem while creating the account.');
        }
        return redirect()->route('users')->with('success', 'Registered Successfully');
    }
    public function submitApply(Request $request)
    {
        $user = Leave_Application::create([
            'employeeID' => Auth::user()->id,
            'from' => $request->from_date,
            'to' => $request->to_date,
            'reason' => $request->reason,
            'status' => 'PENDING',
            'reasonSpecified' => $request->specify,
            'referenceID' => rand(1000000000000, 9999999999999),
        ]);
        if (!$user){
            return redirect()->route('employee.dashboard')->with('error', 'Sorry, there was a problem while creating the account.');
        }
        return redirect()->route('employee.dashboard')->with('success', 'Registered Successfully');
    }
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index')->with('users', $users);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('empID', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->get();

        return view('users.index', ['users' => $users]);
    }
    public function dashboard_employee()
    {
        $currentYear = Carbon::now()->year;

        $leavesAll = Leave_Application::where('employeeID', Auth::user()->id)
        ->whereYear('from', $currentYear)
        ->orderBy("created_at", "DESC")
        ->paginate(5);

        $leaves = Leave_Application::where('employeeID', Auth::user()->id)
        ->where('status', 'APPROVED')
        ->whereYear('from', $currentYear)
        ->orderBy("created_at", "DESC")
        ->get();

    $totalLeavesTaken = $leaves->sum(function ($leave) {
        $from = Carbon::parse($leave->from);
        $to = Carbon::parse($leave->to);
        return $to->diffInDays($from) + 1;
    });

    $thisMonthLeaves = $leaves->where('created_at', '>=', Carbon::now()->startOfMonth())->sum(function ($leave) {
        $from = Carbon::parse($leave->from);
        $to = Carbon::parse($leave->to);
        return $to->diffInDays($from) + 1;
    });

    $sickLeaves = $leaves->where('reason', 'Sick Leave')->sum(function ($leave) {
        $from = Carbon::parse($leave->from);
        $to = Carbon::parse($leave->to);
        return $to->diffInDays($from) + 1;
    });

    $vacationLeaves = $leaves->where('reason', 'Vacation Leave')->sum(function ($leave) {
        $from = Carbon::parse($leave->from);
        $to = Carbon::parse($leave->to);
        return $to->diffInDays($from) + 1;
    });

    return view('users.dashboard', [
        'leave' => $leaves,
        'leavesAll' => $leavesAll,
        'totalLeavesTaken' => $totalLeavesTaken,
        'thisMonthLeaves' => $thisMonthLeaves,
        'sickLeaves' => $sickLeaves,
        'vacationLeaves' => $vacationLeaves
    ]);
    }   
    public function approved()
    {
        $approved = Leave_Application::where('status', 'APPROVED')->paginate(5);
        return view('admin.approved')->with('approved', $approved);
    }
    public function rejects()
    {
        $rejects = Leave_Application::where('status', 'REJECTED')->paginate(5);
        return view('admin.rejects')->with('rejects', $rejects);
    }
    public function apply()
    {
        return view('users.leave');
    }
    public function preview($id)
    {
        $leave = Leave_Application::with('user')->where('status', 'APPROVED')->findOrFail($id);

        // Create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Leave Application Form');

        // Set default font and font size
        $pdf->SetFont('helvetica', '', 8);

        // Add a page
        $pdf->AddPage();

        // Set the content using TCPDF's methods
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'LEAVE APPLICATION FORM', 0, 1, 'C');
        $pdf->Ln(10);

        
        $pdf->Cell(40, 5, 'Reference ID:', 0, 0);
        $pdf->Cell(0, 5, $leave->referenceID, 0, 1);
        $pdf->Ln(10);
        // Name and Department
        $pdf->SetFont('helvetica', '', 8);
        $pdf->Cell(40, 5, 'Name:', 0, 0);
        $pdf->Cell(0, 5, $leave->user->name . ' ' . $leave->user->empLastName, 0, 1);
        $pdf->Cell(40, 5, 'Department:', 0, 0);
        $pdf->Cell(0, 5, $leave->user->empDept, 0, 1);
        $pdf->Cell(40, 5, 'Status:', 0, 0);
        $pdf->Cell(0, 5, $leave->user->empStatus, 0, 1);
        $pdf->Ln(5);

        // Status, From, and To
        $pdf->Cell(40, 5, 'From:', 0, 0);
        $pdf->Cell(0, 5, \Carbon\Carbon::parse($leave->from)->format('F j, Y') . ' - ' . \Carbon\Carbon::parse($leave->to)->format('F j, Y'), 0, 1);
        $pdf->Ln(5);

        // Type of Leave and Reason
        $pdf->Cell(40, 5, 'Type of Leave:', 0, 0);
        $pdf->Cell(0, 5, $leave->reason, 0, 1);
        $pdf->Cell(40, 5, 'Reason:', 0, 0);
        $pdf->MultiCell(0, 5, $leave->reasonSpecified, 0, 'L');
        $pdf->Ln(5);

        // Divider
        $pdf->Cell(0, 5, '--------------------------', 0, 1);
        $pdf->Ln(5);

        

        // History of Leaves
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(0, 5, 'History of Leaves:', 0, 1);
        $pdf->Ln(3);

        $currentYear = Carbon::now()->year;

        $userLeaves = Leave_Application::where('employeeID', $leave->user->id)
            ->where('status', 'APPROVED')
            ->whereIn('reason', ['Vacation Leave', 'Sick Leave'])
            ->whereYear('from', $currentYear)
            ->get();
        $vacationLeavesCount = $userLeaves->where('reason', 'Vacation Leave')->count();
        $sickLeavesCount = $userLeaves->where('reason', 'Sick Leave')->count();

        // Vacation Leaves
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->Cell(0, 5, 'Vacation Leaves', 0, 1);
        $pdf->SetFont('helvetica', '', 8);

        // Header Row
        $pdf->Cell(40, 5, 'Date', 1, 0, 'C');
        $pdf->Cell(40, 5, 'Number of Days', 1, 1, 'C');

        // Data Rows
        foreach ($userLeaves as $userLeave) {
            $toDate = Carbon::parse($userLeave->to);
            $fromDate = Carbon::parse($userLeave->from);
            $numberOfDays = $toDate->diffInDays($fromDate) + 1;
            if ($userLeave->reason == 'Vacation Leave') {
                $pdf->Cell(40, 5, $userLeave->from.' to '.$userLeave->to, 'LTRB', 0, 'C');
                $pdf->Cell(40, 5, $numberOfDays, 'LTRB', 1, 'C');
            }
        }

        $pdf->Ln(5);

        // Sick Leaves
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->Cell(0, 5, 'Sick Leaves', 0, 1);
        $pdf->SetFont('helvetica', '', 8);

        // Header Row
        $pdf->Cell(40, 5, 'Date', 1, 0, 'C');
        $pdf->Cell(40, 5, 'Number of Days', 1, 1, 'C');

        // Data Rows
        foreach ($userLeaves as $userLeave) {
            $toDate = Carbon::parse($userLeave->to);
            $fromDate = Carbon::parse($userLeave->from);
            $numberOfDays = $toDate->diffInDays($fromDate) + 1;
            if ($userLeave->reason == 'Sick Leave') {
                $pdf->Cell(40, 5, $userLeave->from.' to '.$userLeave->to, 'LTRB', 0, 'C');
                $pdf->Cell(40, 5, $numberOfDays, 'LTRB', 1, 'C');
            }
        }
        // Authorized by
        $userID = $leave->authorizedBy;
        $user = User::find($userID);
        $pdf->Ln(20);
        
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(40, 5, 'Authorized by:          ', 0, 0);
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 5, $user->name . ' ' . $user->empLastName, 0, 0);

        $pdf->Output('leave_application.pdf', 'I');
    }


}
