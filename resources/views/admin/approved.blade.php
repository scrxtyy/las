@extends('admin.admin')
@section('admin')
<div class="py-4 container-fluid">
  <div class="row">
    <div class="mb-4 col-xl-3 col-sm-6 mb-xl-0">
      <div class="card">
        <div class="p-3 card-body">
          <div class="row">
            <div class="col-4 text-end">
              <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                <i class="text-lg ni ni-paper-diploma opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-8">
              <div class="numbers">
                <p class="mb-0 text-sm text-capitalize font-weight-bold">Approved</p>
                <h5 class="mb-0 font-weight-bolder">
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
    <div class="mb-4 col-xl-3 col-sm-6 mb-xl-0">
      <div class="card">
        <div class="p-3 card-body">
          <div class="row">
            <div class="col-4 text-end">
              <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                <i class="text-lg ni ni-watch-time opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-8">
              <div class="numbers">
                <p class="mb-0 text-sm text-capitalize font-weight-bold">Pending</p>
                <h5 class="mb-0 font-weight-bolder">
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
    <div class="mb-4 col-xl-3 col-sm-6 mb-xl-0">
      <div class="card">
        <div class="p-3 card-body">
          <div class="row">
            <div class="col-4 text-end">
              <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                <i class="text-lg ni ni-fat-remove opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-8">
              <div class="numbers">
                <p class="mb-0 text-sm text-capitalize font-weight-bold">Rejected</p>
                <h5 class="mb-0 font-weight-bolder">
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
            <div class="p-3 card-body">
                <div class="container">
                    <a href="{{route('admin.dashboard')}}" class="heading">Pending</a>
                    <a href="{{route('tickets.approved')}}" class="heading active">Approved</a>
                    <a href="{{route('tickets.rejected')}}" class="heading">Rejected</a>
                </div>
                <div class="mt-4 table-responsive">
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
                        @foreach ($approved as $application)
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
                {{$approved->links()}}
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
