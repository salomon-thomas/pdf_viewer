<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Traits\FileUploadTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use FileUploadTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $files = Files::with('user')->orderBy('id', 'DESC')->get(); //
        return view('home', compact('files'));
    }
    public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document' => 'required|mimetypes:application/pdf,application/octet-stream|max:2048'
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->all());
        }
        $file = $this->upload($request->document, '/document-', '/documents');
        $data = ['user_id' => $request->user()->id, 'filename' => $request->file('document')->getClientOriginalName(), 'document' =>  $file, 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()];
        $document_id = Files::insertGetId($data);
        if ($document_id) {
            return back()->with('success', 'Document added successfully');
        } else {
            return back()->with('error', 'Failed to add document.');
        }
    }
    public function deleteFile($id)
    {
        try {
            $file = Files::findOrFail($id);
            $this->deleteFromS3($file->document);
            Files::where('id', $id)->delete();
            return back()->with('success', 'Document deleted successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to delete document.');
        }
    }
}
