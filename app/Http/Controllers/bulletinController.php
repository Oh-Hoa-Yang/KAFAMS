<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bulletin;
use Carbon\Carbon;

class bulletinController extends Controller
{
    

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
      
}