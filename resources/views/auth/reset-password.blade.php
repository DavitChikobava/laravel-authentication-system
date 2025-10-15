<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Reset Password</title>
</head>
<body>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-6 col-xl-5">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            
            <div class="text-center mb-4">
                <h1 class="fw-bold mb-0" style="font-size: 2.8rem;">
                    <span class="text-primary">new</span>
                    <span class="text-dark">password</span>
                </h1>
            </div>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request('email') }}">

                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="password" 
                            id="password" 
                            name="password" 
                            class="form-control form-control-lg py-3" 
                            placeholder="New password"
                            style="font-size: 1rem;"/>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="form-control form-control-lg py-3" 
                            placeholder="Confirm new password"
                            style="font-size: 1rem;"/>
                    </div>
                </div>

                <div class="d-flex flex-column align-items-center gap-3 my-4">
                    <button type="submit" 
                            class="btn btn-lg position-relative overflow-hidden w-75 py-3 text-white fw-semibold shadow-sm"
                            style="background: linear-gradient(45deg, #4e73df, #224abe); 
                                border: none; 
                                border-radius: 10px;
                                transition: all 0.3s ease;">
                        <span class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-save me-2"></i>
                            Reset Password
                        </span>
                    </button>
                </div>

                <style>
                .btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3) !important;
                }

                .btn:active {
                    transform: translateY(0);
                }
                </style>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>