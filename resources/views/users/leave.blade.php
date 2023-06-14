@extends('admin.admin')
@section('admin')
<div class="container">
  <h1>Leave Application</h1>
  <br>
  <form action="{{route('leaveCreate')}}" method="POST">
    @csrf
    <br>
    <h4>Leave Date</h4>
    <div class="form-row">  
      <label for="from_date">From:</label>
      <input type="date" id="from_date" name="from_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
      <label for="to_date">To:</label>
      <input type="date" id="to_date" name="to_date" disabled required>
    </div>
    <br>
    <div class="form-row">
      <label for="reason">Leave Type:</label>
      <select id="reason" name="reason" required>
        <option value="" disabled selected>Select a reason</option>
        <option value="Sick Leave">Sick Leave</option>
        <option value="Vacation Leave">Vacation Leave</option>
        <option value="Maternity Leave">Maternity Leave</option>
        <option value="Paternity Leave">Paternity Leave</option>
        <option value="Leave for VAWC">Leave for VAWC*</option>
        <option value="Special Leave Women">Special Leave Women</option>
        <option value="Parental Leave for Solo Parents">Parental Leave for Solo Parents</option>
        <option value="other">Others(Please Specify)</option>
      </select>
      <div class="form-row" id="other_reason_container" style="display: none;">
        <label for="other_reason">Other Reason:</label>
        <input type="text" id="other_reason" name="other_reason">
      </div>
      <br>
    </div>
    <div class="form-row" id="reasonSpecify_container">
        <textarea name="specify" id="specify" cols="100" rows="5" placeholder="Reason for Leave"></textarea>
    </div>
    <br>
    <button type="submit">Submit</button>
    <br><br>
  </form>
</div>
<style>
.container {
  background-color: #f7f7f7;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
}

input[type="text"],
input[type="date"],
select {
  width: 100%;
  padding: 8px;
  margin-bottom: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

select {
  appearance: none;
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="5" viewBox="0 0 10 5"><path fill="%23444444" d="M5 5L0.262865 0.762865L9.73716 0.762865L5 5Z"/></svg>');
  background-repeat: no-repeat;
  background-position: right 8px center;
  padding-right: 30px;
}

.form-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.form-row label {
  margin-right: 8px;
}

.form-row input[type="text"],
.form-row input[type="date"] {
  flex: 1;
  margin-right: 8px;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
</style>
<script>
  const reasonSelect = document.getElementById('reason');
  const otherReasonContainer = document.getElementById('other_reason_container');
  const otherReasonInput = document.getElementById('other_reason');
  const fromDateInput = document.getElementById('from_date');
  const toDateInput = document.getElementById('to_date');

  reasonSelect.addEventListener('change', function() {
    if (this.value === 'other') {
      otherReasonContainer.style.display = 'block';
      otherReasonInput.required = true;
    } else {
      otherReasonContainer.style.display = 'none';
      otherReasonInput.required = false;
    }
  });

  fromDateInput.addEventListener('change', function() {
    if (this.value) {
      toDateInput.disabled = false;
      toDateInput.min = this.value;
    } else {
      toDateInput.disabled = true;
      toDateInput.min = '';
    }
  });
</script>
@endsection
