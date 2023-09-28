<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="https://github.githubassets.com/favicon.png">
  <title>GitHub Login</title>
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f6f8fa;
    }

    .container {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      max-width: 400px;
      padding: 2rem;
    }

    .card-header {
      border-bottom: none;
      padding-bottom: 0;
    }

    .card-body {
      padding-top: 1rem;
    }

    .form-control {
      border-color: #e1e4e8;
      padding: 0.75rem;
    }

    .btn {
      color: #fff;
      background-color: #28a745;
      border-color: #28a745;
      padding: 0.75rem 1.5rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header text-left">
        <h3 class="font-weight-bolder">Welcome Back!</h3>
        <p class="mb-0">Enter your email and password to sign in</p>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Email" id="email" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input name="password" type="password" class="form-control" placeholder="Password" id="password" required>
          </div>
          <button type="submit" class="btn btn-block">Sign in</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>