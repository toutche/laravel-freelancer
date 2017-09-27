<?php

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create(array('name_of_course' => 'Engenharia Mecânica',
            'status' => 1)
        	
        );
    }
}
