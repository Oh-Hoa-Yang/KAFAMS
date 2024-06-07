<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bulletin;
use Carbon\Carbon;

class bulletinController extends Controller
{
    public function bulletinList(Request $request)
    {
        $today = Carbon::today();
        $category = $request->query('category', session('bulletinCategory', 'General'));

        // Store the selected category in the session
        session(['bulletinCategory' => $category]);

        $bulletins = Bulletin::where('created_at', '>=', $today) // Only retrieve data for date later than today
            ->where('bulletinCategory', $category) // Filter by category
            ->orderBy('created_at', 'desc') // Sort by date in ascending order
            ->paginate(15);

        return view('manageBulletin.showBulletin', compact('bulletins', 'category'));
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
        $user = Auth::user();

        // Both admin and teacher can view all bulletins
        $archivedBulletins = Bulletin::orderBy('created_at', 'desc')->paginate(8);

        return view('manageBulletin.archiveBulletinList', compact('archivedBulletins'));
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
        }
    }

    public function deleteBulletin(Request $request, Bulletin $bulletin)
    {
        $bulletin->delete();
        
        return redirect()->route('manageBulletin.archiveList')->with('success', 'Bulletin successfully deleted!');  
    }   
}