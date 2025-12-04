@extends('master') {{-- Assuming you have a master.blade.php layout file --}}

@section('content')
<div class="container">
    <h2>User Registration</h2>

    {{-- Validation Error Display: Ito ang nagpapakita ng listahan ng errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf {{-- CRITICAL: Laravel security token --}}

        <div class="form-group">
            <label for="first_name">First Name</label>
            {{-- old() is important para hindi mabura ang input kapag nagka-error --}}
            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}">
            {{-- Error display per field --}}
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}">
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            {{-- Dapat 'password_confirmation' ang name para gumana ang 'confirmed' validation rule --}}
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
        </div>
        
        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ old('contact_number') }}">
            @error('contact_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="college">College</label>
            <input type="text" class="form-control" name="college" id="college" value="{{ old('college') }}">
            @error('college')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="program">Program</label>
            <input type="text" class="form-control" name="program" id="program" value="{{ old('program') }}">
            @error('program')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
