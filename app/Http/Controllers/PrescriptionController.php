<?php

namespace App\Http\Controllers;

use App\Helper\CommonHelper;
use App\PrescriptionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{

    public function order_with_prescription(Request $request)
    {
        $prescriptions = PrescriptionImage::myPrescription()->isDefault()->get();

        return view('frontend.prescription.order_with_prescription')->with(['prescriptions' => $prescriptions]);
    }

    public function prescription_specify()
    {
        return view('frontend.prescription.prescription_specify');
    }

    public function add_image(Request $request)
    {
        $item = new PrescriptionImage();
        $item->user_id = Auth::user()->id;
        $item->image = CommonHelper::createImage($request->image, 'uploads/prescription/');
        $item->save();

        return "success";
    }

    public function delete_image(Request $request)
    {
        PrescriptionImage::find($request->pid)->update(['is_default' => false]);

        return "success";
    }

    public function list_image()
    {
        $data = PrescriptionImage::myPrescription()->get();

        return ['data' => $data];
    }

    public function update_default_image(Request $request)
    {
        PrescriptionImage::myPrescription()->update(['is_default' => false]);

        foreach ($request->ids as $id) {
            $item = PrescriptionImage::find($id);
            $item->is_default = true;
            $item->save();
        }
    }

    public function checkout(Request $request)
    {
        $request->session()->put($request->all());
        return view('frontend.prescription.checkout');
    }


}
