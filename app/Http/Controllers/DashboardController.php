<?php

namespace App\Http\Controllers;
use App\Models\Idea;
use Carbon\Carbon;
use Illuminate\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    public function getStatistics(){
       // $totalIdeas = Idea::count();
       // $approvedIdeas = Idea::where('status' , 'approved')->count();
       // $rejectedIdeas = Idea::where('status' , 'rejected')->count();
       // $pendingIdeas = Idea::where('status' , 'pending')->count();


        return response()->json([
            'totalIdeas' => Idea::count(),
            'newIdeas' => Idea::where('status', 'pending')->count(),
            'approvedIdeas' =>Idea::where('status', 'approved')->count(),
            'rejectedIdeas' => Idea::where('status', 'rejected')->count(),

        ]);
    }
    public function getChartData()
    {
        return response()->json([
            'approved' => Idea::where('status', 'approved')->count(),
            'rejected' => Idea::where('status', 'rejected')->count(),
            'new' => Idea::where('status', 'pending')->count(),
        ]);

    }
    public function getKPIData()
    {
        $totalUsers = User::count();
        $submittedIdeas = Idea::count();
        $implementedIdeas = Idea::where('status' , 'approved')->count();
        $averageProcessingTime = Idea::whereNotNull('processed_at')->avg(DB::raw('TIMESTAMPDIFF(DAY, created_at, processed_at)'));

        return response()->json([
            'totalUsers' => $totalUsers,
            'submittedIdeas' => $submittedIdeas,
            'implementedIdas' => $implementedIdeas,
            'averageProcessingTime' => round($averageProcessingTime, 2),
            'totalIdeas' => $submittedIdeas,
        ]);
    }
    public function index()
    {
        return view ('dashboard');
    }

}






    // //
    // public function index( ){
    //     $ideas = Idea::all();
    //     //Count the total number of ideas
    //     $totalIdeas = Idea::count();
    //     //Count the number of new ideas
    //     $newIdea = Idea::where('status', 'Pending')->count();
    //     //count the number of approved ideas
    //     $approvedIdea = Idea::where('status' , 'Approved')->count();
    //     //count the number of rejected ideas
    //     $rejectedIdea = Idea::where('status', 'Rejected')->count();

    //     //count ideas by month
    //     $monthlyIdeas = Idea::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    //     ->groupBy('month')
    //     ->get()
    //     ->pluck('total', 'month');

    //     $labels = [];
    //     $date =[];

    //     //Create an array for all months
    //     for ($i =1; $i <= 12; $i++) {
    //         $labels[] = Carbon::create() ->month($i)->format('F'); //get month names
    //         $data[] = $monthlyIdeas[$i] ?? 0; //set to 0 ifno data for the month
    //     }
    //     $ideas = Idea::all();
    //     return view ('dashboard', compact('totalIdeas','newIdea', 'approvedIdea', 'rejectedIdea', 'labels' ,'data'), ['ideas' => $ideas]);
    // }




