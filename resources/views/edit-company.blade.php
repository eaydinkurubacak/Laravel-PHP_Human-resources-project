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
                <div class="card mx-auto my-5 bg-light border border-dark border-3 rounded" style="max-width: 768px;">
                    <h2 class="text-center my-3">Update Company Info</h2>
                    <div class="row">
                        <div class="row mb-3 justify-content-center">
                            <img style="width: 192px; height: 192px;" src="{{ asset('storage/'.$company['logo']) }}" class="card-img-top rounded-circle" alt="logo">
                        </div>
                        <div class="row text-center">
                            <h3 class="mx-auto">{{$company['name']}}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-body">
                            <form id="update-company-form" class="mx-auto px-5 rounded" action="/edit-company/{{$company->id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="CompanyName" class="form-label">Name</label>
                                    <input name="company_name" type="text" class="form-control" value="{{$company->name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="CompanyAddress" class="form-label">Address</label>
                                    <input name="company_address" type="text" class="form-control" value="{{$company->address}}">
                                </div>
                                <div class="mb-3">
                                    <label for="CompanyPhone" class="form-label">Phone</label>
                                    <input name="company_phone" type="text" class="form-control" value="{{$company->phone}}">
                                </div>
                                <div class="mb-3">
                                    <label for="CompanyEmail" class="form-label">Email</label>
                                    <input name="company_email" type="text" class="form-control" value="{{$company->email}}">
                                </div>
                                <div class="mb-3">
                                    <label for="CompanyLogo" class="form-label">Logo</label>
                                    <input name="company_logo" type="file" class="form-control">
                                </div>
                                <div class="mb-5">
                                    <label for="CompanyWebsite" class="form-label">Website</label>
                                    <input name="company_website" type="text" class="form-control" value="{{$company->website}}">
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