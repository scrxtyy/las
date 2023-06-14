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
                <i class="ni ni-tag text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Leaves Taken</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $totalLeavesTaken }} Day(s)
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
                <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">This Month</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $thisMonthLeaves }} Day(s)
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
                <i class="ni ni-sound-wave text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sick Leave(s)</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $sickLeaves }} Day(s)
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
                <i class="ni ni-glasses-2 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Vacation Leave(s)</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $vacationLeaves }} Day(s)
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <div class="row mt-4">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Leave Type</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Total Days</th>
                  <th>Status</th>
                  <th>Document</th>
                </tr>
              </thead>
              <tbody>
                @foreach($leavesAll as $leav)
                <tr>
                  <td>{{$leav->reason}}</td>
                  <td>{{$leav->from}}</td>
                  <td>{{$leav->to}}</td>
                  <?php
                    $from = Carbon\Carbon::parse($leav->from);
                    $to = Carbon\Carbon::parse($leav->to);
                    $diffInDays = $from->diffInDays($to);
                  ?>
                  <td>{{$diffInDays+1}}</td>
                  <td>
                  @if ($leav->status === 'APPROVED')
                      <span class="badge bg-success">Approved</span>
                  @elseif ($leav->status === 'PENDING')
                      <span class="badge bg-warning">Pending</span>
                  @elseif ($leav->status === 'REJECTED')
                      <span class="badge bg-danger">Rejected</span>
                  @else
                      <span class="badge">Unknown Status</span>
                  @endif
                  </td>
                  <td>
                  @if ($leav->status === 'APPROVED')
                      <a href="/preview/{{$leav->id}}" class="btn btn-primary">OPEN</a></td>
                  @endif
                  </tr>
                @endforeach
              </tbody>
              
            </table>
            
          </div>
          {{ $leavesAll->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .badge {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 12px;
  }

  .bg-success {
    background-color: #28a745;
    color: #fff;
  }

  .bg-warning {
    background-color: #ffc107;
    color: #000;
  }

  .bg-danger {
    background-color: #dc3545;
    color: #fff;
  }
</style>
@endsection
