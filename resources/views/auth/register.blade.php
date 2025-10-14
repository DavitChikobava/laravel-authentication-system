<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>

                <form class="mx-1 mx-md-4" action="{{ route('register.post') }}" method="POST">
                @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="text" id="name" name="name" class="form-control" 
                                  placeholder="Name" value="{{ old('name') }}"/>
                            @error("name")
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="text" id="surname" name="surname" class="form-control" 
                                  placeholder="Surname" value="{{ old('surname') }}"/>
                            @error("surname")
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="text" id="phone" name="phone" class="form-control" 
                                  placeholder="Phone Number" value="{{ old('phone') }}"/>
                            @error("phone")
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="email" id="email" name="email" class="form-control" 
                                  placeholder="Email" value="{{ old('email') }}"/>
                            @error("email")
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="password" id="password" name="password" class="form-control" 
                                  placeholder="Password"/>
                            @error("password")
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                  class="form-control" placeholder="Confirm Password"/>
                            @error("password_confirmation")
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init 
                                class="btn btn-primary btn-lg">Register</button>
                    </div>
                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-6 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>