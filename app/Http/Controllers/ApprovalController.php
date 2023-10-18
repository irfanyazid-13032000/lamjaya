<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Approval;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('approval.submitted-approval');
        
    }

    public function approver($i)
    {
        $approvers = User::get();
        
        return view('approval.approver',compact('i','approvers'));
    }

    public function approverEdit($i,$id)
    {
        $approvers_approval = DB::table('approver_approvals')
                ->where('approval_id',$id)
                ->join('users','users.id','=','approver_approvals.approver')
                ->get();

        $approverSelected = $approvers_approval[$i];

                
        $allApprovers = DB::table('users')->get();
        
        return view('approval.approver-edit',compact('i','approvers_approval','allApprovers','approverSelected'));
    }

    public function approverShow($i,$id)
    {
        $approvers_approval = DB::table('approver_approvals')
                ->where('approval_id',$id)
                ->join('users','users.id','=','approver_approvals.approver')
                ->get();

        $approverSelected = $approvers_approval[$i];

                
        $allApprovers = DB::table('users')->get();
        
        return view('approval.approver-show',compact('i','approvers_approval','allApprovers','approverSelected'));
    }

    public function approver_approval($id)
    {
        $approval = Approval::where('id',$id)->get()->first();

        $approvers = DB::table('approver_approvals')
            ->join('users', 'users.id', '=', 'approver_approvals.approver')
            ->select('approver_approvals.*', 'users.name')
            ->where('approval_id', $id)
            ->get();
        
        $submitter = User::where('id',$approval->submitter)->get()->first();

        $histories = DB::table('history_approval')
            ->join('users','users.id','=','history_approval.actor')
            ->where('history_approval.approval_id',$id)
            ->get();

        // dd($histories);
    
        return view('approval.approver-approval', compact('approvers','approval','submitter','histories'));
    }
    

    public function approval()
    {

        $approvals = Approval::where('submitter',session('user_id'))->get();
        return DataTables::of($approvals)->toJson();

    }

    public function submit(string $id)
    {
        // return $id;
        $approval = Approval::find($id);

        // dd($approval);
        Approval::where('id',$id)
        ->update([
            'status' => 'submit',
            'updated_at' => now()
        ]);




        DB::table('history_approval')->insert([
            'approval_id' => $id,
            'actor' => session('user_id'),
            'status' => 'submit',
            'comment' => $approval->comment,
            'created_at' => now(),
        ]);

        return redirect()->route('approval.index');
    }

    public function responsibility()
    {
        // method ini adalah, ketika user lain mengajukan dokumen, lalu kita sebagai orang yang harus mengecek dan meng approve nya
        // $responsibilities = DB::table('approver_approvals')
        //     ->join('approvals', 'approvals.id', '=', 'approver_approvals.approval_id')
        //     ->where('approver_approvals.approver', session('user_id'))
        //     ->where('approvals.status', 'submit')
        //     ->get();


        return view('approval.responsibility');
    }

    public function responsibilityData()
    {
        $responsibilities = DB::table('approver_approvals')
            // ->where('approvals.status', 'submit')
            ->join('approvals', 'approvals.id', '=', 'approver_approvals.approval_id')
            ->join('giliran_approves', 'giliran_approves.approval_id', '=', 'approvals.id')
            ->join('users as submitter', 'submitter.id', '=', 'approvals.submitter') // Join ke tabel users dengan alias submitter
            ->join('users', 'users.id', '=', 'giliran_approves.approver')
            ->where('approver_approvals.approver', session('user_id'))
            ->where('approvals.status', 'submit')
            ->select(
                'approver_approvals.id',
                'approver_approvals.approval_id',
                'approver_approvals.level_approval',
                'users.name as giliran_approve',
                'approvals.comment',
                'approver_approvals.status',
                'approver_approvals.remember_token',
                'approver_approvals.created_at',
                'approver_approvals.updated_at',
                'approvals.document',
                'approvals.title',
                'approvals.level',
                'submitter.name as submitter_name' // Menggunakan alias submitter_name untuk kolom users.name
            )
            ->get();

    
        return DataTables::of($responsibilities)->toJson();
    }
    
    

    public function lihatApproval($id)
    {

        $approval = Approval::where('id',$id)->get()->first();


        $giliranApprover = DB::table('giliran_approves')->where('approval_id',$id)->get()->first();
        $giliranMu = ($giliranApprover->approver == session('user_id')) ? true : false;

        return view('approval.lihat-approval',compact('approval','giliranMu'));
        // return $approval;
    }

    public function approveApproval(Request $request)
    {
        $approval = DB::table('approver_approvals')
            ->where('approval_id', $request->id)
            ->where('approver', session('user_id'))
            ->get()
            ->first();

        $approverTerbesar = DB::table('approver_approvals')
            ->where('approval_id', $request->id)
            ->get()
            ->sortByDesc('id')
            ->first();

        // jika approver nya ternyata masih ada level lain yang lebih tinggi dari approver yang baru saja approve,
        // maka giliran approve nya akan di update, naik 1 level
        if ($approverTerbesar->level_approval > $approval->level_approval) {

            $approverLevelSelanjutnya = DB::table('approver_approvals')
                    ->where('approval_id', $request->id)
                    // magic nya ada disini, level approval nya ditambah 1 karena naik satu level
                    ->where('level_approval', $approval->level_approval+1)
                    ->get()
                    ->first();

            // giliran approves nya juga di update menjadi approver selanjutnya
            DB::table('giliran_approves')
                ->where('approval_id',$request->id)
                ->update([
                    'approver' => $approverLevelSelanjutnya->approver,
                    'updated_at' => now()
                ]);
        }

        // jika approver nya tidak ada level lain yang lebih tinggi dari level sekarang, maka dinyatakan approval ini final
        if ($approverTerbesar->level_approval == $approval->level_approval) {
            DB::table('approvals')
                ->where('id',$request->id)
                ->update([
                    'status' => 'final',
                    'updated_at' => now()
                ]);
        }

        
    
        if ($approval) {
            // Mengubah nilai kolom comment
    
            // Simpan perubahan pada $approval ke dalam database
            DB::table('approver_approvals')
                ->where('id', $approval->id)
                ->update([
                    'comment' => $request->comment,
                    'status' => 'approve',
                ]);
    
                return redirect()->route('lihat.approval',['id'=>$request->id]);
        }
    
        return null; // Jika data tidak ditemukan
    }


    public function rejectApproval(Request $request)
    {
        DB::table('approvals')
            ->where('id',$request->id)
            ->update([
                'status' => 'belum',
                'updated_at' => now()
        ]);

        DB::table('giliran_approves')
            ->where('approval_id',$request->id)
            ->where('approver',session('user_id'))
            ->delete();

        DB::table('history_approval')
            ->insert([
                'approval_id' => $request->id,
                'actor' => session('user_id'),
                'status' => 'reject',
                'comment' => $request->comment,
            ]);

    

        DB::table('approver_approvals')
                ->where('approval_id', $request->id)
                ->where('approver',session('user_id'))
                ->update([
                    'comment' => $request->comment,
                    'status' => 'reject',
                ]);
        return redirect()->route('responsibility.index');
    }
    



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('approval.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Approval::create([
            'title' => $request->judul_approval,
            'comment' => $request->comment,
            'level' => $request->level_approval,
            'document' => 'tidak ada.doc',
            'submitter' => session('user_id')
        ]);

        $latestApproval = Approval::latest()->first();


        foreach ($request->approver as $key => $value) {
            DB::table('approver_approvals')->insert([
                'approval_id' => $latestApproval->id,
                'level_approval' => $key+1,
                'approver' => $value,
                'comment' => 'tidak ada',
                'created_at' => now(),
            ]);
        }

        DB::table('giliran_approves')->insert([
            'approval_id' => $latestApproval->id,
            // karena giliran pertama adalah $request->approver[0]
            'approver' => $request->approver[0],
            'created_at' => now(),
        ]);


       
        



    //    return view('approval.submitted-approval');
       return redirect()->route('approval.index')->with('success', 'Data approval berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $approval = Approval::find($id);
        // dd($approval);
        return view('approval.detail',compact('approval'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $approval = Approval::find($id);
        // dd($approval);
        return view('approval.edit',compact('approval'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validator = Validator::make($request->all(), [
        'judul_approval' => 'required',
        'comment' => 'required',
        'dokumen' => 'required', // Batasan tipe file dan ukuran maksimum
        'level_approval' => 'required',
        'approver' => 'required|array',
        'approver.*' => 'distinct', // Memastikan nilai approver unik di dalam array
        // tambahkan validasi lainnya sesuai kebutuhan
    ], [
        'approver.distinct' => 'Kolom approver tidak boleh memiliki nilai yang sama.',
    ]);

    // Jika validasi gagal, kembalikan dengan pesan kesalahan
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Mengambil file yang diunggah
    if ($request->hasFile('dokumen')) {
        $file = $request->file('dokumen');

        // Menyimpan file ke direktori yang diinginkan (misalnya, dalam folder public)
        $destinationPath = 'public/dokumen';
        $filename = $file->getClientOriginalName();
        $file->storeAs($destinationPath, $filename);
    }

    $approval = Approval::find($id);
    $approval->title = $request->input('judul_approval');
    $approval->comment = $request->input('comment');
    $approval->document = $filename; // Simpan nama file yang diunggah
    $approval->level = $request->input('level_approval');

    $approval->save();

    DB::table('approver_approvals')
        ->where('approval_id', $id)
        ->delete();

    foreach ($request->input('approver') as $key => $approver) {
        DB::table('approver_approvals')
            ->insert([
                'approval_id' => $id,
                'level_approval' => $key + 1,
                'approver' => $approver,
                'comment' => 'tidak ada'
            ]);
    }

    // Kembali ke halaman approval setelah berhasil mengupdate data
    return redirect()->route('approval.index')->with('success', 'Data approval berhasil diupdate.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        
            $user = Approval::find($id);
            
            if (!$user) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }
            
            $user->delete();
            
            return redirect('/approval');

            
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }

}
