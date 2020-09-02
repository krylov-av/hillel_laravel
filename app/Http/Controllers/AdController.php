<?php
namespace App\Http\Controllers;

class AdController
{
    public function showOne($id)
    {
        $ad = \App\Ad::findOrFail($id);
        return view('ad',['ad'=>$ad]);
    }
    public function create ($id = null)
    {
        if ($id!==null)
        {
            $ad = \App\Ad::find($id);
            $button = 'Save';
        }
        else
        {
            $ad = new \App\Ad;
            $button = 'Create';
        }
        return view('ad-form',['ad'=>$ad,'button'=>$button]);
    }
    public function save ($id = null)
    {
        $validator = \Illuminate\Support\Facades\Validator::make(
            request()->all(),
            [
                'title' => 'required|min:5|max:255',
                'description' => ['required', 'min:5', 'max:65535']
            ]
        );
        if ($validator->fails()) {
            return redirect()->route('ad.create', ['id' => ($id !== null) ? $id : null])
                ->withErrors($validator->errors())
                ->withInput(request()->all());
        }
        if ($id != null) {
            //update
            $ad = \App\Ad::find($id);
            $ad->title = request()->get('title');
            $ad->description = request()->get('description');
            $ad->save();
            return redirect()->route('home')->with('success', 'Ad "' . $ad->title . '" updated successfuly');
        } else {
            //create
            $ad = new \App\Ad;
            $ad->title = request()->get('title');
            $ad->description = request()->get('description');
            //1
            //$ad->user_id = auth()->user()->id;
            //$ad->save();

            //2
            auth()->user()->ads()->save($ad);
            /////Redirect to main page
            return redirect()->route('home')->with('success', 'Ad "' . $ad->title . '" was successfuly created');
        }
    }
    public function delete ($id)
    {
        $ad = \App\Ad::findOrFail($id);
        $user = auth()->user();

        // check permissions
        $access = $user->can('delete',$ad);

        if ($access)
        {
            $ad->delete();
            // redirect to home with success message
            return redirect()->route('home')->with('success','Ad "' .$ad->title. '" was successfuly deleted');
        }
        else
        {
            // redirect to home with error message
            return redirect()->route('home')->with('error','Ad "'.$ad->title.'" can not be deleted, because you are not author');
        }
    }
}
