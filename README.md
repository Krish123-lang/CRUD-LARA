1. <u>php artisan make:model Student -mcr</u>\
    -Model\
    -Migration\
    -Controller

2. <u> create_students_table.php </u>\
    $table->string('firstname');\
    $table->string('lastname');

    <u>php artisan migrate</u>

3. <u> web.php </u>\
    use App\Http\Controllers\StudentController;\
    Route::resource('student', StudentController::class);

4. views/student/index.blade.php\
    @extends('layout.app')

    @section('content')
        <a href="{{ route('student.create') }}">Add student</a>

        @if (session()->has('success'))
            <b>{{ session()->get('success') }}</b>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($data as $dt)
                <tr>
                        <th scope="row"> {{ $dt->id }} </th>
                        <td> {{ $dt->firstname }} </td>
                        <td> {{ $dt->lastname }} </td>
                        <td>
                            <a href="{{ route('student.show', $dt->id) }}">Show</a>
                            <a href="{{ route('student.edit', $dt->id) }}">Edit</a>

                            <form action="{{ route('student.destroy', $dt->id) }}" method="post" style="display: inline"
                            onsubmit="confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')

                                <input type="submit" value="Delete">
                            </form>
                        </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endsection


5. <u> StudentController.php</u>\
    public function index()\
    {\
        $data = Student::all();\
        return view('student.index', ['data' => $data]);\
    }

6. <u>student/create.blade.php</u>
    @extends('layout.app')
    @section('content')
        <form action="{{route('student.store')}}" method="post">
            @csrf

            <input type="text" name="firstname" placeholder="First Name"><br><br>
            <input type="text" name="lastname" placeholder="Last Name"><br><br>
            <input type="submit" value="Submit">
        </form>
    @endsection

7. <u> StudentController.php</u>\
    public function create()\
    {\
        Student::create($request->all());\
        return redirect('student')->withSuccess('Added successfully!');\
    }

8. <u>app\Models\Student.php</u>

    class Student extends Model\
    {\
        use HasFactory;\
        protected $fillable = ['firstname', 'lastname'];\
    }

9. <u>student/show.blade.php</u>
    @extends('layout.app')

    @section('content')
        <a href="{{ route('student.index') }}">Home</a>
        <h1>Student Data</h1>

        <p><b>First Name: </b> {{ $data->firstname }} </p>
        <p><b>Last Name: </b> {{ $data->lastname }} </p>
    @endsection


10. <u> StudentController.php</u>\
    public function show(Student $student)\
        {\
            return view('student.show', ['data' => $student]);\
        }

11. <u>student/edit.blade.php</u>
    @extends('layout.app')
    @section('content')
        <form action="{{ route('student.update', $data->id) }}" method="post">
            @csrf
            @method('PUT')

            <input type="text" name="firstname" value=" {{ $data->firstname }} "><br><br>
            <input type="text" name="lastname" value=" {{ $data->lastname }} "><br><br>
            <input type="submit" value="Submit">
        </form>
    @endsection


12. <u> StudentController.php</u>\
    public function edit(Student $student)\
    {\
        return view('student.edit', ['data' => $student]);\
    }

13. <u> StudentController.php</u>\
    public function update(Request $request, Student $student)\
    {\
        $student->update($request->all());\
        return redirect('student')->withSuccess('Updated Successfully!');\
    }

14. <u> StudentController.php</u>\
    public function destroy(Student $student)\
    {\
        $student->delete();\
        return redirect('student')->withSuccess('Deleted Successfully!');\
    }

