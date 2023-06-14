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
          <a href="{{route('admin.dashboard')}}" class="heading active">Pending</a>
          <a href="{{route('tickets.approved')}}" class="heading">Approved</a>
          <a href="{{route('tickets.rejected')}}" class="heading">Rejected</a>
        </div>
        <div class="ticket-container">
          <div class="scroll-arrow left-arrow">
              <i class="fas fa-chevron-left"></i>
          </div>
          <div class="ticket-scroll-container">
            @foreach ($tickets as $ticket)
            <div class="ticket-box">
              <div class="ticket-box-header">
                <h6>{{$ticket->reason}}</h6>
              </div>
              <div class="ticket-box-body">
                <h6 class="employee-name"><b>{{ $ticket->user->name }} {{ $ticket->user->empLastName }}</b></h6>
                <h6 class="department">{{ $ticket->user->empDept }}</h6>
                <br>
                <p>Reference ID: {{$ticket->referenceID}}</p>
                <p>From: <b>{{ \Carbon\Carbon::parse($ticket->from)->format('F j') }}</b> &rarr; <b>{{ \Carbon\Carbon::parse($ticket->to)->format('F j') }}</b></p>
                <label for="reason">Reason for Leave:</label>
                <p id="reason">{{$ticket->reasonSpecified}}</p>
              </div>
              <div class="ticket-actions">
                <div class="button-group">
                    <form action="{{ route('tickets.approve', ['id' => $ticket->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success approve-btn">Approve</button>
                    </form>
                    <form action="{{ route('tickets.delete', ['id' => $ticket->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger reject-btn">Reject</button>
                    </form>
                </div>
            </div>
            </div>
            @endforeach
            <div class="scroll-arrow right-arrow">
              <i class="fas fa-chevron-right"></i>
            </div>
          </div>
        </div>
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
    .ticket-actions {
    margin-top: 10px;
    text-align: center;
    }

    .ticket-container {
      position: relative;
    }

    .scroll-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: #fff;
      padding: 5px;
      border-radius: 50%;
      cursor: pointer;
      z-index: 1;
      transition: background-color 0.3s;
    }

    .scroll-arrow.left-arrow {
      left: 10px;
    }

    .scroll-arrow.right-arrow {
      right: 10px;
    }

    .ticket-scroll-container {
      overflow-x: auto;
      white-space: nowrap;
      margin-bottom: 20px;
    }

    .ticket-box {
      display: inline-block;
      width: 300px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-right: 10px;
      vertical-align: top;
    }

    .ticket-box-header {
      padding: 10px;
      background-color: #ffc107;
      border-bottom: 1px solid #ccc;
    }

    .ticket-box-header h6 {
      margin: 0;
      font-family: Arial, sans-serif;
      font-weight: bold;
      text-align: center;
    }

    .ticket-box-body {
      padding: 10px;
    }

    .ticket-box-body h6.employee-name {
      margin: 0;
      font-family: Arial, sans-serif;
      font-weight: bold;
      font-size: 18px;
      text-align: center;
    }

    .ticket-box-body h6.department {
      margin: 0;
      font-family: Arial, sans-serif;
      font-size: 14px;
      font-weight: 300;
      text-align: center;
    }

    .ticket-status {
      float: right;
      padding: 2px 6px;
      font-size: 12px;
      background-color: #ffc107;
      color: #fff;
      border-radius: 3px;
    }

    /* Hide the scrollbar */
    ::-webkit-scrollbar {
      width: 0.5em;
      height: 6px;
    }

    ::-webkit-scrollbar-thumb {
      background-color: rgba(0, 0, 0, 0.3);
      border-radius: 3px;
    }

    ::-webkit-scrollbar-track {
      background: transparent;
    }

</style>
<script>
    function smoothScroll(scrollContainer, direction) {
        const distance = direction === 'left' ? -300 : 300;
        const duration = 300; // Animation duration in milliseconds
        const start = scrollContainer.scrollLeft;
        const startTime = performance.now();

        function step(timestamp) {
            const currentTime = timestamp || performance.now();
            const elapsed = currentTime - startTime;
            const ease = easeOutCubic(elapsed / duration);
            scrollContainer.scrollLeft = start + distance * ease;

            if (elapsed < duration) {
                window.requestAnimationFrame(step);
            }
        }

        // Easing function
        function easeOutCubic(t) {
            t--;
            return t * t * t + 1;
        }

        window.requestAnimationFrame(step);
    }

    document.querySelector('.left-arrow').addEventListener('click', function () {
        const ticketScrollContainer = document.querySelector('.ticket-scroll-container');
        smoothScroll(ticketScrollContainer, 'left');
    });

    document.querySelector('.right-arrow').addEventListener('click', function () {
        const ticketScrollContainer = document.querySelector('.ticket-scroll-container');
        smoothScroll(ticketScrollContainer, 'right');
    });
    
</script>
  @endsection