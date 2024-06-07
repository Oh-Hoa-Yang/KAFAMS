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
        $bulletins = Bulletin::where('created_at', '>=', $today) //Only retrieve data for date later than today
            ->orderBy('created_at', 'asc') //Sort by date in ascending order
            ->paginate(8);

        return view('manageBulletin.showBulletin', compact('bulletins'));
    }

    public function viewBulletin($id)
    {
        $bulletin = Bulletin::findOrFail($id); //Find bulletin ID
        return view('manageBulletin.showBulletinDetails', compact('bulletin'));
    }
    
    public function newBulletin()
    {
        return view('manageBulletin.addBulletin');
    }

    public function storeNewBulletin(Request $request)
    {
        Bulletin::create([
            'bulletinCategory' => $request->bulletinCategory,
            'bulletinTitle' => $request->bulletinTitle,
            'bulletinMessage' => $request->bulletinMessage,
        ]);

        return redirect()->route('manageBulletin.bulletinList')
            ->with('success', 'New bulletin successfully created!');
    }

    public function archiveList(Request $request)
    {
        return view('manageBulletin.archiveList');
    }

    public function editBulletin($id)
    {
        $bulletin = Bulletin::find($id)->toArray();
        return view('manageBulletin.editBulletin', compact('bulletin'));
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

    public function deleteBulletin(Bulletin $manageBulletin)
    {
        $manageBulletin->delete();
        return redirect()->route('manageBulletin.archiveList')->with('success', 'Bulletin successfully deleted!');
        
    }   
}