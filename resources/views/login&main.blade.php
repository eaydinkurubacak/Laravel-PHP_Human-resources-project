
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Yinka Enoch Adedokun">
	<title>Login Page</title>

    <!-- link for custom css in public/css/... -->
    <!-- <link rel="stylesheet" href="{{asset('css/login.css')}}"> -->

    <!-- link for bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Datatables.net css files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <!-- Datatables.net js files -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Datatables.net js file for table functionality -->
    <script defer src="{{ asset('js/tables.js') }}"></script>

</head>
<body>

    @auth
        
    <!-- public folder altından image erişimi syntax -->
    <!-- <img src="{{ asset('storage/1690106737.png') }}" alt="MDN logo" /> -->


    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <!-- Companies table content -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <!-- Employees table content -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
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




        <div class="container">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Website</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr> 
                            <td>{{$company['name']}}</td>
                            <td>{{$company['address']}}</td>
                            <td>{{$company['phone']}}</td>
                            <td>{{$company['email']}}</td>
                            
                            <!-- You don't need to repeat the curly braces inside your first pair. -->
                            <td><img style="width: 50px; height: 50px;" class="rounded-circle" src="{{ asset('storage/'.$company['logo']) }}" alt="logo" /></td>

                            <td>{{$company['website']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="container my-5">
            <div class="row">
                <div class="col-6">
                    <form id="create-company-form" class="p-5 border border-3 border-dark rounded" style="background-image: url('https://www.tetraconsultants.com/wp-content/uploads/2023/03/pexels-illiyeen-7816540.jpg')" action="/create-company" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="CompanyName" class="form-label">Name</label>
                            <input name="company_name" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="CompanyAddress" class="form-label">Address</label>
                            <input name="company_address" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="CompanyPhone" class="form-label">Phone</label>
                            <input name="company_phone" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="CompanyEmail" class="form-label">Email</label>
                            <input name="company_email" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="CompanyLogo" class="form-label">Logo</label>
                            <input name="company_logo" type="file" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label for="CompanyWebsite" class="form-label">Website</label>
                            <input name="company_website" type="text" class="form-control">
                        </div>
                        <button class="btn btn-dark">Create Company</button>
                    </form>
                </div>
                <div class="col-6">
                    <form id="create-employee-form" class="p-5 border border-3 border-dark rounded" style="background-image: url('https://media.licdn.com/dms/image/C4D12AQGgSnBxyJeTtg/article-cover_image-shrink_720_1280/0/1563363640435?e=2147483647&v=beta&t=fjjeuELptV_DXSZ0okxtxPPvXM-ujHE2f__aglChCXA')" action="/create-company" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="EmployeeFirstName" class="form-label">First Name</label>
                            <input name="employee_firstname" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="EmployeeLastName" class="form-label">Last Name</label>
                            <input name="employee_lastname" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="EmployeeEmail" class="form-label">Email</label>
                            <input name="employee_email" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label for="EmployeePhone" class="form-label">Phone</label>
                            <input name="employee_phone" type="text" class="form-control">
                        </div>
                        <button class="btn btn-dark">Create Employee</button>
                    </form>
                </div>
            </div>
    
        </div>

    @else
        <div class="container">
            <div class="row my-5">
                <div class="card mx-auto my-5" style="max-width: 960px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://images.unsplash.com/photo-1566888596782-c7f41cc184c5?ixlib=rb-1.2.1&auto=format&fit=crop&w=2134&q=80" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title mb-5">Welcome</h5>
                                <form action="/login" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="InputEmail" class="form-label">Email address</label>
                                        <input name="login_email" type="text" class="form-control">
                                    </div>
                                    <div class="mb-5">
                                        <label for="InputPassword" class="form-label">Password</label>
                                        <input name="login_password" type="password" class="form-control">
                                    </div>
                                    <button class="btn btn-primary">Log in</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>






  


