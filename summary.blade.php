<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Student Summary Table</h2>
            {{-- 
                * FIXED: Ginamit na ang tamang route name na 'register.form' mula sa web.php.
                * Wala na itong 'Missing parameter' error dahil hindi ito students.edit/destroy. 
            --}}
            <a href="{{ route('register.form') }}" class="btn btn-primary">
                + Register New Student
            </a>
        </div>

        {{-- Session Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>College</th>
                        <th>Program</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Gumagamit ng @forelse para awtomatikong mag-handle ng walang records --}}
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->contact_number }}</td>
                            <td>{{ $student->college }}</td>
                            <td>{{ $student->program }}</td>
                            
                            {{-- Action Buttons (Ito ay NASA LOOB ng loop, kaya may $student) --}}
                            <td>
                                {{-- EDIT Button: Gumagamit ng $student object --}}
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                {{-- DELETE Form: Gumagamit ng $student object --}}
                                <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete {{ $student->first_name }} {{ $student->last_name }}?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        {{-- Lalabas kung walang laman ang $students collection --}}
                        <tr>
                            <td colspan="8" class="text-center text-muted p-4">
                                <h3>🤷‍♂️ No Student Records Found.</h3>
                                <p>Please use the "Register New Student" button above to add a record.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
