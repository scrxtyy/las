@extends('admin.admin')
@section('admin')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Approved</p>
                <h5 class="font-weight-bolder mb-0">
                  <?php 
                  $approvedApplications = App\Models\Leave_Application::where('status', 'APPROVED')->count();
                  ?>
                  {{ $approvedApplications}}
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                <i class="ni ni-watch-time text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending</p>
                <h5 class="font-weight-bolder mb-0">
                <?php 
                  $pendingApplications = App\Models\Leave_Application::where('status', 'PENDING')->count();
                  ?>
                  {{$pendingApplications}}
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                <i class="ni ni-fat-remove text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rejected</p>
                <h5 class="font-weight-bolder mb-0">
                <?php 
                  $rejectedApplications = App\Models\Leave_Application::where('status', 'REJECTED')->count();
                  ?>
                  {{$rejectedApplications}}
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-3">
                <div class="container">
                    <a href="{{route('admin.dashboard')}}" class="heading">Pending</a>
                    <a href="{{route('tickets.approved')}}" class="heading">Approved</a>
                    <a href="{{route('tickets.rejected')}}" class="heading active">Rejected</a>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Reference ID</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Total Days</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($rejects as $application)
                            <tr>
                                <td>{{ $application->referenceID }}</td>
                                <td>{{ $application->user->name }}{{ $application->user->empLastName }}</td>
                                <td>{{ $application->user->empDept }}</td>
                                <td>{{ $application->reason }}</td>
                                <td>{{ $application->from }}</td>
                                <td>{{ $application->to }}</td>
                                <td>
                                    <?php
                                    $from = \Carbon\Carbon::parse($application->from);
                                    $to = \Carbon\Carbon::parse($application->to);
                                    $totalDays = $from->diffInDays($to) + 1;
                                    echo $totalDays;
                                    ?>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
              {{$rejects->links()}}
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        background-color: #f7f7f7;
        padding: 10px;
    }

    .heading {
        display: inline-block;
        margin-right: 75px;
        background-color: #f2f2f2;
        padding: 8px 12px;
        cursor: pointer;
        text-decoration: none;
    }

    .heading.active {
        background-color: #fff;
        font-weight: bold;
    }
</style>
@endsection
