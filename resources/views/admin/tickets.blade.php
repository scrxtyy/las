@extends('admin.admin')
@section('admin')
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
                                <h5 class="ticket-title">Ticket #1</h5>
                            </div>
                            <div class="ticket-box-body">
                                <p>Employee: <b>{{$ticket->user->empLastName}}, {{$ticket->user->name}}</b></p>
                                <p>Department: <b>{{$ticket->user->empDept}}</b></p>
                                <p>From: <b>{{$ticket->from}}</b></p>
                                <p>To: <b>{{$ticket->to}}</b></p>
                                <label for="reason">Reason for Leave:</label>
                                <p id="reason">{{$ticket->reason}}</p>
                            </div>
                            <div class="ticket-actions">
                                    <button class="btn btn-success approve-btn">Approve</button>
                                    <button class="btn btn-danger reject-btn">Reject</button>
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
        text-align: right;
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

    .ticket-box-body {
        padding: 10px;
    }

    .ticket-title {
        margin: 0;
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
