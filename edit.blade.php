<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0">Edit Student: {{ $student->first_name }} {{ $student->last_name }}</h4>
                    </div>
                    <div class="card-body">

                        {{-- Action: students.update route para sa PUT/PATCH method. --}}
                        <form action="{{ route('students.update', $student) }}" method="POST">
                            @csrf
                            @method('PUT') 

                            {{-- Form Fields --}}
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" 
                                           value="{{ old('first_name', $student->first_name) }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" 
                                           value="{{ old('last_name', $student->last_name) }}" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" 
                                           value="{{ old('email', $student->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="contact_number" class="form-label">Contact Number (10 digits)</label>
                                    <input type="text" class="form-control @error('contact_number') is-invalid @enderror" id="contact_number" name="contact_number" 
                                           value="{{ old('contact_number', $student->contact_number) }}" required>
                                    @error('contact_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="college" class="form-label">College</label>
                                    <input type="text" class="form-control @error('college') is-invalid @enderror" id="college" name="college" 
                                           value="{{ old('college', $student->college) }}" required>
                                    @error('college')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="program" class="form-label">Program</label>
                                    <input type="text" class="form-control @error('program') is-invalid @enderror" id="program" name="program" 
                                           value="{{ old('program', $student->program) }}" required>
                                    @error('program')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel and Go Back</a>
                                <button type="submit" class="btn btn-warning">Update Record</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
