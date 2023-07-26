<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <!-- link for bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar navbar-expand-lg navbar-dark bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">    
                        <!-- Companies table content -->
                        <li class="nav-item">
                            <a class="nav-link" href="/#company_records">Companies</a>
                        </li>
                        <!-- Employees table content -->
                        <li class="nav-item">
                            <a class="nav-link" href="/#employee_records">Employees</a>
                        </li>
                </ul>
                <a class="btn btn-outline-success me-2" href="/#create-company-form">+Company</a>
                <a class="btn btn-outline-success me-2" href="/#create-employee-form">+Employee</a>
                <form class="my-2" action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger">Log out</button>
                </form>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row my-5">
                <div class="card mx-auto my-5 bg-light border border-dark" style="max-width: 768px;">
                    <div class="row g-0">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-center">Update Employee Info</h5>

                            <form id="update-employee-form" class="mx-auto p-5 rounded" action="/edit-employee/{{$employee->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="EmployeeFirstName" class="form-label">First Name</label>
                                    <input name="employee_firstname" type="text" class="form-control" value="{{$employee->first_name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="EmployeeLastName" class="form-label">Last Name</label>
                                    <input name="employee_lastname" type="text" class="form-control" value="{{$employee->last_name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="EmployeeEmail" class="form-label">Email</label>
                                    <input name="employee_email" type="text" class="form-control" value="{{$employee->email}}">
                                </div>
                                <div class="mb-5">
                                    <label for="EmployeePhone" class="form-label">Phone</label>
                                    <input name="employee_phone" type="text" class="form-control" value="{{$employee->phone}}">
                                </div>
                                <button class="btn btn-dark">Update</button>
                            </form>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- scripts for bootstrap 5 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    </body>
</html>