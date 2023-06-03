
<div class="container">
    <main class="form-signin w-100 m-auto">
        <form wire:submit.prevent="register">
    
            <h1 class="h3 my-3 fw-normal text-center">Register</h1>
    
            <div class="form-floating my-2">
                <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror first"
                    id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Full Name</label>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="form-floating  my-2">
                <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror middle"
                    id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="form-floating  my-2">
                <input wire:model="password" type="password"
                    class="form-control @error('password') is-invalid @enderror middle" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="form-floating  my-2">
                <input wire:model="password_confirmation" type="password" class="form-control last" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Confirm Password</label>
            </div>
    
            <button class="btn btn-primary btn-md d-block mx-auto my-3" type="submit">Sign Up</button>
        </form>
        <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
    </main>
</div>
