<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{ __('Create New User') }}</h1>
                </div>
                <div class="card-body">
                    <!-- Success message -->
                    @if ($successMessage)
                        <div class="alert alert-success" wire:click="dismissSuccessMessage" role="alert">
                            {{ $successMessage }}
                        </div>
                        <script>
                            setTimeout(function() {
                                Livewire.emit('dismissSuccessMessage');
                            }, 5000);
                        </script>
                    @endif
                    <form wire:submit.prevent="store">
                        <div class="mb-3 row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input wire:model="name" id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input wire:model="email" id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input wire:model="password" id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password_confirmation"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input wire:model="password_confirmation" id="password_confirmation" type="password"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="role"
                                class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select wire:model="role" id="role"
                                    class="form-control @error('role') is-invalid @enderror" required>
                                    <option value="">Select</option>
                                    @foreach ($roles as $role)
                                        <option class="text-uppercase" value="{{ $role->name }}">{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    
@endpush
