<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;


class SliderService {

    public function insert($request) {
        try {

            Slider::create($request->input());
            $request->session()->flash('success', 'Thêm slider thành công');
        } catch (\Exception $err) {
            $request->session()->flash('error', 'Thêm slider lỗi');
            Log::info($err->getMessage());

            return false;
        }
        return true;
    }

    public function get() {
        return Slider::orderByDesc('id')->paginate(15);
    }

    public function update($request, $slider) {
        try {
            $slider->fill($request->input());
            $slider->save();
            $request->session()->flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Log::info($err->getMessage());
            $request->session()->flash('error', 'Cập nhật lỗi');
            return false;
        }
        return true;
    }

    public function destroy($request) {
        $slider = Slider::where('id',$request->input('id'))->first();

        if ($slider) {
            $path = str_replace('storage' , 'public', $slider->file);
            $slider->delete();
            Storage::delete($path);
            return true;
        }
        return false;
    }

    public function show() {
        return Slider::where('active',1)->orderByDesc('sort_by')->get();
    }
}
