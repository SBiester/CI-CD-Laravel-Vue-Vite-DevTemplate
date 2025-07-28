<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Idea;
use Carbon\Carbon;

class IdeaSeeder extends Seeder
{
    public function run()
    {
        // Sample data for the ideas table
        $ideas =  [
            [
                'vorgangsnuummer' => 'V12345',
                'title' => 'New',
                'einreicher' => 'User1',
                'pronlembeschreibung' => 'Problem description 1',
                'losungsbeschreibung' => 'Solution description 1',
                'date' => Carbon::now()->subMonths(2),
                'attachment' => 'attachment1.pdf',
            ],
            [
                'vorgangsnuummer' => 'V12346',
                'title' => 'Approved',
                'einreicher' => 'User2',
                'pronlembeschreibung' => 'Problem description 2',
                'losungsbeschreibung' => 'Solution description 2',
                'date' => Carbon::now()->subMonths(1),
                'attachment' => 'attachment2.pdf',
            ],
            [
                'vorgangsnuummer' => 'V12347',
                'title' => 'Rejected',
                'einreicher' => 'User3',
                'pronlembeschreibung' => 'Problem description 3',
                'losungsbeschreibung' => 'Solution description 3',
                'date' => Carbon::now(),
                'attachment' => 'attachment3.pdf',
            ],
        ];
        //Insert data into the database
        foreach ($ideas as $idea) {
            Idea::create($idea);
        }
    }
}
