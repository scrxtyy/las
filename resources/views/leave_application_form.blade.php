<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .form-heading {
            font-size: 24px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            margin-right: 10px;
            width: 100px;
        }

        .form-text {
            padding: 3px 5px;
            display: inline-block;
            font-weight: normal;
        }

        .form-divider {
            margin-top: 10px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .form-textarea {
            border: 1px solid black;
            width: 100%;
            resize: vertical;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-heading">LEAVE APPLICATION FORM</div>
        <div class="form-section">
            <div class="form-row">
                <div class="form-label">Name:</div>
                <div class="form-text">{{ $leave->user->name }} {{ $leave->user->empLastName }}</div>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <div class="form-label">Department:</div>
                <div class="form-text">{{ $leave->user->empDept }}</div>
            </div>
        </div>
        <div class="form-section">
            <div class="form-row">
                <div class="form-label">Status:</div>
                <div class="form-text">
                    @if ($leave->status === 'APPROVED')
                        Approved
                    @elseif ($leave->status === 'PENDING')
                        Pending
                    @elseif ($leave->status === 'REJECTED')
                        Rejected
                    @else
                        <span class="badge">Unknown Status</span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-label">From:</div>
                <div class="form-text">{{ \Carbon\Carbon::parse($leave->from)->format('F j, Y') }}</div>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <div class="form-label">To:</div>
                <div class="form-text">{{ \Carbon\Carbon::parse($leave->to)->format('F j, Y') }}</div>
            </div>
        </div>
        <div class="form-section">
            <div class="form-row">
                <div class="form-label">Type of Leave:</div>
                <div class="form-text">{{ $leave->reason }}</div>
            </div>
            <div class="form-row">
                <div class="form-label">Reason:</div>
                <div class="form-textarea">{{ $leave->reasonSpecified }}</div>
            </div>
            <div class="form-divider">--------------------------</div>
            <div class="form-row">
                <div class="form-textarea"></div>
            </div>
        </div>
        <div class="form-section">
            <div class="form-row">
                <div class="form-label">Authorized by:</div>
                <div class="form-text"></div>
            </div>
        </div>
        <div class="form-section">
            <div class="form-heading">History of Leaves:</div>
            <div class="form-row">
                <div class="form-label">Vacation Leaves</div>
            </div>
            @php
                $userLeaves = \App\Models\Leave_Application::where('employeeID', $leave->user->id)
                    ->where('status', 'APPROVED')
                    ->whereIn('reason', ['Vacation Leave', 'Sick Leave'])
                    ->get();
                $vacationLeavesCount = $userLeaves->where('reason', 'Vacation Leave')->count();
                $sickLeavesCount = $userLeaves->where('reason', 'Sick Leave')->count();
            @endphp
            <div class="form-row">
                <div class="form-label">Date:</div>
                <div class="form-text"></div>
                <div class="form-label">Number of Days:</div>
                <div class="form-text">{{ $vacationLeavesCount }}</div>
            </div>
            <div class="form-row">
                <div class="form-label">Sick Leaves</div>
            </div>
            <div class="form-row">
                <div class="form-label">Date:</div>
                <div class="form-text"></div>
                <div class="form-label">Number of Days:</div>
                <div class="form-text">{{ $sickLeavesCount }}</div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
