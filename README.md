
1. `php artisan make:model Student -mcr`
   ```
    -Model
    -Migration
    -Controller
   ```

2. ` create_students_table.php `
   ```
    $table->string('firstname');
    $table->string('lastname');
   ```
   > php artisan migrate

3. `web.php `
   ```
    use App\Http\Controllers\StudentController;\
    Route::resource('student', StudentController::class);
   ```

5. `views/student/index.blade.php`
   ```
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
   ```


7. `StudentController.php`
   ```
    public function index()
    {
        $data = Student::all();
        return view('student.index', ['data' => $data]);
    }
   ```

9. `student/create.blade.php`
    ```
    @extends('layout.app')
    @section('content')
        <form action="{{route('student.store')}}" method="post">
            @csrf

            <input type="text" name="firstname" placeholder="First Name"><br><br>
            <input type="text" name="lastname" placeholder="Last Name"><br><br>
            <input type="submit" value="Submit">
        </form>
    @endsection
    ```

11. `StudentController.php`
    ```
    public function create()
    {
        Student::create($request->all());
        return redirect('student')->withSuccess('Added successfully!');
    }
    ```

13. `app\Models\Student.php`
```
    class Student extends Model
    {
        use HasFactory;
        protected $fillable = ['firstname', 'lastname'];
    }
```

14. `student/show.blade.php`
    ```
    @extends('layout.app')

    @section('content')
        <a href="{{ route('student.index') }}">Home</a>
        <h1>Student Data</h1>

        <p><b>First Name: </b> {{ $data->firstname }} </p>
        <p><b>Last Name: </b> {{ $data->lastname }} </p>
    @endsection
    ```


10. `StudentController.php`
    ```
    public function show(Student $student)
        {
            return view('student.show', ['data' => $student]);
        }
    ```

12. `student/edit.blade.php`
    ```
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
    ```


14. `StudentController.php`
    ```
    public function edit(Student $student)
    {
        return view('student.edit', ['data' => $student]);
    }
    ```

16. `StudentController.php`
    ```
    public function update(Request $request, Student $student)
    {
        $student->update($request->all());
        return redirect('student')->withSuccess('Updated Successfully!');
    }
    ```

18. `StudentController.php`
    ```
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect('student')->withSuccess('Deleted Successfully!');
    }
    ```
![1](https://github.com/Krish123-lang/CRUD-LARA/assets/56486342/2abbb897-160f-43e0-9c1b-f8e6f2fdac5e)

![2](https://github.com/Krish123-lang/CRUD-LARA/assets/56486342/a1ca6841-c8eb-47d5-9c5d-facb68f25401)

![3](https://github.com/Krish123-lang/CRUD-LARA/assets/56486342/5d1e93b7-ba3f-494e-b7df-dcedc5519c02)

![4](https://github.com/Krish123-lang/CRUD-LARA/assets/56486342/24f71d88-bb21-4b30-aeaf-aea066ef176a)
