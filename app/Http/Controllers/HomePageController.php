<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\HistoryController;
use App\Models\Home;

class HomePageController extends Controller
{
    //
    public function index(){
        $banners = Banner::get();
        $image1 = Home::where('type', 'type1')->get()[0];
        $image2 = Home::where('type', 'type2')->get()[0];

		return view('pages/home-page')
        ->with('banners', $banners)
        ->with('image2', $image2)
        ->with('image1', $image1);
    }
    public function addBanner(Request $request){
        $fields = $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|file',
        ]);


        $message = '';
        $error = false;


        $mytime = Carbon::now();

        $serialNumber = strtotime($mytime);

        $imageFullName = $request->file('image')->getClientOriginalName();

        $fileName = $serialNumber.$imageFullName;

        $fields['image'] = $fileName;
        try {
            Banner::create($fields);

            $request->file('image')->storeAs('public/images/banner', $fileName);

            (new HistoryController)->Add("Banner with heading <b>".$fields['heading']."</b> created successfully", "Banner creation");

            $message = 'Banner added successfully';


        } catch (\Throwable $th) {
            $message= $th->getMessage();
            $error = true;
        }

        if ($error) {
            return redirect()->back()->with('error', $message);

        } else {
            return redirect()->back()->with('success', $message);
        }

    }

    public function getBanner(){
        try {
            $banner = Banner::get();
            $response = [
                'data' => $banner,
                'message' => 'success',
            ];
            return response($response, 200);
        } catch (\Throwable $th) {
            //throw $th;
            $response = [
                'error' => $th->getMessage(),
                'message' => 'error',
            ];
            return response($response, 500);
        }
    }

    public function getHome(){

        try {
            $home = Home::get();
            $response = [
                'data' => $home,
                'message' => 'success',
            ];
            return response($response, 200);
        } catch (\Throwable $th) {
            //throw $th;
            $response = [
                'error' => $th->getMessage(),
                'message' => 'error',
            ];
            return response($response, 500);
        }
    }

    public function modifyHomeImages(Request $request){
        $fields = $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|file',
            'id' => 'required'
        ]);


        $message = '';
        $error = false;


        $mytime = Carbon::now();

        $serialNumber = strtotime($mytime);

        $imageFullName = $request->file('image')->getClientOriginalName();

        $fileName = $serialNumber.$imageFullName;

        $fields['image'] = $fileName;
        try {
            $image = Home::find($fields['id']);
            $image->heading = $fields['heading'];
            $image->description = $fields['description'];
            $image->image = $fileName;
            $image->save();

            $request->file('image')->storeAs('public/images/home', $fileName);

            (new HistoryController)->Add("Home image with heading <b>".$fields['heading']."</b> updated successfully", "Home image creation");

            $message = 'Home Image updated successfully';


        } catch (\Throwable $th) {
            $message= $th->getMessage();
            $error = true;
        }

        if ($error) {
            return redirect()->back()->with('error', $message);

        } else {
            return redirect()->back()->with('success', $message);
        }

    }
}
