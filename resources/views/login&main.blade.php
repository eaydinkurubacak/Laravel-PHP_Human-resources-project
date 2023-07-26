<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Yinka Enoch Adedokun">
        <title>Login Page</title>
    
        <!-- link for custom css file in public/css/login.css -->
        <link rel="stylesheet" href="{{asset('css/login.css')}}">
        
        <!-- link for bootstrap icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
        <!-- link for bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
        <!-- link for Datatables.net css files (Design lines / Previous-next button placement) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
        
        <!-- scripts for Datatables.net js files (Functionality lines / Previous,search options) -->
        <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    
        <!-- Datatables.net js file for companies and employees tables initialization -->
        <script defer src="{{ asset('js/tables.js') }}"></script> 
    </head>
    <body>
        @auth
            <!-- navbar -->
            <nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">Home</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <!-- link for companies table records -->
                            <li class="nav-item">
                                <a class="nav-link" href="#company_records">Companies</a>
                            </li>
                            <!-- link for employees table records -->
                            <li class="nav-item">
                                <a class="nav-link" href="#employee_records">Employees</a>
                            </li>
                        </ul>
                        <a class="btn btn-outline-success me-2" href="#create-company-form">+Company</a>
                        <a class="btn btn-outline-success me-2" href="#create-employee-form">+Employee</a>
                        <form class="my-2" action="/logout" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger">Log out</button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- companies table records -->
            <div class="container my-3">
                <h3>Companies</h3>
                <table id="company_records" class="table table-striped border border-dark" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Logo</th>
                            <th>Website</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr> 
                                <td>{{$company['name']}}</td>
                                <td>
                                    <a class="my-2 btn btn-outline-dark" href="https://www.google.com/maps/search/{{$company->address}}" target="_blank">
                                        <i class="bi bi-geo-alt"></i>
                                    </a>
                                </td>
                                <td>{{$company['phone']}}</td>
                                <td>{{$company['email']}}</td>             
                                <td><img style="width: 50px; height: 50px;" class="rounded-circle" src="{{ asset('storage/'.$company['logo']) }}" alt="logo" /></td>
                                <td>
                                    <a class="my-2 btn btn-outline-dark" href="{{$company['website']}}">
                                        <i class="bi bi-globe"></i>
                                    </a>
                                </td>
                                <td>
                                    <div class="col-6">
                                        <a class="my-2 btn btn-outline-success" href="/edit-company/{{$company->id}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-6">
                                        <form class="my-2" action="/delete-company/{{$company->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr class="bg-dark" />
            
            <!-- employees table records -->
            <div class="container my-3">
                <h3>Employees</h3>
                <table id="employee_records" class="table table-striped border border-dark" style="width:100%">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr> 
                                <td>{{$employee['first_name']}}</td>
                                <td>{{$employee['last_name']}}</td>
                                <td>{{$employee['email']}}</td>
                                <td>{{$employee['phone']}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-3">
                                            <img style="width: 50px; height: 50px;" class="rounded-circle" src="{{ asset('storage/'.$employee->company->logo) }}" alt="logo" />
                                        </div>
                                        <div class="col-9">
                                            {{ $employee->company->name }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-6">
                                        <a class="my-2 btn btn-outline-success" href="/edit-employee/{{$employee->id}}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-6">
                                        <form class="my-2" action="/delete-employee/{{$employee->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr class="bg-dark" />

            <!-- create company and employee forms -->
            <div class="container my-3">
                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-3">Create New Company</h3>
                        <form id="create-company-form" class="p-5 border border-3 border-dark rounded" action="/create-company" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="CompanyName" class="form-label">Name</label>
                                <input name="company_name" type="text" class="form-control">
                            </div>
                            @error('company_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                            <div class="mb-3">
                                <label for="CompanyAddress" class="form-label">Address</label>
                                <input name="company_address" type="text" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="CompanyPhone" class="form-label">Phone</label>
                                <input name="company_phone" type="text" class="form-control">
                            </div>
                            @error('company_phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="CompanyEmail" class="form-label">Email</label>
                                <input name="company_email" type="text" class="form-control">
                            </div>
                            @error('company_email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="CompanyLogo" class="form-label">Logo</label>
                                <input name="company_logo" type="file" class="form-control">
                            </div>
                            @error('company_logo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="CompanyWebsite" class="form-label">Website</label>
                                <input name="company_website" type="text" class="form-control">
                            </div>
                            <button class="btn btn-dark">Create</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <h3 class="mb-3">Create New Employee</h3>
                        <form id="create-employee-form" class="p-5 border border-3 border-dark rounded" action="/create-employee" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="btn-group dropend">
                                    <button type="button" class="btn btn-md btn-dark dropdown-toggle" style="min-width: 315px" data-bs-toggle="dropdown">
                                        Select Company to Add New Employee
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach ($companies as $company)
                                            <li>
                                                <a class="dropdown-item" data-value="{{$company['id']}}">
                                                    <div class="row">
                                                        <!-- company logo -->
                                                        <div class="col-3">  
                                                            <img style="width: 35px; height: 35px;" class="rounded-circle" src="{{ asset('storage/'.$company['logo']) }}" alt="logo" />     
                                                        </div>
                                                        <!-- company name -->
                                                        <div class="col-9">
                                                            {{$company['name']}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <input type="hidden" name="selected_company" id="selected_company" value="">
                                </div>                                                   
                            </div>
                            @error('selected_company')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="EmployeeFirstName" class="form-label">First Name</label>
                                <input name="employee_firstname" type="text" class="form-control">
                            </div>
                            @error('employee_firstname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="EmployeeLastName" class="form-label">Last Name</label>
                                <input name="employee_lastname" type="text" class="form-control">
                            </div>
                            @error('employee_lastname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="EmployeeEmail" class="form-label">Email</label>
                                <input name="employee_email" type="text" class="form-control">
                            </div>
                            @error('employee_email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="EmployeePhone" class="form-label">Phone</label>
                                <input name="employee_phone" type="text" class="form-control">
                            </div>
                            @error('employee_phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <button class="btn btn-dark">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <section>
                <div class="form-box">
                    <div class="form-value">
                        <form action="/login" method="POST">
                            @csrf
                            <h2>Login</h2>
                            <div class="inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input name="login_email" type="text" placeholder="Email">
                            </div>
                            <div class="inputbox">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                                <input name="login_password" type="password" placeholder="Password">
                            </div>
                            <button>Log in</button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- scripts for login page -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        @endauth

            <!-- scripts for bootstrap 5 -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

            <!-- scripts for dropdown menu in employees table records -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('.dropdown-menu').on('click', 'a', function() {
                        var selectedValue = $(this).data('value');
                        $('#selected_company').val(selectedValue);
                        $('.dropdown-toggle').text($(this).text());
                    });
                });
            </script>
    </body>
</html>