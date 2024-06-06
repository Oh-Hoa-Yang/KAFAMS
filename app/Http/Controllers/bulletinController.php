<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bulletin;
use Carbon\Carbon;

class bulletinController extends Controller
{
    public function bulletinList()
    {
        $today = Carbon::today();
        /*$datas = Bulletin::where('activityDate', '>=', $today) //Only retrieve data for date later than today
            ->orderBy('activityDate', 'asc') //Sort by date in ascending order
            ->paginate(8);*/

        return view('manageBulletin.showBulletin', compact('datas'));
    }
    

    public function newBulletin()
    {
        return view('manageBulletin.addBulletin');
    }

    public function viewBulletin($id)
    {
        $bulletin = Bulletin::findOrFail($id); //Find bulletin ID

        $bulletin = Bulletin::where('bulletin_ID', $bulletin->id) 
            ->get(['id', 'bulletin_ID']);

        return view('manageBulletin.showBulletinDetails', compact('bulletin'));

    }

    public function editBulletin($id)
    {
        $bulletin = Bulletin::find($id)->toArray();
        return view('manageBulletin.editBulletin', compact('bulletin'));
    }


    public function storeNewBullettin(Request $request)
    {
        Bulletin::create($request->all());

        return redirect()->route('manageBulletin.bulletinList')
            ->with('success', 'New bulletin successfully created!');
    }


    public function updateBulletin(Request $request, $id)
    {
        $bulletin = Bulletin::find($id);
        $updated = $bulletin->update($request->all());

        if ($updated) {
            return redirect()->route('manageBulletin.archiveList')
                ->with('success', "Successfully edited bulletin.");
        } else {
        }
    }
      
}