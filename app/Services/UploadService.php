<?php 

// namespace App\Services;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request as FacadesRequest;
// use Str;

class UploadService
{
	public function imageUpload(Request $request)
	{
		// if ($request->hasFile('thumbnail')) {
        //     $gambar = $request->file('thumbnail');
        //     $valid_extensions = ['jpg', 'jpeg', 'png'];
        //     if (!in_array(strtolower($gambar->getClientOriginalExtension()), $valid_extensions)) {
        //         return redirect()->back()->withErrors(['thumbnail' => 'The gambar must be a file of type: jpeg, png, jpg.']);
        //     }
        //     $thumbnail = time() . '.' . $gambar->getClientOriginalExtension();
        //     $gambar->move(public_path('assets/img/'), $thumbnail);
        // }
		// $file = request()->file('file');
		// dd($file);
		// $filename = Str::random(9).$file->getClientOriginalName();
		// $file->move(public_path('assets/img/news'.$path),$filename);

		// return $filename;
	}
}