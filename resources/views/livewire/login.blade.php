<div class="main form-signin w-100 m-auto">
    <form wire:submit.prevent="login">

        <h1 class="h3 my-3 fw-normal text-center">Already A Member</h1>

        <div class="form-floating my-2">
            <input type="email" class="form-control first" id="floatingInput" placeholder="name@example.com"
                wire:model="email">
            <label for="floatingInput">Email address</label>
        </div>
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror

        <div class="form-floating my-2">
            <input type="password" class="form-control last" id="floatingPassword" placeholder="Password"
                wire:model="password">
            <label for="floatingPassword">Password</label>
        </div>
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror

        <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault"
                wire:model="remember">
            <label class="form-check-label" for="flexCheckDefault">
                Remember me
            </label>
        </div>
        <button class="btn btn-primary btn-md d-block mx-auto my-3" type="submit">Login In</button>
        <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
    </form>
</div>
