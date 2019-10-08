<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseWithLesson extends Model
{
    protected $category_name;
    protected $course_id;
    protected $course_name;
    protected $lesson_name;    
    protected $video_link;
}
