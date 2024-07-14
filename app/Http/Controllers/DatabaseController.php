<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Mahasiswa;

class DatabaseController extends Controller
{
    public function index()
    {
        $data = DB::table('mahasiswa')->get();
        return response()->json($data);
    }
    
    public function indexTambah()
    {
        return view('tambah');
    }

    public function createTable(Request $request)
    {
        $tableName = $request->input('table_name');
        $columns = $request->input('columns'); // An array of columns with their definitions

        Schema::create($tableName, function (Blueprint $table) use ($columns) {
            foreach ($columns as $column) {
                $columnType = $column['type'];
                $columnName = $column['name'];
                
                switch ($columnType) {
                    case 'string':
                        $table->string($columnName);
                        break;
                    case 'integer':
                        $table->integer($columnName);
                        break;
                    // Add other column types as needed
                    default:
                        $table->string($columnName); // Default to string if type is unknown
                        break;
                }
            }
        });

        return response()->json(['message' => 'Table created successfully.']);
    }

    public function changeColumnType(Request $request)
    {
        $table = $request->input('table');
        $column = $request->input('column');
        $newType = $request->input('type');
        $lengthType = $request->input('lengthType');

        DB::statement("ALTER TABLE $table MODIFY $column $newType($lengthType)");

        return response()->json(['message' => 'Column type changed successfully']);
    }

    public function addPrimaryKey(Request $request)
    {
        $tableName = $request->input('table');
        $primaryKeyName = $request->input('column');

        DB::statement("ALTER TABLE $tableName ADD PRIMARY KEY ($primaryKeyName)");

        return response()->json(['message' => 'Primary Key added successfully']);
    }

    public function addAutoIncrement(Request $request)
    {
        $table = $request->input('table');
        $column = $request->input('column');

        DB::statement("ALTER TABLE $table MODIFY $column INT AUTO_INCREMENT");

        return response()->json(['message' => 'Auto increment added successfully']);
    }
    
    public function deleteAutoIncrement(Request $request)
    {
        $table = $request->input('table');
        $column = $request->input('column');
        $type = $request->input('type');
        $lengthType = $request->input('lengthType');

        DB::statement("ALTER TABLE $table CHANGE $column $column $type($lengthType) NOT NULL");

        return response()->json(['message' => 'Auto increment deleted successfully']);
    }

    public function allowNull(Request $request)
    {
        $table = $request->input('table');
        $column = $request->input('column');
        $newType = $request->input('type');
        $lengthType = $request->input('lengthType');

        DB::statement("ALTER TABLE $table MODIFY $column $newType($lengthType) NULL");

        return response()->json(['message' => 'Column now allows NULL']);
    }

    public function disallowNull(Request $request)
    {
        $table = $request->input('table');
        $column = $request->input('column');
        $newType = $request->input('type');
        $lengthType = $request->input('lengthType');

        DB::statement("ALTER TABLE $table MODIFY $column $newType($lengthType) NOT NULL;");

        return response()->json(['message' => 'Column now disallows NULL']);
    }

    public function changePrimaryKey(Request $request)
    {
        $table = $request->input('table');
        $column = $request->input('column');

        DB::statement("ALTER TABLE $table DROP PRIMARY KEY, ADD PRIMARY KEY ($column) USING BTREE");

        return response()->json(['message' => 'Primary key changed successfully']);
    }

    public function changeForeignKey(Request $request)
    {
        $table = $request->input('table');
        $oldForeignKey = $request->input('old_foreign_key');
        $newForeignKey = $request->input('new_foreign_key');
        $referenceTable = $request->input('reference_table');
        $referenceColumn = $request->input('reference_column');

        // Drop the old foreign key
        DB::statement("ALTER TABLE $table DROP FOREIGN KEY $oldForeignKey");

        // Add the new foreign key
        DB::statement("ALTER TABLE $table ADD CONSTRAINT $newForeignKey FOREIGN KEY ($newForeignKey) REFERENCES $referenceTable($referenceColumn)");

        return response()->json(['message' => 'Foreign key changed successfully']);
    }

    public function tambahData(Request $request)
    {
        $data = new Mahasiswa();
        $data->nama = $request->input('nama');
        $data->nim = $request->input('nim');
        $data->jurusan = $request->input('jurusan');
        $data->alamat = $request->input('alamat');
        $data->nohp = $request->input('nohp');
        $data->save();

        return response()->json($data); // Kirim data yang baru ditambahkan sebagai JSON response
    }

    public function updateData(Request $request, $id)
    {
        Mahasiswa::where('id', $id)->update([
            'nama' => $request->input('nama'),
            'nim' => $request->input('nim'),
            'jurusan' => $request->input('jurusan'),
            'alamat' => $request->input('alamat'),
            'nohp' => $request->input('nohp'),
        ]);

        return response()->json(['message' => 'Data updated successfully']);
    }

    public function deleteData($id)
    {
        $data = Mahasiswa::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Data deleted successfully']);
    }

    public function getDataColumn(Request $request)
    {
        $table = $request->input('table');
        $columns = DB::select("SHOW COLUMNS FROM $table");
        return response()->json($columns);
    }
}
