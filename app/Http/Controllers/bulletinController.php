<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Bulletin;
use Carbon\Carbon;

class bulletinController extends Controller
{
    public function bulletinList(Request $request)
    {
        $oneWeekAgo = Carbon::today()->subWeek();  //Bulletin will display in one week
        $category = $request->query('category', session('bulletinCategory', 'General'));  //Will display the General category first after open interface

        session(['bulletinCategory' => $category]);  //store selected category in the session

        $bulletins = Bulletin::where('created_at', '>=', $oneWeekAgo)   //Retrieve data for the past week
            ->where('bulletinCategory', $category)   //Filter by category
            ->orderBy('created_at', 'desc')   //Sort by date in descending order
            ->paginate(15);

        return view('manageBulletin.showBulletin', compact('bulletins', 'category'));  //display data bulletin in showBulletin interface
    }
 
    public function viewBulletin($id)
    {
        $bulletin = Bulletin::findOrFail($id);   //Find bulletin ID
        return view('manageBulletin.showBulletinDetails', compact('bulletin'));   //display data bulletin details in showBulletinDetails
    }
    
    public function newBulletin()
    {
        return view('manageBulletin.addBulletin');   //display bulletin form
    }

    public function storeNewBulletin(Request $request)   //store new bulletin
    {
        Bulletin::create([  
            'bulletinCategory' => $request->bulletinCategory,
            'bulletinTitle' => $request->bulletinTitle,
            'bulletinMessage' => $request->bulletinMessage,
        ]);

        return redirect()->route('manageBulletin.bulletinList')    //redirect user to bulletinList interface
            ->with('success', 'New bulletin successfully created!');
    }

    public function archiveList(Request $request)  
    {
        //Both admin and teacher can view all bulletins that has been posted
        $archivedBulletins = Bulletin::orderBy('created_at', 'desc')->paginate(8);

        return view('manageBulletin.archiveBulletinList', compact('archivedBulletins'));
    }

    public function editBulletin($id)  //display the edit bulletin form
    {
        $bulletin = Bulletin::find($id)->toArray();
        return view('manageBulletin.editBulletin', compact('bulletin'));
    }

    public function updateBulletin(Request $request, $id)   //store updated data
    {
        $bulletin = Bulletin::find($id);
        $updated = $bulletin->update($request->all());

        if ($updated) {
            return redirect()->route('manageBulletin.archiveList')
                ->with('success', "Successfully edited bulletin.");
        }
    }

    public function deleteBulletin(Bulletin $bulletin)  //delete bulletin data
    {
        $bulletin->delete();
        
        return redirect()->route('manageBulletin.archiveList')->with('success', 'Bulletin successfully deleted!');  
    }   
}